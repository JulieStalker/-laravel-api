<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //add these
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ForgotController extends Controller
{
    //
    public function forgot(ForgotRequest $request)
    {
        $email = $request->input('email');

        if (User::where('email', $email)->doesntExist())
        {
            return response([
                'message' => 'User doesn\'t exist!'
            ], 404 );
        }
        
        $token = Str::random(10); //laravel str function

        try {
            //store in db  - don't have a model so use DB
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            //send email

            return response([
                'message' => 'Check your email!'
            ]);


        }catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}
