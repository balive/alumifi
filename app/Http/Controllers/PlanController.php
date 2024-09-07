<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Plan::all();

        return view('dashboard.plans' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->get('type') == "monthly"){
            $request->validate([
                'price_monthly'=> 'required',
                'stripe_price_monthly_id'=> 'required',

            ]);
        }elseif($request->get('yearly') == "yearly"){
            $request->validate([
                'price_yearly'=> 'required',
                'stripe_price_yearly_id'=> 'required',

            ]);
        }

        Plan::updateOrCreate([
            'id'=> $request->get('id')
        ], [
            'name'                      => $request->get('name'),
            'description'               => $request->get('description'),
            'price_monthly'             => $request->get('price_monthly'),
            'price_yearly'              => $request->get('price_yearly'),
            'stripe_price_monthly_id'   => $request->get('stripe_price_monthly_id'),
            'stripe_price_yearly_id'    => $request->get('stripe_price_yearly_id'),
            'trial_days'                => $request->get('trial_days'),
            'access_no'                 => $request->get('access_no'),
            'features'                  => $request->get('features'),
            'type'                      => $request->get('type'),
            'status'                    => $request->get('status'),
        ]);

        flash('Done Successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Plan::find($id)->delete();

        flash('Deleted Successfully');

        return redirect()->back();
    }
}
