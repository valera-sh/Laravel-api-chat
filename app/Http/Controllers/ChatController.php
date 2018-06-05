<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    // это свойство можно заполнить в конструкторе (например взять значение из .env
    protected $countItems = 3;
    protected $nameList = 'chat:list';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = Redis::lrange($this->nameList, 0, -1);
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
        Redis::lpush($this->nameList, json_encode($arr));
        Redis::ltrim($this->nameList, 0, $this->countItems);

        return response()->json(['message' => 'Message added'], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $arrIndex = [];
        $arrLists = Redis::lrange($this->nameList, 0, -1);
        $cnt = count($arrLists);
        for($i = 0; $i < $cnt; ++$i) {
            $arr = json_decode($arrLists[$i], true);

            if (isset($arr['user_id']) && $arr['user_id'] == $user_id) {
                unset($arrLists[$i]);
            };
        }

        Redis::pipeline(function ($pipe) use ($arrLists) {
            $pipe->del($this->nameList);
            foreach ($arrLists as $msg) {
                $pipe->rpush($this->nameList, $msg);
            }
        });
    }
}
