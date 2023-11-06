<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
    //                 $env = "live"; //test or live
    // $login =  320805; //change your username
    // $password = '1f5de964'; //change your password
    // $product = "WESLEY"; // change your product name
    // $currency = "INR"; //change your currency
    // $returnUrl = 'http://localhost:81/Payment-Gateway/response.php'; //return url of your website where you will create a response page
    // $clientCode = '320805'; //client code
    // $account = '320805'; //account
    // $requestHashKey = 'c515d61f90181f9413';
                "amount" => 100 * 100,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }
}

