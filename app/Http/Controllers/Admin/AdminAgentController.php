<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agent;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminAgentController extends Controller
{
    public function index()
    {
        $agents = Agent::orderBy('id', 'asc')->get();
        return view('admin.agents.index', compact('agents'));
    }
    public function create()
    {
        return view('admin.agents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:agents|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:agents,email',
        ]);

        $agent = new Agent();
        $agent->name = $request->name;
        $agent->email = $request->email;

        $plain_password = 'sh1234';
        $agent->password = Hash::make($plain_password);
        $token = hash('sha256', time());
        $agent->token = $token;

        if ($request->hasFile('photo')) {
            $final_name = 'agent_' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $agent->photo = $final_name;
        }

        $agent->save();
        $link = route('agent_registration_verify', ['token' => $token, 'email' => $request->email]);
        $subject = 'Welcome to TheHome - Please Verify Your Email';

        $message = "Dear <strong>" . $agent->name . "</strong>,<br><br>";
        $message .= "Welcome to <strong>TheHome Real Estate</strong>! We are thrilled to have you join our community.<br>";
        $message .= "Your account has been created successfully. To complete your registration, please verify your email address.<br><br>";

        $message .= "<div style='background: #f8f9fa; padding: 15px; border: 1px solid #ddd;'>";
        $message .= "<strong>Your Login Credentials:</strong><br>";
        $message .= "---------------------------------------<br>";
        $message .= "<strong>Email:</strong> " . $agent->email . "<br>";
        $message .= "<strong>Password:</strong> " . $plain_password . "<br>";
        $message .= "---------------------------------------</div><br>";

        $message .= "Click the button below to verify your account and log in:<br><br>";
        $message .= "<a href='" . $link . "' style='background: #007bff; color: #fff; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Verify My Account</a><br><br>";

        $message .= "If the button doesn't work, copy this link: <br>" . $link . "<br><br>";
        $message .= "Best Regards,<br>";
        $message .= "<strong>TheHome Real Estate Team</strong>";

        Mail::to($agent->email)->send(new Websitemail($subject, $message));

        return redirect()->route('admin_agents_index')->with('success', 'Agent registered and verification email sent!');
    }

    public function edit($id)
    {
        $agent = Agent::findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }


    public function update(Request $request)
    {
        $agent = Agent::findOrFail($request->id);

        $request->validate([
            'name'   => 'required|max:255|unique:users,name,' . $agent->id,
            'email'  => 'required|email|unique:users,email,' . $agent->id,
            'photo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->status = $request->status;

        if ($request->status == 0 || $request->status == 2) {
            $token = hash('sha256', time());
            $agent->token = $token;

            $link = route('agent_registration_verify', ['token' => $token, 'email' => $request->email]);
            $subject = 'Action Required: Verify Your Account - TheHome';
            $message = "Dear <strong>" . $agent->name . "</strong>,<br><br>";
            $message .= "Your account status has been updated. To continue using <strong>TheHome Real Estate</strong>, please re-verify your email address.<br><br>";

            $message .= "<div style='background: #f8f9fa; padding: 15px; border: 1px solid #ddd; border-radius: 5px;'>";
            $message .= "<strong>Account Details:</strong><br>";
            $message .= "---------------------------------------<br>";
            $message .= "<strong>Email:</strong> " . $agent->email . "<br>";
            $message .= "<strong>New Status:</strong> " . ($request->status == 0 ? 'Pending' : 'Suspended') . "<br>";
            $message .= "---------------------------------------</div><br>";

            $message .= "Please click the button below to verify your account:<br><br>";
            $message .= "<a href='" . $link . "' style='background: #007bff; color: #fff; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Verify My Account</a><br><br>";

            $message .= "Best Regards,<br><strong>TheHome Real Estate Team</strong>";

            Mail::to($agent->email)->send(new Websitemail($subject, $message));
        }

        if ($request->hasFile('photo')) {
            $final_name = 'agent_' . time() . '.' . $request->photo->extension();
            if ($agent->photo != '' && file_exists(public_path('uploads/' . $agent->photo))) {
                unlink(public_path('uploads/' . $agent->photo));
            }

            $request->photo->move(public_path('uploads'), $final_name);
            $agent->photo = $final_name;
        }

        $agent->save();
        return redirect()->route('admin_agents_index')->with('success', 'Agent information updated successfully!');
    }

    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);

        if ($agent->photo && file_exists(public_path('uploads/' . $agent->photo))) {
            unlink(public_path('uploads/' . $agent->photo));
        }

        $agent->delete();

        return redirect()->back()->with('success', 'Agent deleted successfully');
    }
}
