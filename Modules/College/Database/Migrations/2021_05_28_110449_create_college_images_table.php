<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId("college_id")->constrained()->onDelete('cascade');
            $table->foreignId("image_id")->constrained()->onDelete('cascade');
            $table->boolean("is_featured")->default(false);
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
        Schema::dropIfExists('college_images');
    }
}
