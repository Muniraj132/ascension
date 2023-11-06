<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Massbooking extends Model
{


    public static function getStatusDropdown()
    {
        return [
            // '' => 'Select Time',
            '06:00 AM' => '06:00 AM',
            '06:30 AM' => '06:30 AM',
            '07:00 AM' => '07:00 AM',
            '07:45 AM' => '07:45 AM',
            '09:15 AM' => '09:15 AM',
            '11:00 AM' => '11:00 AM',
            '05:00 PM' => '05:00 PM',
            '05:30 PM' => '05:30 PM',
            '05:45 PM' => '05:45 PM',
        ];
    }
    protected $fillable = [
                            'name',
                            'DateTime',
                            'intention',
                            'others',
                            'intentionfor',
                            'email',
                            'mobile',
                            'language',
                            'mass_id',
                            'download_starttime',
                            'download_endtime',
                            'masstime_restriction',
                            'payment_status',
                            'payment_reference',
                            'amt',
                            'mass_id',
                            'date',
                            'surcharge',
                            'clientcode',
                            'signature',
                            'merchant_id',
                            'mer_txn',
                            'f_code',
                            'bank_txn',
                            'ipg_txn_id',
                            'bank_name',
                            'mmp_txn',
                            'udf5',
                            'udf6',
                            'udf3',
                            'udf4',
                            'udf1',
                            'udf2',
                            'discriminator',
                            'desc',
                            'auth_code'
                            ];
    
} 
