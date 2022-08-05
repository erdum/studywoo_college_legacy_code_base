<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeSubpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_subpages', function (Blueprint $table) {
            $table->id();
            $table->foreignId("college_id")->constrained()->onDelete('cascade');
            $table->string("title");
            $table->string("slug");
            $table->text("content")->nullable();
            $table->string('type')->default("default");
            $table->string('created_by')->nullable();
            $table->foreignId('seo_id')->nullable()->constrained('seos')->onDelete('cascade');
            $table->boolean('active_status')->default(1);
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
        Schema::dropIfExists('college_subpages');
    }
}
