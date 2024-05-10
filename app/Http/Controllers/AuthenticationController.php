<?php

namespace App\Http\Controllers;

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '0');

use App\Mail\ResetPasswordTemplate;
use App\Models\{Credentials, User};
use Illuminate\Support\Facades\{Auth, Hash, Cookie, DB, Mail};
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    public function signin(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && $user->is_active == 1) {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('web')->attempt($credentials)) {
                if ($request->has("rememberme")) {
                    Cookie::queue('useremail', $request->email, 60 * 60 * 24 * 365);
                    Cookie::queue('userpassword', $request->password, 60 * 60 * 24 * 365);
                    Cookie::queue('remember', $request->rememberme, 60 * 60 * 24 * 365);
                } else {
                    Cookie::queue('useremail', '');
                    Cookie::queue('userpassword', '');
                    Cookie::queue('remember', '');
                }
                return redirect('/dashboard')->with('success', 200);
            } else {
                return redirect('/')->with('error', 300);
            }
        } else {
            Auth::logout();
            return redirect('/')->with('error', 400);
        }
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        } else {
            return redirect('/');
        }
    }
    public function resetLink(Request $request)
    {
        $request->validate(
            [
                "email" => 'email',
            ],
            [
                'email.email' => 'Please Use a valid email format',
            ]
        );
        $data = DB::table('users')->where("email", "=", $request->email)->first();
        if ($data) {
            session()->put('reset-token', $request->email);
            if ($this->isOnline()) {
                Mail::to($request->email)->send(new ResetPasswordTemplate($request->email,'Reset Password'));
                return redirect('/forget')->with('success', 200);
            } else {
                return redirect('/forget')->with('error', 300);
            }
        } else {
            return redirect('/forget')->with('error', 400);
        }
    }
    public function resetPassword($email)
    {
        return view('Authentication.reset', compact("email"));
    }
    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ],
            [
                'password.confirmed' => 'Your Password is not Matched with the Confirm Password',
            ]
        );
        if (DB::table('users')->where('email', $request->email)->update([
            "password" => Hash::make($request->password),
            "plain_password" => $request->password,
        ])) {
            $user = DB::table('users')->where('email', $request->email)->first();
            Auth::loginUsingId($user->id);
            return redirect('/dashboard')->with('success', 200);
        };
    }
    // public function updateProfile(Request $request, $id)
    // {
    //     $request->validate([
    //         "email" => "unique:users,email,$id",
    //     ]);
    //     $user = User::where('id', $id)->first();
    //     User::where('id', $id)->update([
    //         "first_name" => $user->first_name,
    //         "last_name" => $user->last_name,
    //         "email" => $user->email,
    //         "dob" => $user->dob,
    //         "contact_number" => $user->contact_number,
    //         "password" => $user->password,
    //         "street_address" => $user->address,
    //         "country" => $user->country,
    //         "state" => $user->state,
    //         "city" => $user->city,
    //         "zip_code" => $user->zip_code,
    //         "email_verified_at" => $user->zip_code,
    //         "is_email_verified" => $user->is_email_verified,
    //         "role" => $user->role,
    //         "user_status" => $user->user_status,
    //     ]);
    //     return response()->json([
    //         "message" => 200,
    //     ]);
    // }
    public function isOnline($site = "https://mail.google.com/mail/u/0/#inbox")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
    public function githubredirectToProvider(Request $request)
    {
        return Socialite::driver('github')->redirect();
    }
    public function githubhandleProviderCallback(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");
        $data = (array) Socialite::driver('github')->user();
        $user = DB::table('users')->where("email", $data['email'])->first();
        if ($user) {
            if($user->is_active==1){
                Auth::loginUsingId($user->id);
                return redirect('/dashboard')->with('success', 200);
            }else{
                return redirect('/')->with('error', 400);
            }
        } else {
            $newUserId = User::insertGetId([
                "first_name" => $data['nickname'],
                "last_name" => "",
                "email" => $data['email'],
                "email_verified_at" => now(),
                "emailToken" => null,
                "password" => null,
                "is_admin" => 0,
                "enter_from" => 'Github',
                "is_active" => 1,
                "picture" => $data['avatar'],
            ]);

            Auth::loginUsingId($newUserId);
            return redirect('/dashboard')->with('success', 200);
        }
    }
    public function googleredirectToProvider(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }
    public function googlehandleProviderCallback(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");
        $data = (array) Socialite::driver('google')->user();
        $user = DB::table('users')->where("email", $data['email'])->first();
        $exp = explode(" ", $data['name']);
        if ($user) {
            if($user->is_active==1){
                Auth::loginUsingId($user->id);
                return redirect('/dashboard')->with('success', 200);
            }else{
                return redirect('/')->with('error', 400);
            }
        } else {
            $newUserId = User::insertGetId([
                "first_name" => $exp[0],
                "last_name" => isset($exp[1]) ? $exp[1] : null,
                "email" => $data['email'],
                "email_verified_at" => now(),
                "emailToken" => null,
                "password" => null,
                "is_admin" => 0,
                "enter_from" => 'Google',
                "is_active" => 1,
                "picture" => $data['avatar'],
            ]);

            Auth::loginUsingId($newUserId);
            return redirect('/dashboard')->with('success', 200);
        }
    }
}
