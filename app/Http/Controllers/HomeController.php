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
    



    
}
