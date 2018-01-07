<?php

namespace App\Http\Controllers;

use Zttp\Zttp;

class MailSubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'mail' => ['required', 'email'],
        ]);
            
        return Zttp::asJson()
                    ->withBasicAuth('', config('services.mailchimp.key'))
                    ->post('https://us17.api.mailchimp.com/3.0/lists/'.config('services.mailchimp.list').'/members', [
                        'email_address' => request('mail'),
                        'status' => 'subscribed',
                        'email_type' => 'html',
                    ])
                    ->body();
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
