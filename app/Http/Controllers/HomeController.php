<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mass;
use App\Models\Banner;
use App\Photo;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreFileRequest;

use App\Models\Massbooking;
use App\Models\Donation;
use DataTables;
use PDF;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RemainderMail;


use Validator,Redirect,Response,File;

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
public function index(Request $request)
   {
        

        $data = DB::table('massbookings')
            ->select('*')
            ->where(DB::raw("SUBSTRING_INDEX(DateTime, ' ', 1)"), '=', Carbon::today()->format('d-m-Y'))
            ->where('f_code','OK')
            ->get()->sortByDesc(function ($record) {
                return Carbon::createFromFormat('d-m-Y h:i A', $record->DateTime);
            });

        $datagroup = Massbooking::select('DateTime','language','mass_id')
                   ->whereDate('DateTime', date("d-m-Y", strtotime(Carbon::today())))
                  ->where('f_code','OK')
                   ->where('masstime_restriction','No')->get()->groupBy('mass_id');


        $week = Massbooking::select("*")
                ->where('f_code','OK')
                ->whereBetween('created_at', 
                     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()] )->sum('amt');
  
         $month = Massbooking::select('*')
                        ->where('f_code','OK')
                        ->whereMonth('created_at', date('m'))->sum('amt');
                       
     
        $year = Massbooking::select('*')
                       ->where('f_code','OK')
                       ->whereYear('created_at',date('Y'))->sum('amt');
        return view('backend/layouts/home',compact('data','week','month','year','datagroup'));
    
    }

public function massbooking(Request $request)
    {
        $data = Massbooking::get()->sortByDesc(function ($record) {
            return Carbon::createFromFormat('d-m-Y h:i A', $record->DateTime);
        });
        $datagroup = '';
        $dropdownOptions = Massbooking::getStatusDropdown();
        return view('backend/include/massbooking',compact('data','dropdownOptions'));
    }

public function massdatefilter(Request $request)
    {
           $startDate1 = $request->start_date;
            $endDate1 = $request->end_date;
            $language = $request->language;
            $startDate = date("d-m-Y h:i A", strtotime($startDate1));
            $endDate = date("d-m-Y h:i A", strtotime($endDate1));
        
            $startDated = \DateTime::createFromFormat('d-m-Y h:i A', $startDate1)->format('Y-m-d H:i:s');
            $endDated = \DateTime::createFromFormat('d-m-Y h:i A',$endDate1)->format('Y-m-d H:i:s');
            
            if ( $startDate == $endDate) {
                 if ( $language != 'all') {
                    $data = Massbooking::where('DateTime', $startDate)
                        ->where('f_code', 'OK')
                        ->where('language', $language)
                        ->get(); 

                  } else {
                    $data = Massbooking::where('DateTime', $startDate)
                    ->where('f_code', 'OK')
                    ->get();
                      
                  }
            } else {
                if ( $language != 'all') {
                $data = Massbooking::whereBetween(\DB::raw("STR_TO_DATE(DateTime, '%d-%m-%Y %h:%i %p')"), [$startDated, $endDated])
                    ->where('f_code', 'OK')
                    ->where('language', $language)
                    ->get();
                } else {
                    $data = Massbooking::whereBetween(\DB::raw("STR_TO_DATE(DateTime, '%d-%m-%Y %h:%i %p')"), [$startDated, $endDated])
                    ->where('f_code', 'OK')
                    ->get(); 
                }
            }
        



            $dropdownOptions = Massbooking::getStatusDropdown();
            $datagroup = Massbooking::select('DateTime', 'language', 'mass_id')
                ->where('f_code', 'OK')
                ->where('masstime_restriction', 'No')
                ->whereBetween('DateTime', [$startDate, $endDate])
                ->get()
                ->groupBy('mass_id');
        
        return view('backend/include/massbooking',compact('data','startDate','language','endDate','datagroup','dropdownOptions'));
    
    }

    // public function filterByLanguage(Request $request)
    // {
    //     $language = $request->language;

    //     $data = Massbooking::where('f_code', 'OK')
    //         ->when(!empty($language), function ($query) use ($language) {
    //             return $query->where('language', $language);
    //         })
    //         ->get();

    //     return view('backend/include/massbooking', compact('data'));
    // }
