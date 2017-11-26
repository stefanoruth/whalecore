<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::with('billing')->findOrFail(session('tenant'));

        return [
            'invoices' => $project->billing->invoicesIncludingPending()->map(function ($invoice) {
                return (object) [
                    'id' => $invoice->id,
                    'date' => $invoice->date()->toFormattedDateString(),
                    'total' => $invoice->total(),
                ];
            }),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $project = Project::with('billing')->findOrFail(session('tenant'));
        
        if (is_null($project->billing)) {
            $project->billing()->create([
                'email' => request('stripeEmail'),
            ]);
            $project->load('billing');
        }

        $project->billing->newSubscription('basic', 'basic')->create(request('stripeToken'));


        $project->load('billing.subscriptions');

        return redirect('/#/settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with('billing')->findOrFail(session('tenant'));

        return response($project->billing->findInvoiceOrFail($id)->pdf([
            'vendor'  => config('app.name'),
            'product' => 'Subscription',
        ]), 200, ['Content-Type' => 'application/pdf',]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
