<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Requests;
use LRedis;

class chatController extends Controller
{
    //
    public function  __construct() {
    	$this->middleware('guest');
    }

    public function sendMessage() {
    	$redis = LRedis::connection();
    	$data = ['message' => Requests::input('message'), 'user' => Requests::input('user')];
    	$redis->publish('message', json_encode($data));
    	return response()->json([]);
    }
}
