<?php

namespace App\Http\Controllers\Agent;

use App\Models\Type;
use App\Models\Agent;
use App\Models\Order;
use App\Models\Amenity;
use App\Models\Package;
use App\Models\Location;
use App\Models\Property;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


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

        // Building the Registration Verification Email Message
        $link = route('agent_registration_verify', ['token' => $token, 'email' => $request->email]);
        $subject = 'Action Required: Verify Your Email - TheHome Real Estate';

        $message = "Hello " . $request->name . ",<br><br>";
        $message .= "Thank you for registering with <strong>TheHome Real Estate</strong>! Before we get started, we need to verify that this is your email address.<br>";
        $message .= "Please click the button below to confirm your registration and activate your account:<br><br>";

        // Professional Call-to-Action Button
        $message .= "<a href='" . $link . "' style='background: #007bff; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Verify My Email Address</a><br><br>";

        $message .= "If the button above doesn't work, you can also copy and paste the following link into your browser:<br><br><br>";
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

        if (Auth::guard('agent')->attempt($data)) {
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
        if (!$user) {
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        // Building the Reset Password Email Message
        $link = route('agent_reset_password', [$token, $request->email]);
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
        $user = Agent::where('email', $email)->where('token', $token)->first();
        if (!$user) {
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
            'email' => 'required|email|unique:agents,email,' . Auth::guard('agent')->user()->id,
            'phone' => 'required|max:15',
            'company' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'website' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'biography' => 'required',
        ]);

        $agent = Agent::where('id', Auth::guard('agent')->user()->id)->first();

        if ($request->photo) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'agent_' . time() . '.' . $request->photo->extension();
            if ($agent->photo != '') {
                unlink(public_path('uploads/' . $agent->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $agent->photo = $final_name;
        }

        if ($request->password) {
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $agent->password = Hash::make($request->password);
        }

        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->company = $request->company;
        $agent->designation = $request->designation;
        $agent->address = $request->address;
        $agent->country = $request->country;
        $agent->state = $request->state;
        $agent->city = $request->city;
        $agent->zip = $request->zip;
        $agent->website = $request->website;
        $agent->facebook = $request->facebook;
        $agent->linkedin = $request->linkedin;
        $agent->twitter = $request->twitter;
        $agent->instagram = $request->instagram;
        $agent->biography = $request->biography;
        $agent->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function order()
    {
        $agent_id = Auth::guard('agent')->user()->id;
        $orders = Order::where('agent_id', $agent_id)->orderBy('id', 'desc')->get();
        return view('agent.order.index', compact('orders'));
    }
    public function invoice($id)
    {
        $order = Order::with('package')->findOrFail($id);
        return view('agent.order.invoice', compact('order'));
    }
    public function payment()
    {
        $agent_id = Auth::guard('agent')->user()->id;
        $current_order = Order::where('agent_id', $agent_id)
            ->where('currently_active', 1)
            ->first();

        $packages = Package::orderBy('id', 'asc')->get();

        $days_left = 0;
        if ($current_order) {
            $expiration = strtotime($current_order->expire_date);
            $today = strtotime(date('Y-m-d'));
            $days_left = ($expiration - $today) / (60 * 60 * 24);
        }
        return view('agent.payment.index', compact('packages', 'current_order', 'days_left'));
    }

    public function paypal(Request $request)
    {

        $current_order = Package::findOrFail($request->package_id);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('agent_paypal_success'),
                "cancel_url" => route('agent_paypal_canceled'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($current_order->price, 2, ".", ""),
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && isset($response['links'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    session()->put('package_id', $request->package_id);
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('agent_payment')->with('error', 'Payment failed or was not completed. Please try again.');
    }

    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        // Check if the payment was successful
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $package_id = session()->get('package_id');
            $package_data = Package::findOrFail($package_id);
            $agent = Auth::guard('agent')->user();
            $invoice_no = 'INV_' . date('YmdHis') . $agent->id;

            // Set previous plans to inactive
            Order::where('agent_id', $agent->id)->update(['currently_active' => 0]);

            // Create the new Order record
            $order = new Order;
            $order->agent_id = $agent->id;
            $order->package_id = $package_id;
            $order->invoice_no = $invoice_no;
            $order->transaction_id = $response['id'];
            $order->payment_method = 'PayPal';
            $order->paid_amount = $package_data->price;
            $order->purchase_date = date('Y-m-d');
            $order->expire_date = date('Y-m-d', strtotime('+' . $package_data->allowed_days . ' days'));
            $order->status = 'Completed';
            $order->currently_active = 1;
            $order->save();

            // Building the Email Message (Professional Format)
            $links = route('agent_order');
            $subject = 'Payment Confirmation - ' . $package_data->name;

            $message = "Dear " . $agent->name . ",<br><br>";
            $message .= "Thank you for your purchase! We are pleased to inform you that your payment has been successfully processed.<br><br>";

            $message .= "<strong>--- Transaction Details ---</strong><br>";
            $message .= "<strong>Invoice No:</strong> " . $invoice_no . "<br>";
            $message .= "<strong>Transaction ID:</strong> " . $response['id'] . "<br>";
            $message .= "<strong>Package Name:</strong> " . $package_data->name . "<br>";
            $message .= "<strong>Amount Paid:</strong> $" . number_format($package_data->price, 2) . "<br>";
            $message .= "<strong>Payment Date:</strong> " . date('d M, Y') . "<br>";
            $message .= "<strong>Expiry Date:</strong> " . date('d M, Y', strtotime('+' . $package_data->allowed_days . ' days')) . "<br>";
            $message .= "---------------------------------------<br><br>";

            $message .= "Your subscription is now active. You can manage your orders and view full invoice details by clicking the button below:<br><br>";
            $message .= "<a href='" . $links . "' style='background: #28a745; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>View My Orders</a><br><br>";

            $message .= "If you did not make this purchase, please contact our support team immediately.<br><br>";
            $message .= "Best Regards,<br>";
            $message .= "<strong>TheHome Real Estate Team</strong>";

            // Send the mail
            Mail::to($agent->email)->send(new Websitemail($subject, $message));

            session()->forget('package_id');

            return redirect()->route('agent_order')->with('success', 'Payment recorded successfully!');
        }

        // Handle failure
        return redirect()->route('agent_payment')->with('error', 'Payment failed or was not completed. Please try again.');
    }

    public function stripe(Request $request)
    {

        $current_order = Package::findOrFail($request->package_id);
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $current_order->name,

                        ],
                        'unit_amount' => $current_order->price * 100,
                    ],

                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('agent_stripe_success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('agent_payment'),
        ]);
        if (isset($response['id']) && $response['id'] == '') {
            return redirect()->route('agent_payment')->with('error', 'Payment failed or was not completed. Please try again.');
        } else {
            session()->put('package_id', $request->package_id);
            return redirect()->away($response->url);
        }
    }

    public function stripe_success(Request $request)
    {
        if (isset($request->session_id)) {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            if ($response->payment_status !== 'paid') {
                return redirect()->route('agent_payment')->with('error', 'Payment not verified.');
            }

            $package_id = session()->get('package_id');
            $package_data = Package::findOrFail($package_id);
            $agent = Auth::guard('agent')->user();
            $invoice_no = 'INV_' . date('YmdHis') . $agent->id;

            Order::where('agent_id', $agent->id)->update(['currently_active' => 0]);

            $order = new Order;
            $order->agent_id = $agent->id;
            $order->package_id = $package_id;
            $order->invoice_no = $invoice_no;
            $order->transaction_id = $response->id;
            $order->payment_method = 'Stripe';
            $order->paid_amount = $package_data->price;
            $order->purchase_date = date('Y-m-d');
            $order->expire_date = date('Y-m-d', strtotime('+' . $package_data->allowed_days . ' days'));
            $order->status = 'Completed';
            $order->currently_active = 1;
            $order->save();

            // Building the Email Message (Professional Format)
            $links = route('agent_order');
            $subject = 'Payment Confirmation - ' . $package_data->name;

            $message = "Dear " . $agent->name . ",<br><br>";
            $message .= "Thank you for your purchase! We are pleased to inform you that your payment has been successfully processed.<br><br>";

            $message .= "<strong>--- Transaction Details ---</strong><br>";
            $message .= "<strong>Invoice No:</strong> " . $invoice_no . "<br>";
            $message .= "<strong>Transaction ID:</strong> " . $response['id'] . "<br>";
            $message .= "<strong>Package Name:</strong> " . $package_data->name . "<br>";
            $message .= "<strong>Amount Paid:</strong> $" . number_format($package_data->price, 2) . "<br>";
            $message .= "<strong>Payment Date:</strong> " . date('d M, Y') . "<br>";
            $message .= "<strong>Expiry Date:</strong> " . date('d M, Y', strtotime('+' . $package_data->allowed_days . ' days')) . "<br>";
            $message .= "---------------------------------------<br><br>";

            $message .= "Your subscription is now active. You can manage your orders and view full invoice details by clicking the button below:<br><br>";
            $message .= "<a href='" . $links . "' style='background: #28a745; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>View My Orders</a><br><br>";

            $message .= "If you did not make this purchase, please contact our support team immediately.<br><br>";
            $message .= "Best Regards,<br>";
            $message .= "<strong>TheHome Real Estate Team</strong>";

            // Send the mail
            Mail::to($agent->email)->send(new Websitemail($subject, $message));

            session()->forget('package_id');

            return redirect()->route('agent_order')->with('success', 'Payment recorded successfully!');
        } else {
            return redirect()->route('agent_payment')->with('error', 'Payment failed or was not completed. Please try again.');
        }
    }

    public function property()
    {
        $properties = Property::where('agent_id', Auth::guard('agent')->user()->id)->get();
        return view('agent.property.index', compact('properties'));
    }

    public function property_create()
    {
        $locations = Location::orderBy('id', 'asc')->get();
        $types = Type::orderBy('id', 'asc')->get();
        $amenities = Amenity::orderBy('id', 'asc')->get();

        return view('agent.property.create', compact('locations', 'types', 'amenities'));
    }

    public function property_store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:properties',
            'price' => 'required',
        ]);

        $property = new Property();

        if ($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'property_' . time() . '.' . $request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $property->featured_photo = $final_name;
        }

        // 3. Amenities Handling (Array to String)
        if ($request->amenities != '') {
            $amenities = implode(',', $request->amenities);
        } else {
            $amenities = '';
        }

        // 4. Saving Data
        $property->agent_id = Auth::guard('agent')->user()->id;
        $property->location_id = $request->location_id;
        $property->type_id = $request->type_id;
        $property->name = $request->name;
        $property->slug = $request->slug;
        $property->description = $request->description;
        $property->price = $request->price;
        $property->purpose = $request->purpose;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->size = $request->size;
        $property->floor = $request->floor;
        $property->garage = $request->garage;
        $property->balcony = $request->balcony;
        $property->address = $request->address;
        $property->built_year = $request->built_year;
        $property->map = $request->map;
        $property->amenities = $amenities;
        $property->status = "Pending";
        $property->is_featured = 'No'; // Default value set korlam

        $property->save();

        return redirect()->route('agent_property_index')->with('success', 'Property added successfully!');
    }
    public function property_edit($id)
    {
        $property = Property::where('id', $id)->where('agent_id', Auth::guard('agent')->user()->id)->first();
        if (!$property) {
            return redirect()->back();
        }
        $locations = Location::orderBy('name', 'asc')->get();
        $types = Type::orderBy('name', 'asc')->get();
        $amenities = Amenity::orderBy('name', 'asc')->get();
        return view('agent.property.edit', compact('property', 'locations', 'types', 'amenities'));
    }
    public function property_update(Request $request)
    {
        $request->validate([
            'id'    => 'required',
            'name'  => 'required',
            'slug'  => 'required|unique:properties,slug,' . $request->id,
            'price' => 'required',
        ]);
        $property = Property::findOrFail($request->id);

        // 3. Image Update Logic
        if ($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($property->featured_photo && file_exists(public_path('uploads/' . $property->featured_photo))) {
                unlink(public_path('uploads/' . $property->featured_photo));
            }

            $final_name = 'property_' . time() . '.' . $request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $property->featured_photo = $final_name;
        }
        $amenities = $request->amenities ? implode(',', $request->amenities) : '';
        $property->location_id = $request->location_id;
        $property->type_id     = $request->type_id;
        $property->name        = $request->name;
        $property->slug        = $request->slug;
        $property->description = $request->description;
        $property->price       = $request->price;
        $property->purpose     = $request->purpose;
        $property->bedroom     = $request->bedroom;
        $property->bathroom    = $request->bathroom;
        $property->size        = $request->size;
        $property->floor       = $request->floor;
        $property->garage      = $request->garage;
        $property->balcony     = $request->balcony;
        $property->address     = $request->address;
        $property->built_year  = $request->built_year;
        $property->map         = $request->map;
        $property->amenities   = $amenities;
        $property->update();

        return redirect()->route('agent_property_index')->with('success', 'Property updated successfully!');
    }

    public function destroy($id)
    {

        $property = Property::findOrFail($id);

        if ($property->agent_id != Auth::guard('agent')->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized action!');
        }


        if ($property->featured_photo && file_exists(public_path('uploads/' . $property->featured_photo))) {
            unlink(public_path('uploads/' . $property->featured_photo));
        }
        $property->delete();

        return redirect()->back()->with('success', 'Property deleted successfully!');
    }
}
