<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massbookings', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->DateTime("DateTime")->nullable();
            $table->string("intention")->nullable();
            $table->string("intentionfor")->nullable();
            $table->string("email")->nullable();
            $table->string("mobile")->nullable();   
            $table->string("language")->nullable();
            $table->float('amt')->nullable();
            $table->string("mass_id")->nullable();
            $table->string("date")->nullable();
            $table->string("surcharge")->nullable();
            $table->string("clientcode")->nullable();
            $table->string("signature")->nullable();
            $table->string("merchant_id")->nullable();
            $table->string("mer_txn")->nullable();
            $table->string("f_code")->nullable();
            $table->string("bank_txn")->nullable();
            $table->string("ipg_txn_id")->nullable();
            $table->string("bank_name")->nullable();
            $table->string("mmp_txn")->nullable();
            $table->string("udf5")->nullable();
            $table->string("udf6")->nullable();
            $table->string("udf3")->nullable();
            $table->string("udf4")->nullable();
            $table->string("udf1")->nullable();
            $table->string("udf2")->nullable();
            $table->string("discriminator")->nullable();
            $table->string("desc")->nullable();
            $table->string("auth_code")->nullable();
            $table->DateTime("download_starttime")->nullable();
            $table->DateTime("download_endtime")->nullable();
            $table->enum('masstime_restriction',['Yes', 'No'])->default('No');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('massbookings');
    }
}
