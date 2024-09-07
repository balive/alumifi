<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Plan as StripePlan;
use Stripe\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans                  = Plan::get();

        $user                   = auth()->user();

        $currentSubscription    = isset($user) ?  $user->current_subscription() : null;

        $plan_info              = null;
        $nextBillingDate        = null;
        $subscriptionStartDate  = null;
        $paymentMethod          = null;
        $onGracePeriod          = null;
        $started_at             = null;
        $quantity               = 0;

        if($currentSubscription ){
            $plan_info                  = Plan::find($currentSubscription->plan_id);

            $started_at                 = Carbon::createFromDate($currentSubscription->created_at)->toFormattedDateString();

            // Retrieve subscription details
            if($currentSubscription->stripe_id){
                $paymentMethod          = $user->defaultPaymentMethod();
                $onGracePeriod          = $currentSubscription->onGracePeriod();

                $subscriptionStartDate  = $currentSubscription->asStripeSubscription()->current_period_start;
                $subscriptionStartDate  = Carbon::createFromTimeStamp($subscriptionStartDate)->toFormattedDateString();

                $nextBillingDate        = $currentSubscription->asStripeSubscription()->current_period_end;
                $nextBillingDate        = Carbon::createFromTimeStamp($nextBillingDate)->toFormattedDateString();
                $quantity               = $currentSubscription->quantity;
            }
        }

        return view('dashboard.subscription', compact('plans' ,
            'currentSubscription' , 'plan_info' , 'onGracePeriod' ,
            'nextBillingDate' , 'subscriptionStartDate' ,
            'started_at' ,'paymentMethod' ,'quantity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function subscribe_stripe($plan_id,$flow)
    {
        $user                   = User::where('id', auth()->user()->id)->first();
        $currentSubscription    = $user->subscription('default');

        $plan                   = Plan::find($plan_id);
        $plan_stripe_price      = $plan->stripe_price_monthly_id;
        $plan_type              = $plan->type;
        $plan_trial_days        = $plan->trial_days;

        if (in_array($plan_type,['charge','single'])) {
            return $user->checkout([$plan_stripe_price], [
                'success_url' => url('/'),
                'cancel_url' => url('/'),
                'metadata' => [
                    'stripe_price_id' => $plan_stripe_price
                ]
            ]);
        }elseif (in_array($plan_type , ['free'])){

            return $this->free_subscription($plan_id);

        } else {

            //check if there is a running subscription
            if (isset($currentSubscription) && ($currentSubscription->stripe_status)) {
                //check if flow exists and mark it as null as user has an old subscription already
                if ($flow) {
                    $flow = null;
                }
            }

            if ($flow == 'trial' && !isset($user->stripe_id)) {
                $newSubscription = $user->newSubscription('default', $plan_stripe_price)->trialDays($plan_trial_days)->checkout([
                    'success_url' => url('/'),
                    'cancel_url' => url('/'),
                ]);
                $user->update([
                    'trial_ends_at' => now()->addDays($plan_trial_days)
                ]);
            } else if ($flow == 'discount') {
                $newSubscription = $user->newSubscription('default', $plan_stripe_price)->withCoupon("yJt3mCq5")->checkout([
                    'success_url' => url('/'),
                    'cancel_url' => url('/'),
                ]);
            } else {
                $newSubscription = $user->newSubscription('default', $plan_stripe_price)->checkout([
                    'success_url' => url('/'),
                    'cancel_url' => url('/'),
                ]);
            }

            return $newSubscription;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function store(Request $request)
    {

    }

    public function free_subscription($id)
    {
        $plan = Plan::find($id);

        $ends_at = Carbon::now()->add('year' , 10);

        // calculate remaining prompts
        $remaining_prompts  = auth()->user()->remaining_credits;

        $current_amount     = $remaining_prompts +  $plan->access_no;

        if($current_amount > 450){
            $current_amount = 450;
        }

        auth()->user()->remaining_credits = $current_amount;
        auth()->user()->save();


        \Laravel\Cashier\Subscription::updateOrCreate(
            [
                'user_id'               => auth()->user()->id,
                'plan_id'               => $plan->id,
            ],
            [
                'type'                  => "free",
                'stripe_status'         => "active",
                'stripe_price'          => null,
                'trial_ends_at'         => null,
                'ends_at'               => $ends_at,
                'quote_exceeded'        => 0,
                'quantity'              => 0,
            ]
        );

        flash('Subscribed Successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }


    public function cancel()
    {
        $user = auth()->user();

        $currentSubscription = $user->subscription('default');

        if(isset($currentSubscription)){
            $currentSubscription->cancel();

//            if(!$currentSubscription->onGracePeriod()){
//                $currentSubscription->cancelNow();
//            }
        }

        return redirect()->back();
    }

    public function resume()
    {
        $user                = auth()->user();
        $currentSubscription = $user->subscription('default');

        if($currentSubscription){
            if ($currentSubscription->canceled()) {

                $currentSubscription->resume();
            }
        }

        return redirect()->back();
    }

    public function stripe_hook(Request $request)
    {
        $data               = $request->all();
        $object             = $data['data']['object'];
        $sub_id             = $object['id']; // new sub id
        $customer_id        = isset($object['customer']) ? $object['customer'] : ''; // the customer id
        $status             = isset($object['status']) ? $object['status'] : '';
        $currency           = isset($object['currency']) ? $object['currency'] : 'eur';
        $provider_payment_id = isset($object['payment_intent']) ? $object['payment_intent'] : '';
        $user                = User::where('stripe_id', $customer_id)->first();
        $currentSubscription = $user->subscription('default');

        // handle subscription event
        if($object['object'] == 'subscription') {

            if ($status == "canceled") {
                // Mark the subscription as canceled without deleting it
                $subscription = \Laravel\Cashier\Subscription::where('user_id', $user->id)->where('stripe_id', $sub_id)->first();
                if ($subscription) {
                    $subscription->delete();
                }
            }

            if (in_array($status, ["created", "active", "trialing"])) {

                $discount           = $object['discount'];
                $trial_end          = $object['trial_end'];
                $paymentMethod      = $object['default_payment_method'];
                $items              = $object['items']['data'];
                $price_id           = $object['items']['data'][0]['plan']['id']; // the plan id / the product id
                $quantity           = $object['quantity'];
                $period_start       = isset($object['current_period_start']) ? $object['current_period_start'] : null;
                $period_end         = isset($object['current_period_end']) ? $object['current_period_end'] : null;
                $trial_ends_at      = isset($object['trial_ends_at']) ? $object['trial_ends_at'] : null;
                $cancel_at          = isset($object['cancel_at']) ? $object['cancel_at'] : null;
                $billing_period     = 1;
                $next_billing_cycle = $period_end;
                $subtotal           = 0;

                $plan               = Plan::where('stripe_price_monthly_id' , $price_id)
                    ->orWhere('stripe_price_yearly_id' ,$price_id)
                    ->first();

                if ($trial_ends_at) {
                    $trial_ends_at = Carbon::createFromTimestamp($trial_ends_at)->toDateTime();
                }

                if ($period_start) {
                    $period_start = Carbon::createFromTimestamp($period_start)->toDateTime();
                }

                if ($period_end) {
                    $period_end = Carbon::createFromTimestamp($period_end)->toDateTime();
                }

                if ($next_billing_cycle) {
                    $next_billing_cycle = Carbon::createFromTimestamp($next_billing_cycle)->toDateTime();
                }

                // Todo test with actual discount plan
                if ($discount) {
                    $discount = $discount['coupon']['percent_off'];
                } else {
                    $discount = 0;
                }

                if ($paymentMethod) {
                    // set the default payment method
                    $user->updateDefaultPaymentMethod($paymentMethod);
                }


                if (isset($currentSubscription) && $currentSubscription->stripe_id != $sub_id) {
                    // Check if the current subscription is a new subscription, if so, cancel the previous one
                    $currentSubscription->cancelNow();
                }

                // calculate remaining prompts and move them to next plan
                $remaining_prompts  = $user->remaining_credits;
                $current_amount     = $remaining_prompts + $plan->access_no;

                // total prompts shouldn't exceed 450
                if($current_amount > 450){
                    $current_amount = 450;
                }

                $user->remaining_credits = $current_amount;
                $user->save();

                // create cashier subscription
                \Laravel\Cashier\Subscription::updateOrCreate(
                    [
                        'stripe_id' => $sub_id,
                    ],
                    [
                        'type'                  => $plan->type,
                        'user_id'               => $user->id,
                        'plan_id'               => $plan->id,
                        'stripe_status'         => $status,
                        'stripe_price'          => $price_id,
                        'trial_ends_at'         => $trial_end,
                        'ends_at'               => $cancel_at,
                        'quote_exceeded'        => 0,
                        'quantity'              => 0,
                    ]
                );
            }
        }

        return 'OK';

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
