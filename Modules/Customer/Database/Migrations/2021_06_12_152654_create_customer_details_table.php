<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
           // $table->string('avatar')->nullable();
            $table->string("first_name");
            $table->string("last_name");
            $table->string('phone')->nullable();
            $table->enum('gender',Config::get('constants.gender'))->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();
            $table->string('detail')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->foreignId('state_id')->nullable()->constrained('states');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_details');
    }
}
