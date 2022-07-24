<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\RegisterMail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    protected function showRegisterForm()
    {
        return view('auth.register');
    }

    protected function create(RegisterRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $token_parts = json_encode(['email'=>$request->email,'name'=>$request->name]);
        $email_confirmation_token = Crypt::encryptString($token_parts);

       User::create([
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_confirmation_token' => $email_confirmation_token,
            'stop_flag' => 1,
        ]);

        Mail::send(new RegisterMail($email_confirmation_token,$name,$email));

        return redirect('/verify');
    }

    protected function confirmation($email_confirmation_token)
    {
        try {
            $token = Crypt::decryptString($email_confirmation_token);

            $parse_token = json_decode($token);

            $email = $parse_token->email;

            $exists = User::where([['email',$email],['email_confirmation_token',$email_confirmation_token]])->exists();

            if (!$exists) {
                return App::Abort(404);
            }
            User::where([['email',$email]])->update([
                'email_confirmation_token' => null,
                'stop_flag' => 0,
                'email_verified_at' => now(),
            ]);

            return redirect('/register/completed');

        } catch (DecryptException $e) {
            return App::Abort(404);
        }
    }

    protected function completed()
    {
        return view('auth.register_completed');
    }
}
