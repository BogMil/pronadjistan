<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MessageSenderController extends Controller
{
    public function SendMessage(){
        $response = Http::withHeaders([
            'X-Viber-Auth-Token'=>'445da6az1s345z78-dazcczb2542zv51a-e0vc5fva17480im9'
        ])->post('https://chatapi.viber.com/pa/send_message', [
            'name' => 'Taylor',
        ]);
    }
}
