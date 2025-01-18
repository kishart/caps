<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\GmailDemo;

class GmailController extends Controller
{
    public function email(){
        return view('emails.email');
    }
    public function Send(Request $request){
        $this->validate($request,[
'name' => 'required',
            'email' => 'required|email',
            
            'message' => 'required'
        ]);
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            
            'message' => $request->message
        );
        Mail::to('amoralyse21@gmail.com')->send(new GmailDemo($data));
        return back()->with('success','Email sent successfully');
    }
}
