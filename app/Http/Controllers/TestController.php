<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;

class TestController extends Controller
{
    /**
     * Показать профиль конкретного пользователя.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redis = new \Redis();
        try {
            $redis->connect('cache', 6379);
            echo "ok";
        } catch (\Exception $e) {
            var_dump($e->getMessage())  ;
            die;
        }

        //$results = DB::select( DB::raw("SELECT * FROM test") );
        //var_dump($results);die;
       // echo "<pre>";
       // print_r(config()->get('database')['redis']);
        //Redis::set('name1', 'Taylor');
        Redis::hSet('test', 'key3', 'hello3');
        $value = Redis::HGETALL('test');
        echo "<pre>";
        print_r($value);
        $value1 = Redis::HMGET('test', ['key1', 'key3']);
        //echo "<pre>";
        print_r($value1);
        //echo $res;
       $res = Redis::get('test');
        echo $res;
       /* return view('user.profile', [
            'user' => Redis::get('user:profile:'.$id)
        ]);*/
    }
}
