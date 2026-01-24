<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\Websitemail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = User::orderBy('id', 'asc')->get();
        return view('admin.customers.index', compact('customers'));
    }
    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users,email',
        ]);

        $customer = new User();
        $customer->name = $request->name;
        $customer->email = $request->email;

        $plain_password = 'sh1234';
        $customer->password = Hash::make($plain_password);
        $token = hash('sha256', time());
        $customer->token = $token;

        if ($request->hasFile('photo')) {
            $final_name = 'user_' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $customer->photo = $final_name;
        }

        $customer->save();
        $link = route('registration_verify', ['token' => $token, 'email' => $request->email]);
        $subject = 'Welcome to TheHome - Please Verify Your Email';

        $message = "Dear <strong>" . $customer->name . "</strong>,<br><br>";
        $message .= "Welcome to <strong>TheHome Real Estate</strong>! We are thrilled to have you join our community.<br>";
        $message .= "Your account has been created successfully. To complete your registration, please verify your email address.<br><br>";

        $message .= "<div style='background: #f8f9fa; padding: 15px; border: 1px solid #ddd;'>";
        $message .= "<strong>Your Login Credentials:</strong><br>";
        $message .= "---------------------------------------<br>";
        $message .= "<strong>Email:</strong> " . $customer->email . "<br>";
        $message .= "<strong>Password:</strong> " . $plain_password . "<br>";
        $message .= "---------------------------------------</div><br>";

        $message .= "Click the button below to verify your account and log in:<br><br>";
        $message .= "<a href='" . $link . "' style='background: #007bff; color: #fff; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Verify My Account</a><br><br>";

        $message .= "If the button doesn't work, copy this link: <br>" . $link . "<br><br>";
        $message .= "Best Regards,<br>";
        $message .= "<strong>TheHome Real Estate Team</strong>";

        Mail::to($customer->email)->send(new Websitemail($subject, $message));

        return redirect()->route('admin_customers_index')->with('success', 'Customer registered and verification email sent!');
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }


    public function update(Request $request)
    {
        $customer = User::findOrFail($request->id);

        $request->validate([
            'name'   => 'required|max:255|unique:users,name,' . $customer->id,
            'email'  => 'required|email|unique:users,email,' . $customer->id,
            'photo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->status = $request->status;

        if ($request->status == 0 || $request->status == 2) {
            $token = hash('sha256', time());
            $customer->token = $token;

            $link = route('registration_verify', ['token' => $token, 'email' => $request->email]);
            $subject = 'Action Required: Verify Your Account - TheHome';
            $message = "Dear <strong>" . $customer->name . "</strong>,<br><br>";
            $message .= "Your account status has been updated. To continue using <strong>TheHome Real Estate</strong>, please re-verify your email address.<br><br>";

            $message .= "<div style='background: #f8f9fa; padding: 15px; border: 1px solid #ddd; border-radius: 5px;'>";
            $message .= "<strong>Account Details:</strong><br>";
            $message .= "---------------------------------------<br>";
            $message .= "<strong>Email:</strong> " . $customer->email . "<br>";
            $message .= "<strong>New Status:</strong> " . ($request->status == 0 ? 'Pending' : 'Suspended') . "<br>";
            $message .= "---------------------------------------</div><br>";

            $message .= "Please click the button below to verify your account:<br><br>";
            $message .= "<a href='" . $link . "' style='background: #007bff; color: #fff; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Verify My Account</a><br><br>";

            $message .= "Best Regards,<br><strong>TheHome Real Estate Team</strong>";

            Mail::to($customer->email)->send(new Websitemail($subject, $message));
        }
       
        if ($request->hasFile('photo')) {
            $final_name = 'user_' . time() . '.' . $request->photo->extension();
            if ($customer->photo != '' && file_exists(public_path('uploads/' . $customer->photo))) {
                unlink(public_path('uploads/' . $customer->photo));
            }

            $request->photo->move(public_path('uploads'), $final_name);
            $customer->photo = $final_name;
        }

        $customer->save();
        return redirect()->route('admin_customers_index')->with('success', 'Customer information updated successfully!');
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);

        if ($customer->photo && file_exists(public_path('uploads/' . $customer->photo))) {
            unlink(public_path('uploads/' . $customer->photo));
        }

        $customer->delete();

        return redirect()->back()->with('success', 'Location deleted successfully');
    }
}