public function search(Request $request)
    {
        $input = $request->all();


    $startDate1 = $request->start_date ?? '';
    $endDate1 = $request->end_date  ?? '';

        if ($startDate1 != '') {
            $startDate = Carbon::createFromTimestamp(strtotime($startDate1))->format('Y-m-d\TH:i');
        }else{
            $startDate = '';
        }if ($endDate1 != '') {
            $endDate = Carbon::createFromTimestamp(strtotime($endDate1))->format('Y-m-d\TH:i');
        }else{
            $endDate = '';
        }
     

        $language = $request->input('language');

        $rows = Massbooking::query();
        if ($startDate != '' && $endDate != '') {
            $rows->whereBetween('DateTime',[$startDate, $endDate]);
        }
        if($language){
            $rows->where('language',$language);
        }   
    
           $data = $rows->get(); 

        return response()->json(['success'=>$rows]);
    }

public function restriction(Request $request)

{
    $massStartDate = $request->download_starttime;
    $massEndDate = $request->download_endtime;
    $restricion = $request->masstime_restriction;

    $startDate = Carbon::createFromTimestamp(strtotime($massStartDate))->format('Y-m-d H:i:s');
    $endDate = Carbon::createFromTimestamp(strtotime($massEndDate))->format('Y-m-d H:i:s');
      
    $request->merge([
        'download_starttime' => $startDate,
        'download_endtime' => $endDate
        ]);
$data = Massbooking::whereBetween('DateTime', [$startDate, $endDate])
        ->where('f_code','OK')
        ->get();

    $massStartDate = $request->download_starttime;
    $massEndDate = $request->download_endtime;
    $restricion = $request->masstime_restriction;

    $startDate = Carbon::createFromTimestamp(strtotime($massStartDate))->format('Y-m-d H:i:s');
    $endDate = Carbon::createFromTimestamp(strtotime($massEndDate))->format('Y-m-d H:i:s');
      
    $request->merge([
        'download_starttime' => $startDate,
        'download_endtime' => $endDate
        ]);

    $massIdVal = $request->mass_id;

    $requestdata = $request->except('mass_id');

    foreach($massIdVal as $key => $value)
    {

    $user = Massbooking::where('mass_id',$value)->update($requestdata);

    }


    $data = Massbooking::where('mass_id',$massIdVal)
           ->where('f_code','OK')
            ->get(); 

    return response()->json(['message'=>$data ]);


    return view('backend/layouts/home',compact('data','startDate','endDate'));
    
}

public function payment(Request $request)
{
        $amount = Massbooking::orderBy('id', 'desc')->get();

        return view('backend/include/payment',compact('amount'));
}

public function delete($id) {

        $value = Massbooking::find($id);
        $value->delete();

        $amount = Massbooking::orderBy('id', 'desc')->get();
        return view('backend/include/payment',compact('amount'));
    }

public function donation(Request $request)
{
        $donate = Donation::all();
        $donate = DB::table('donations')
        ->select('*')
         ->whereDate('date','>=',Carbon::now('Asia/Kolkata')->toDateString())
         ->whereTime('date', '>=', Carbon::now('Asia/Kolkata')->toTimeString())
         ->whereDate('date', Carbon::today())
        ->where('f_code','OK')
        ->orderBy('date', 'desc')
        ->get();

    $datagroup = Massbooking::select('date','language','mass_id')
               ->whereDate('date', Carbon::today())
              ->where('f_code','OK')
               ->where('masstime_restriction','No')->get()->groupBy('mass_id');
        $week = Donation::select("*")
                ->whereBetween('created_at', 
                     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()] )
                    ->where('f_code','OK')->sum('amt');
  
        $month = Donation::select('*')
                        ->whereMonth('created_at', date('m'))
                        ->where('f_code','OK')
                        ->sum('amt');
                       
     $year = Donation::select('*')
                        ->whereYear('created_at',date('Y'))
                        ->where('f_code','OK')
                        ->sum('amt');

        return view('backend/include/donation',compact('donate','week','month','year'));
}

