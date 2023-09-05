<?php

namespace App\Helpers;

use Twilio\Rest\Client;


class Twilio
{
    /**
     * Mengirimkan OTP ke nomor telepon menggunakan Twilio.
     *
     * @param  string  $phoneNumber
     * @param  string  $otp
     * @return bool
     */
    public static function sendOtp($phoneNumber, $otp)
    {
        $accountSid = config('services.twilio.account_sid');
        $authToken = config('services.twilio.auth_token');
        $twilioNumber =  config('services.twilio.phone_number');

        $client = new Client($accountSid, $authToken);

        try {
            $client->messages->create(
                $phoneNumber,
                [
                    'from' => $twilioNumber,
                    'body' => trans('auth.otp_message', ['otp' => $otp]),
                ]
            );

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
