<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request, $id)
    {
        $comment = Comments::find(1);
       /* echo "<pre>";
        print_r($comment);
        echo "</pre>";*/
        $cachedBlog = Redis::get('comment_' . $id);
        echo "<pre>";
        //print_r($comment);
        echo "</pre>";
        if (isset($cachedBlog)) {
            echo "yes";
           // $blog = json_decode($cachedBlog, FALSE);
            echo "<pre>";
            print_r($cachedBlog);
            echo "</pre>";
            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $cachedBlog,
            ]);
        } else {
            echo "no".$id;
            //die;
            $comment = Comments::find($id);
            //$blog = array("aa" => "111", "bb" => "222");
            Redis::set('comment_' . $id, $comment);
            //die;
            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $blog,
            ]);
        }
    }
}
