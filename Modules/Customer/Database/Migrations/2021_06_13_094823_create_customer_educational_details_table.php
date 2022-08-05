<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEducationalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_educational_details', function (Blueprint $table) {
            $table->id();
            $table->string('tenth_passing_year')->nullable();
            $table->string('tenth_grading_system')->nullable();
            $table->string('tenth_marks')->nullable();
            $table->string('twelve_passing_year')->nullable();
            $table->string('twelve_grading_system')->nullable();
            $table->string('twelve_marks')->nullable();
            $table->string('grad_passing_year')->nullable();
            $table->string('grad_grading_system')->nullable();
            $table->string('grad_marks')->nullable();
            $table->string('detail')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
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
        Schema::dropIfExists('customer_educational_details');
    }
}
