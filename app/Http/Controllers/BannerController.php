<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/include/bannerimage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
       
        $banner = new Banner();
        $banner->name = $request->get('name');
         $request->validate([
            "name"    => "required|min:3",
            "name.*"  => "required|string",
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $fileName = time().'.'.$request->file_path->extension();
        $request->file_path->move(public_path('uploads'), $fileName);
        $banner->file_path = $fileName;
        $banner->save();
        return back()
            ->with('success','You have successfully upload your image.');
                        // return redirect('login')->with('success', 'New Profile Successfully Added');

    }



    //       {
    //     $request->validate([
    //         'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);
  
    //     $fileName = time().'.'.$request->file->extension();  
   
    //     $request->file->move(public_path('uploads'), $fileName);
   
    //     return back()
    //         ->with('success','You have successfully upload file.')
    //         ->with('file',$fileName);
   
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data = Massbooking::all();
     
        // dd($data);
         return view('backend/include/massbooking',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
