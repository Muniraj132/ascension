<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\HomeController;
use App\Models\MailController;


use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\Donate;
class DonationController extends Controller
{
     private $status     =   200;
    // --------------- [ Save donation function ] -------------


    public function createDonation(Request $request) {

        // // validate inputs
    //      $validator          =       Validator::make($request->all(),
    // [
    //             "name"                   =>      "required",
    //             "email"                  =>      "required",
    //             "mobile"                 =>      "required",
    //             "amt"                    =>      "required|numeric",
    //             "mass_id"                =>      "required|numeric"
    //         ]
    //     );

    //     // if validation fails
    //     if($validator->fails()) {
    //         return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
    //     }
          

// create

         $donationArray        =       array(
            "name"                        =>      $request->name,
            "email"                       =>      $request->email,
            "mobile"                      =>      $request->mobile,
            "amt"                         =>      $request->amt,
            "comments"                    =>      $request->comments,
            "address"                     =>      $request->address,
            "date"                        =>      $request->date,     
            "surcharge"                   =>      $request->surcharge,
            "clientcode"                  =>      $request->clientcode,
            "signature"                   =>      $request->signature,
            "merchant_id"                 =>      $request->merchant_id,
            "mer_txn"                     =>      $request->mer_txn,
            "f_code"                      =>      $request->f_code,
            "bank_txn"                    =>      $request->bank_txn,
            "ipg_txn_id"                  =>      $request->ipg_txn_id,
            "bank_name"                   =>      $request->bank_name,
            "mmp_txn"                     =>      $request->mmp_txn,
            "udf5"                        =>      $request->udf5,
            "udf6"                        =>      $request->udf6,
            "udf3"                        =>      $request->udf3,
            "udf4"                        =>      $request->udf4,
            "udf1"                        =>      $request->udf1,
            "udf2"                        =>      $request->udf2,
            "discriminator"               =>      $request->discriminator,
            "desc"                        =>      $request->desc,
            "auth_code"                   =>      $request->auth_code
        );

 // return response()->json(["status" =>  $donationArray['params'] ]);
            $donation  =      Donation::create($donationArray);
            if(!is_null($donation)){ 

                $input = $request->all();
                $email = $request->email;
                $name  = $request->name;
                $amt = $request->amt;
                $date = $request->date;
                $comments = $request->comments;
                $surcharge = $request->surcharge;
               $desc   =  $request->desc;
            $f_code   =  $request->f_code;
            $payment_status = '';
            if($f_code =='C'){
                 $payment_status = 'Cancelled';
            }
            else if($f_code =='F'){
                 $payment_status = 'Failed';
            }

            else{
                 $payment_status = 'Success';
            }

               if(isset($input)){
                   
                    $bodyContent = [
                                'toName' => $name,
                                'amt' => $amt,
                                'surcharge' => $surcharge,
                                'date' => $date,
                                'desc' => $payment_status,
                                 
                                // 'content' => "Message recevied successfully",
                            ];
    // dd($bodyContent);
                            
                 Mail::to($email)->send(new Donate($bodyContent));  

            return response()->json(["status" => $this->status, "success" => true, "message" => "Donation record created successfully", "data" => $donation]);

            }    
            else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
            }

                
    }
}
}

   



//     // --------------- [ donation Listing ] -------------------

//      public function donationListing(Request $request) {

//         $donation       =       Donation::all();
//         if(count($donation) > 0) {
//             return response()->json(["status" => $this->status, "success" => true, "count" => count($donation), "data" => $donation]);
//         }
//         else {
//         return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no record found"]);
//         }
//     }



//     // --------------- [ donation Detail ] ----------------
//     public function donationDetail($id) {
//         $donation        =       Donation::find($id);
//         if(!is_null($donation)) {
//             return response()->json(["status" => $this->status, "success" => true, "data" => $donation]);
//         }
//         else {
//             return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no donation found"]);
//         }
//     }





// //---------------- [ Delete donation ] ----------




//     public function donationDelete($id) {
//         $donation        =       Donation::find($id);
//         if(!is_null($donation)) {
//             $delete_status      =       Donation::where("id", $id)->delete();
//             if($delete_status == 1) {
//                 return response()->json(["status" => $this->status, "success" => true, "message" => "donation record deleted successfully"]);
//             }
//             else{
//                 return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
//             }
//         }
//         else {
//             return response()->json(["status" => "failed", "message" => "Whoops! no massbook found with this id"]);
//         }
// }
