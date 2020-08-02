<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;//add theses
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {   //attempt to login via request
        try {
      //  $attempt = Auth::attempt($request->only('email', 'password')) ;
        //$password= 'password';
        //$email = 'julie@example.com';
        //if(Auth::attempt($request->only(['email' => $request->input('email'), 'password' => $request->input('password')])) ){
         //   $this->validate($request, [
           //     'email' => 'required',
                // If you are logging in the user via email, change the username to email
             //  'password'  => 'required'
           // ]);
        //$request->email      $request->password
        info('This is some useful information.'); 
        info($request->email);
            
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) )
            {  // if (Auth::attempt($request->only('email', 'password'))) {
                /** @var User $user */
                //if successful we get user
                $user = Auth::user();
                
                $token = $user->createToken('app')->accessToken;
                    return response([
                        'message' => 'success!',
                        'token' => $token,
                        'user' => $user,
                    ]);
            
                }
           } catch (\Exception $exception){
               return response([
                   'message' =>  $exception->getMessage()
               ], 400);
           }
           

        return response ([
            'message' => 'Invalid username/password'
        ], 401);
    }


    public function user(){
        // nothing returned unless provide token in the header Authorisation 
        // key  Bearer then token number & needs auth:api middleware
        return Auth::user();
    }

    public function register(RegisterRequest $request){
        try {
            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),

            ]);

            return $user;
        } catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }


    }


}
