<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Mass extends Model
{
       use HasFactory;
      
      public $table = "masses";

 // protected $table="datatables_data";
      protected $fillable = ['name','mass_id','intention','mailto:email','mobile','prayer_category_id','payment_status','payment_reference'];


}
