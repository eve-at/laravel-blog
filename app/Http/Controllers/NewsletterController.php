<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class NewsletterController extends Controller
{
    public function store() 
    {
        request()->validate([
            'email' => ['required', 'email']
        ]);
        
        // https://mailchimp.com/developer/marketing/api/lists/get-lists-info/
        $client = new \MailchimpMarketing\ApiClient();
    
        $client->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => config('services.mailchimp.prefix')
        ]);
        
        try {
            //$response = $client->lists->getAllLists();
            $response = $client->lists->batchListMembers(config('services.mailchimp.list_id'), ["members" => [
                [
                    'email_address' => request('email'), 
                    'status' => 'subscribed'
                ],
            ]]);
        } catch(\Exception $e) {
            throw ValidationValidationException::withMessages([
                'email' => 'This email could not be added'
                //'email' => $e->getMessage()
            ]);
        }
    
        return redirect()->route('home')->with('success', 'Thank you! You have been successfully subscribed');    
    }
}
