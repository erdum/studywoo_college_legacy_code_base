<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeEntranceExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_entrance_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('college_id')->constrained('colleges');
            $table->foreignId('entrance_exam_id')->constrained('entrance_exams');
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
        Schema::dropIfExists('college_entrance_exams');
    }
}
