<?php

namespace App\Http\Controllers\Back;

use App\{
    Http\Controllers\Controller, Models\Comment
};
use Illuminate\Support\Facades\ {
    DB,
    Auth
};
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        DB::table('comments')->insert(
            ['pid' => $request->input('pid'),
                'userID' => $request->input('userID'),
                'contents' => $request->input('contents'),
                'timestamp' => Carbon::now(-4)->format('Y-m-d H:i:s')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function getCommentByPid($pid)
    {
        $comments = DB::select('SELECT * FROM comments WHERE pid = :pid', ['pid' => $pid]);
        return response()->json([
            'status' => 200,
            'data' => $comments
        ]);
    }
}