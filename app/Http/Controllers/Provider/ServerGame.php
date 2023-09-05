<?php

namespace App\Http\Controllers\Provider;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServerGame extends Controller
{

    public function getServerGame($gamecode)
    {
        $client = new Client();
        $base_url = 'https://prepaid.iak.dev/';
        $game_code = $gamecode;
        $sign = md5(env('IAK_USERNAME') . env('IAK_APIKEY') . $game_code);

        $response = $client->request('POST', 'https://prepaid.iak.id/api/inquiry-game-server', [
            'json' => [
                'username' => env('IAK_USERNAME'),
                'game_code' => $game_code,
                'sign' => $sign,
            ],
        ]);

        $data = json_decode($response->getBody());
        return $data;
    }
}
