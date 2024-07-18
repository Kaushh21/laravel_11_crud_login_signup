<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
        $validator['emailPassword'] = 'Email address or password is incorrect.';
        return redirect("login")->withErrors($validator);
    }

    public function registration()
    {
        return view('auth.registration');
    }

   public function customRegistration(Request $request)
{  
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'description' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'age' => 'required|integer|min:18', 
    ]);



    $data = $request->all();
    $data['password'] = Hash::make($data['password']);
    
    // Set default value for age if not provided
    $data['age'] = $request->input('age', 0); 

    $check = $this->create($data);
     
    return redirect("dashboard")->withSuccess('You have signed-in');
}
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'description' => $data['description'],
            'city' => $data['city'],
            'age' => $data['age'],
        ]);
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function profile()
    {
        $user = Auth::user(); // Get the authenticated user

        return view('auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
{
    $user = Auth::user();

    // Validate the form data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'description' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'age' => 'required|integer',
        'old_password' => 'nullable|string|min:6',
        'new_password' => 'nullable|string|min:6|confirmed',
    ]);

    // Update the user's profile fields
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->description = $validatedData['description'];
    $user->city = $validatedData['city'];
    $user->age = $validatedData['age'];

    // Check if old_password and new_password are provided
    if ($request->filled('old_password') && $request->filled('new_password')) {
        // Check if old password matches the current password
        if (!Hash::check($validatedData['old_password'], $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password does not match our records.'])->withInput();
        }

        // Hash and update the new password
        $user->password = Hash::make($validatedData['new_password']);
    }

    $user->save();

    return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
}    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return redirect('login');
    }
}
