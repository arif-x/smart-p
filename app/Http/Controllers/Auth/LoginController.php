<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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

                Auth::login($isUser);
                return redirect('/home');

            } else { 

                $createUser = new User;

                if($user->getEmail() != null){
                    $createUser->email = $user->getEmail();
                    $createUser->email_verified_at = \Carbon\Carbon::now();
                }  

                $rand = rand(111111,999999);
                $createUser->password = $user->getName().$rand;

                $createUser->role = 1;

                $createUser->save();

                $id = $createUser->id; // Get current user id

                Auth::login($createUser);

                return redirect('/home');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
