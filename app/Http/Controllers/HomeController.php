<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            \Log::info('User Type: ' . $usertype); // Log the user type for debugging

            if ($usertype == 'user') {
                return view('user.home');
            } elseif ($usertype == 'admin') {
                // Fetch all appointments for admin users
                $appointments = Appointment::all();
                return view('admin.ahome', compact('appointments'));
            } else {
                return redirect()->back();
            }
        }
    }

    public function uphotos(){
        return view('admin.uphotos');
    }

   
    public function msg(){
        return view('admin.msg');
    }

    public function adminsidebar(){
        return view('layouts.adminsidebar');
    }


    
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'string'], 
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
           
                'phone' => ['required', 'regex:/^09\d{9}$/', 'string'],
        
      
            
        ]);
    
        // Update the user's information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone; 
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    
 
    public function storage(){
        return view('admin.storage');
    }

 
    public function umsg(){
        return view('user.umsg');
    }
    public function contact(){
        return view('user.contact');
    }

    
    public function calendartest(){
        return view('admin.calendartest');
    }

    public function uphotostest(){
        return view('admin.uphotostest');
    }


 
 
}
