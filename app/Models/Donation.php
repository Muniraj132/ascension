<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
                            'name',
                            'email',
                            'mobile',
                            'payment_status',
                            'payment_reference',
                            'amt',
                            'comments',
                            'address',
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