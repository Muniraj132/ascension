<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masses', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedInteger();
        //     $table->string("name")->nullable();
        //     $table->string("mass_intention")->nullable();
        //     $table->string("mass_offered")->nullable();
        //     $table->string("date")->nullable();
        //     $table->string("mass_time")->nullable();
        //     $table->string("number_of_days")->nullable();
        //     $table->string("email")->nullable();
        //     $table->string("phone")->nullable();
        //     $table->string("place")->nullable();
        //     $table->timestamps();
        // });
            $table->id();
            $table->string("name")->nullable();
            $table->string("mass_id")->nullable();
            $table->string("intention")->nullable();
            $table->string("mailto:email")->nullable();
            $table->string("mobile")->nullable();
            $table->string("prayer_category_id")->nullable();
            $table->string("payment_status")->nullable();
            $table->string("payment_reference")->nullable();
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
        Schema::dropIfExists('masses');
    }
}
