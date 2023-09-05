<?php

namespace App\Http\Controllers\Provider;

use Exception;
use Illuminate\Http\Request;
use App\Models\ProviderProduk;
use App\Http\Controllers\Controller;

class VipResController extends Controller
{
    public $appId;
    public $apiKey;
    public $sign;
    public $apiUrl = "https://vip-reseller.co.id/api/";

    public function __construct()
    {
        $data = ProviderProduk::where('slug', 'vip-reseller')->first();
        if ($data) {
            $this->appId = $data->app_id;
            $this->apiKey = $data->api_key;
            $this->sign = md5($this->appId . $this->apiKey);
        } else {
            session()->flash('error', 'Provider Vip Reseller tidak ditemukan');
        }
    }

    // prepaid or postpaid or social-media or game-feature
    public function pricesList($cmd = 'social-media')
    {
        $data = http_build_query([
            'key' => $this->apiKey,
            'sign' => $this->sign,
            'type' => 'services',
            'cmd' => $cmd,
        ]);

        return $this->callApi(
            $cmd,
            $data
        );
    }

    public function profile()
    {
        $data = http_build_query([
            'key' => $this->apiKey,
            'sign' => $this->sign,
        ]);

        return $this->callApi(
            'profile',
            $data
        );
    }

    private function buildOrderData($data_no = null, $service = null, $quantity = null, $data_zone = null)
    {
        $data = [
            'key' => $this->apiKey,
            'sign' => $this->sign,
            'type' => 'order',
            'service' => $service,
            'data_no' => $data_no,
            'quantity' => $quantity,
            'data_zone' => $data_zone,
        ];

        return http_build_query(array_filter($data, fn ($value) => $value !== null));
    }

    public function orderPrepaid($data_no = null, $service = null)
    {
        return $this->callApi('prepaid', $this->buildOrderData($data_no, $service));
    }

    public function orderSocialMedia($quantity = null, $data_no = null)
    {
        return $this->callApi('social-media', $this->buildOrderData($data_no, null, $quantity));
    }

    public function orderGameFeature($data_no = null, $data_zone = null)
    {
        return $this->callApi('game-feature', $this->buildOrderData($data_no, null, null, $data_zone));
    }


    public function callApi($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $chresult = curl_exec($ch);

        if ($chresult === false) {
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);
        $json_result = json_decode($chresult, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            throw new Exception('Error decoding JSON response from the API.');
        }
        return $json_result;
    }
}
