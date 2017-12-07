<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Models\User
};
use Illuminate\Support\Facades\ {
    DB,
    Auth
};
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    // except password, whatsup, avatar
    public function modifyPersonalInfo(Request $request)
    {
        DB::table('users')
            ->where('userID', $request->input('userID'))
            ->update(['nickname' => $request->input('nickname'),
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'gender' => $request->input('gender'),
                'DOB' => $request->input('DOB'),
                'email' => $request->input('email')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function modifyWhatsup(Request $request)
    {
        DB::table('users')
            ->where('userID', $request->input('userID'))
            ->update(['whatsup' => $request->input('whatsup')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function modifyAvatar(Request $request)
    {
        $avatarPath = app(PostController::class)->base64_to_img($request->input('avatar'), '/images/avatars/',
            $request->input('filename'));
        DB::table('users')
            ->where('userID', $request->input('userID'))
            ->update(['avatar' => $avatarPath]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

}