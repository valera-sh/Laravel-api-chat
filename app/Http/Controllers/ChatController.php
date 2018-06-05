<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    // это свойство можно заполнить в конструкторе (например взять значение из .env
    protected $countItems = 3;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = Redis::lrange('chat:list', 0, -1);

        return response()->json($arr);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Redis::flushall();
        $arr = $request->only('lang', 'user_id', 'message');
        Redis::lpush('chat:list', json_encode($arr));
        Redis::ltrim('chat:list', 0, $this->countItems);

        return response()->json(['message' => 'Message added'], 201);
    }


}
