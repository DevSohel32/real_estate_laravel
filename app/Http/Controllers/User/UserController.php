<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function registration()
    {
        return view('user.auth.registration');
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $token = hash('sha256', time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = $token;
        $user->save();

         $link = route('registration_verify', ['token' => $token, 'email' => $request->email]);
        $subject = 'Action Required: Verify Your Email - TheHome Real Estate';

        $message = "Hello " . $request->name . ",<br><br>";
        $message .= "Thank you for registering with <strong>TheHome Real Estate</strong>! Before we get started, we need to verify that this is your email address.<br>";
        $message .= "Please click the button below to confirm your registration and activate your account:<br><br>";

        // Professional Call-to-Action Button
        $message .= "<a href='" . $link . "' style='background: #007bff; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Verify My Email Address</a><br><br>";

        $message .= "If the button above doesn't work, you can also copy and paste the following link into your browser:<br>";
        $message .= "<a href='" . $link . "'>" . $link . "</a><br><br>";

        $message .= "If you did not create an account with us, please ignore this email.<br><br>";
        $message .= "Welcome aboard,<br>";
        $message .= "<strong>TheHome Real Estate Team</strong>";

        // Send the mail
        Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Registration successful. Please check your email to verify your account.');
    }

    public function registration_verify($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid token or email');
        }
        $user->token = '';
        $user->status = 1;
        $user->update();

        return redirect()->route('login')->with('success', 'Email verified successfully. You can now login.');
    }

    public function login()
    {
        return view('user.auth.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1,
        ];

        if(Auth::guard('web')->attempt($data)){
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function forget_password()
    {
        return view('user.auth.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        // Building the Reset Password Email Message
        $link = route('reset_password', [$token, $request->email]);
        $subject = 'Reset Your Password - TheHome Real Estate';

        $message = "Hello,<br><br>";
        $message .= "We received a request to reset the password for your <strong>TheHome Real Estate</strong> account.<br>";
        $message .= "If you made this request, please click the button below to set a new password:<br><br>";

        // Professional Call-to-Action Button
        $message .= "<a href='" . $link . "' style='background: #dc3545; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Reset Password</a><br><br>";
        $message .= "<strong>Note:</strong> This password reset link will expire in 60 minutes for security reasons.<br><br>";
        $message .= "If you did not request a password reset, no further action is required and your account remains secure.<br><br>";

        $message .= "Regards,<br>";
        $message .= "<strong>TheHome Real Estate Team</strong>";

        // Send the mail
        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Reset password link sent to your email');

    }

    public function reset_password($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if(!$user){
            return redirect()->route('login')->with('error', 'Invalid token or email');
        }
        return view('user.auth.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where('email', $email)->where('token', $token)->first();
        $user->password = Hash::make($request->password);
        $user->token = '';
        $user->update();

        return redirect()->route('login')->with('success', 'Password reset successfully');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::guard('web')->user()->id,
        ]);

        $user = User::where('id',Auth::guard('web')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'user_'.time().'.'.$request->photo->extension();
            if($user->photo != '') {
                unlink(public_path('uploads/'.$user->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $user->photo = $final_name;
        }

        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $user->password = Hash::make($request->password);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
