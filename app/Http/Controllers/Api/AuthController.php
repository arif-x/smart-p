<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;

class AuthController extends Controller
{
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $isUser = User::where('email', $user->email)->first();

            if($isUser){

                // Auth::login($isUser);
                // return redirect('/home');

            } else { 

                $createUser = new User;
                $createUser->name =  $user->getName();

                if($user->getEmail() != null){
                    $createUser->email = $user->getEmail();
                    $createUser->email_verified_at = \Carbon\Carbon::now();
                }  

                $rand = rand(111111,999999);
                $createUser->password = $user->getName().$rand;

                $createUser->role = 1;

                $createUser->save();

                $id = $createUser->id; // Get current user id

                Profil::create([
                    'id_user' => $id,
                ]);

                // Auth::login($createUser);

                // return redirect('/home');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
