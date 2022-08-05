<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('reactions', function (Blueprint $table) {
        //     // $table->id()->autoIncrement();
        //     // $table->morphs("reactionable");
        //     // $table->foreignId('customer_id')->constrained('customers');
        //     // $table->string('upvote')->nullable();
        //     // $table->string('downvote')->nullable();
        //     // $table->string('report')->nullable();
        //     // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reactions');
    }
}
