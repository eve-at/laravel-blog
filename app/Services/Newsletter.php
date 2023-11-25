<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use \MailchimpMarketing\ApiClient;

class Newsletter 
{
    // https://mailchimp.com/developer/marketing/api/lists/get-lists-info/
    public function subscribe(string $email) 
    {
        $this->client()->lists->batchListMembers(config('services.mailchimp.list_id'), ["members" => [
            [
                'email_address' => $email, 
                'status' => 'subscribed'
            ],
        ]]);
    }

    protected function client()
    {
        return (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => config('services.mailchimp.prefix')
        ]);
    }
}