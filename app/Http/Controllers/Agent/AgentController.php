<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use App\Models\Order;
use App\Models\Package;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    public function dashboard()
    {
        return view('agent.dashboard.index');
    }

    public function registration()
    {
        return view('agent.auth.registration');
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email|unique:agents,email',
            'company' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $token = hash('sha256', time());

        $agent = new Agent();
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->company = $request->company;
        $agent->designation = $request->designation;
        $agent->password = Hash::make($request->password);
        $agent->token = $token;
        $agent->save();

        $link = route('agent_registration_verify', ['token' => $token, 'email' => $request->email]);
        $subject = 'Registration Verification';
        $message = 'Click on the following link to verify your email: <br><a href="' . $link . '">' . $link . '</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Registration successful. Please check your email to verify your account.');
    }

    public function registration_verify($token, $email)
    {
        $agent = Agent::where('email', $email)->where('token', $token)->first();
        if (!$agent) {
            return redirect()->route('agent_login')->with('error', 'Invalid token or email');
        }
        $agent->token = '';
        $agent->status = 1;
        $agent->update();

        return redirect()->route('agent_login')->with('success', 'Email verified successfully. You can now login.');
    }

    public function login()
    {
        return view('agent.auth.login');
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

        if(Auth::guard('agent')->attempt($data)){
            return redirect()->route('agent_dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('agent')->logout();
        return redirect()->route('agent_login')->with('success', 'Logged out successfully');
    }

    public function forget_password()
    {
        return view('agent.auth.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Agent::where('email', $request->email)->first();
        if(!$user){
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        $link = route('agent_reset_password', [$token,$request->email]);
        $subject = 'Reset Password';
        $message = 'Click on the following link to reset your password: <br>';
        $message .= '<a href="'.$link.'">'.$link.'</a>';

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Reset password link sent to your email');

    }

    public function reset_password($token, $email)
    {
        $user = Agent::where('email', $email)->where('token', $token)->first();
        if(!$user){
            return redirect()->route('agent_login')->with('error', 'Invalid token or email');
        }
        return view('agent.auth.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $agent = Agent::where('email', $email)->where('token', $token)->first();
        $agent->password = Hash::make($request->password);
        $agent->token = '';
        $agent->update();

        return redirect()->route('agent_login')->with('success', 'Password reset successfully');
    }

    public function profile()
    {
        return view('agent.profile.index');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:agents,email,'.Auth::guard('agent')->user()->id,
            'phone'=>'required|max:15',
            'company'=>'required',
            'designation'=>'required',
            'address'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'zip'=>'required',
            'website'=>'required',
            'facebook'=>'required',
            'linkedin'=>'required',
            'twitter'=>'required',
            'instagram'=>'required',
            'biography'=>'required',
        ]);

        $agent = Agent::where('id',Auth::guard('agent')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'agent_'.time().'.'.$request->photo->extension();
            if($agent->photo != '') {
                unlink(public_path('uploads/'.$agent->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $agent->photo = $final_name;
        }

        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $agent->password = Hash::make($request->password);
        }
        
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->phone=$request->phone;
        $agent->company=$request->company;
        $agent->designation=$request->designation;
        $agent->address=$request->address;
        $agent->country=$request->country;
        $agent->state=$request->state;
        $agent->city=$request->city;
        $agent->zip=$request->zip;
        $agent->website=$request->website;
        $agent->facebook=$request->facebook;
        $agent->linkedin=$request->linkedin;
        $agent->twitter=$request->twitter;
        $agent->instagram=$request->instagram;
        $agent->biography=$request->biography;
        $agent->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }



    public function payment(){
        $current_order = Order::where('agent_id',Auth::guard('agent')->user()->id)->where('currently_active' ,1)->first();
        $packages = Package::orderBy('id','asc')->get();
        return view('agent.payment.index',compact('packages','current_order'));
    }
}
