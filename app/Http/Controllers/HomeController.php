<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if(Auth::id()){
            $usertype = Auth()->user()->usertype;
            \Log::info('User Type: ' . $usertype); // Log the user type for debugging
    
            if($usertype == 'user'){
                return view('user.home');
            }
            elseif($usertype == 'admin'){
                return view('admin.ahome');
            }
            else{
                return redirect()->back();
            }
        }
    }

    public function uphotos(){
        return view('admin.uphotos');
    }

    public function appointlist(){
        return view('admin.appointlist');
    }
    public function msg(){
        return view('admin.msg');
    }

    public function adminsidebar(){
        return view('layouts.adminsidebar');
    }


    public function listappoint(){
        return view('admin.listappoint');
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
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|max:15',
        ]);
    
        // Update the user's information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone; 
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    

    
}
