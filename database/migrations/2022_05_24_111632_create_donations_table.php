<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("mobile")->nullable();   
            $table->float('amt')->nullable();
            $table->string("date")->nullable();
            $table->string("comments")->nullable();
            $table->string("address")->nullable();
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
        Schema::dropIfExists('donations');
    }
}
