<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $endpoint = config('services.google_recaptcha');

        $response = Http::asForm()->post($endpoint['url'], [
            'secret' => $endpoint['secret_key'],
            'response' => $value,
        ])->json();

        if ($response['success'] && $response['score'] > 0.5) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'The recaptcha field is invalid.';
    }
}
