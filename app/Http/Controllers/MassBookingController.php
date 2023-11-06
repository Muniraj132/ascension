<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Massbooking;
use Carbon\Carbon;
use App\Models\HomeController;
use App\Models\MailController;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class MassbookingController extends Controller
{

    private $status     =   200;
    // --------------- [ Save massbook function ] -------------


    public function createMassBook(Request $request) {
            $cur_date = $request->DateTime;
            $date_time = date("Y-m-d ", strtotime($cur_date));

           $date_time = date("Y-m-d h:i:s", strtotime($cur_date));

             $mass_time = date("d-m-Y h:i A", strtotime($cur_date));

         $massbookArray['params']         =       array(
            "name"                        =>      $request->name,
            "DateTime"                    =>      $mass_time,
            "language"                    =>      $request->language,
            "intention"                   =>      $request->intention,
            "others"                      =>      $request->udf6,
            "intentionfor"                =>      $request->intentionfor,
            "email"                       =>      $request->email,
            "mobile"                      =>      $request->mobile,
            "amt"                         =>      $request->amt,
            "mass_id"                     =>      $request->mass_id,
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

            $massbook  =      Massbooking::create($massbookArray['params']);

            if(!is_null($massbook)){ 

            $input = $request->all();
            $email = $request->email;
            $name  = $request->name;
            $intention = $request->intention;
            $others = $request->others;
            $mass = $request->language;
            $intentionfor = $request->intentionfor;
            $amt = $request->amt;
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
                            'datetime' => $mass_time,
                            'intention' => $intention,
                            'others' => $others ?? '',
                            'mass' => $mass,
                            'intentionfor' => $intentionfor,
                            'amt' => $amt,
                            'surcharge' => $surcharge,
                            'desc' =>$payment_status,
                            'content' => "Message recevied successfully",
                        ];
             Mail::to($email)->send(new SendMailable($bodyContent));  

            // return response()->json(["status" => $this->status, "success" => true, "message" => "massbook record created successfully", "data" => $massbook]);

            }    
            else {
                // return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
            }      
    }
}

   
    // --------------- [ massbook Listing ] -------------------
    public function massbookListing() {
            $cur_date = '2022-07-29 06:00 PM';
           

             $mass_time = date("d-m-Y H:i A", strtotime($cur_date));

        $massbook       =       Massbooking::all();
        if(count($massbook) > 0) {
            return response()->json(["status" => $this->status, "success" => true, "count" => count($massbook), "data" => $massbook]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no record found"]);
        }
    }

    // --------------- [ massbook Detail ] ----------------
    public function massbookDetail($id) {
        $massbook        =       Massbooking::find($id);
        if(!is_null($massbook)) {
            return response()->json(["status" => $this->status, "success" => true, "data" => $massbook]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no massbook found"]);
        }
    }

//---------------- [ Delete massbook ] ----------
    public function massbookDelete($id) {
        $massbook        =       Massbooking::find($id);
        if(!is_null($massbook)) {
            $delete_status      =       Massbooking::where("id", $id)->delete();
            if($delete_status == 1) {
                return response()->json(["status" => $this->status, "success" => true, "message" => "massbook record deleted successfully"]);
            }
            else{
                return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
            }
        }
        else {
            return response()->json(["status" => "failed", "message" => "Whoops! no massbook found with this id"]);
        }
    }

public function getRestriction(Request $request) {

    $massbook = Massbooking::where('masstime_restriction','yes')->get();
    if(count($massbook) > 0) {
            return response()->json(["status" => $this->status, "success" => true, "count" => count($massbook), "data" => $massbook]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no record found"]);
        }

    }

    public function massdatefilter(Request $request){
        $input = $request->all();
        dd($input);
    }
}

