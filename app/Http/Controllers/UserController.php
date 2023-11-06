<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserEmail;
use Mail;
  
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::select("*")
                        ->paginate(10);
          
        return view('users', compact('users'));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendEmail(Request $request)
    {
        $users = User::whereIn("id", $request->ids)->get();
  
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new UserEmail($user));
        }
  
        return response()->json(['success'=>'Send email successfully.']);
    }
}



// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\SendMailable;

// class MailController extends Controller
// {
//    public function mail()
// {
//    $name = 'Hey This is Jerome';
//    Mail::to('irudayan111@gmail.com')->send(new SendMailable($name));
   
//    return 'Email was sent';
// }
// }
