<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function login(Request $request)
    {
        // Check if the user is already authenticated and has the 'admin' role
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        // Handle GET request (show the login form)
        if ($request->isMethod('get')) {
            return view('admin.login');
        }

        // Handle POST request (authenticate the user)
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                return redirect()->intended(route('admin.dashboard'));
                $user = Auth::user();

            }

            return redirect()->route('login')->with('error', 'Invalid login credentials');
        }

        return redirect()->route('login')->with('error', 'Invalid login credentials');
    }


    public function dashboard(Request $request)
    {
        return redirect()->route('draws.index');
    }







    public function profile(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('admin.user.profile', compact('user'));
    }

    public function ProfileEdit(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('admin.user.edit', compact('user'));
    }

    public function ProfileUpdate(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate the request
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'mobile_number' => 'nullable|string|max:15',
                'email' => 'nullable|email|max:255',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'current_password' => 'nullable|string',
                'new_password' => 'nullable|string',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                // Get the first error message
                $firstError = $validator->errors()->first();
                return redirect()->back()->with('error', $firstError);
            }

            // Update user details
            if ($request->filled('name')) {
                $user->name = $request->input('name');
            }

            if ($request->filled('mobile_number')) {
                $user->mobile_number = $request->input('mobile_number');
            }

            if ($request->filled('email')) {
                $user->email = $request->input('email');
            }

            // Handle image upload if a new image is provided
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public/profile', $imageName);
                $user->profile_image = $imageName;
            }

            // Handle password change
            $msg = "Profile updated successfully";
            if ($request->filled('current_password') && $request->filled('new_password')) {
                if (Hash::check($request->input('current_password'), $user->password)) {
                    $user->password = Hash::make($request->input('new_password'));
                    $msg = "Paasword changed successfully";
                } else {
                    return redirect()->back()->with(['error', 'Current password is incorrect']);
                }
            }

            // Save the user
            $user->save();

            return redirect()->route('admin.profile')->with('success', $msg);
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with(['error', 'An error occurred while updating the profile. Please try again.']);
        }
    }


    public function logout()
    {
        // Log the user out
        Auth::logout();

        // Redirect to the login page
        return redirect()->route('login');
    }
}