public function donor(Request $request)
{
        // $donors = DB::table('donations')
        //             ->where('f_code','OK')
        //          ->get();

        $donors = Donation::orderBy('name','desc')
        ->get();

        return view('backend/include/donor',compact('donors'));
}


public function week(Request $request)
{


        $week = DB::table('donations')
                ->select('*')
                ->whereBetween('created_at', 
                     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()] )
                ->where('f_code','OK')
                ->get();

        return view('backend/include/weeklydonate',compact('week'));
}
public function month(Request $request)
{
        $month = Donation::select('*')
                        ->whereMonth('created_at', date('m'))
                        ->where('f_code','OK')
                        ->get();

        return view('backend/include/monthlydonate',compact('month'));
}

public function year(Request $request)
{
        $year = Donation::select('*')
             ->whereYear('created_at',date('Y'))
             ->where('f_code','OK')
             ->get();

        return view('backend/include/annualdonate',compact('year'));
}

public function newform()
{
       
         return view('backend/include/newform');
}

public function createPDF()
    {   
        $data = Massbooking::all();
      
        $pdf = PDF::loadView('backend/include/massbooking', compact('data'));
     
        return $pdf->download('itsolutionstuff.pdf');
    }
    public function newmassdatefilter(Request $request){
         
            $date =$request->date;
            // $date =  date("Y-m-d", strtotime($dateold));
            $time =$request->time;
            $language = $request->language;
            // dd($language);
            $datetime = $date.' '.$time;
            $formateDate = date("d-m-Y h:i A", strtotime($datetime));
    
        if($time != null){
  
            if ( $language[0] != 'all') {
                     $data = Massbooking::where('DateTime', $formateDate)
                       ->where('f_code', 'OK')
                       ->whereIn('language',$language)
                       ->get(); 
               } else { 
                   $data = Massbooking::where('DateTime', $formateDate)
                   ->where('f_code', 'OK')
                   ->get(); 
               }
           }else{
                if ( $language[0] != 'all') {
                    $data = Massbooking::where('f_code', 'OK')
                    ->whereIn('language', $language)
                    ->where('DateTime', 'LIKE', $date . '%')
                    ->get();
             } else { 
               $data = Massbooking::where('f_code', 'OK')
                ->where('DateTime', 'LIKE', $date . '%')
                ->get();
             }
             
           } 
        return view('backend/include/massbooking',compact('data','date','language','time'));
    }
    public function getMassDetails(Request $request){
       
        $selectedDate = $request->input('selectedDate');
        $desiredDate =  date("Y-m-d", strtotime($selectedDate));
        $response = Http::get('https://cristolive.org/api/liturgical/17489/upcoming');

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data']) && is_array($data['data'])) {
                $liturgyOnTimes = [];
                $liturgylanguage = [];
                foreach ($data['data'] as $item) {
                    if (isset($item['liturgy_on'])) {
                        $liturgyOn = $item['liturgy_on'];
                        $language = $item['language_id'][1];
                        
                        if (strpos($liturgyOn, $desiredDate) !== false) {
                          $timePart = date("h:i A", strtotime($liturgyOn));
                            
                            if(!in_array($timePart,$liturgyOnTimes)){
                                $liturgyOnTimes[] = $timePart;
                            }
                            

                            if(!in_array($language,$liturgylanguage)){
                                $liturgylanguage[] = $language;
                            }
                            
                        }
                    }
                }
            }
        } else {
            $liturgyOnTimes ='';
            $liturgylanguage ='';
            
        }

         return response()->json(['time' => $liturgyOnTimes ,'language' => $liturgylanguage]);
    }
}


