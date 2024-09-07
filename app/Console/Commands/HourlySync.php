<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Subscription;

class HourlySync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        set_time_limit(0);


        // TODO : add monthly credit renwals


        $this->deleteCancelled();
        $this->reminders();
    }


    public function deleteCancelled()
    {
        Subscription::where('ends_at', '<=', now())
            ->chunkById(10, static function (Collection $subscriptions) {
                /** @param Subscription $subscription */
                foreach ($subscriptions as $subscription) {

                    $user                   = User::find($subscription->user_id);
                    $currentSubscription    = $user->subscription('default');

                    if (!$currentSubscription->cancelled()) {
                        // Cancel the current subscription at the end of the billing cycle
                        $currentSubscription->cancel();
                    }

                    // delete subscription record
                    $currentSubscription->delete();
                }
            });
    }

    private function reminders()
    {
        Subscription::where(static function (Builder $q) {
            $q->where([
                ['ends_at', '>=', now()->addDay()->startOfDay()],
                ['ends_at', '<=', now()->addDay()->endOfDay()],
            ])->orWhere([
                ['trial_ends_at', '>=', now()->addDay()->startOfDay()],
                ['trial_ends_at', '<=', now()->addDay()->endOfDay()],
            ]);
        })
            ->whereNull('ends_at')
            ->chunkById(10, function (Collection $subscriptions) {
                /** @param Subscription $subscription */
                foreach ($subscriptions as $subscription) {
                    $details = [
                        'title' => "Next Billing Cycle Reminder",
                        'body' =>   "We would like to remind you that your next billing cycle will start "
                    ];

                    Mail::to($subscription->user->email)->send(new NextBillingCycleReminder($details));
                }
            });
    }

}
