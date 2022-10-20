<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStampImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamp_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stamp_id');
            $table->foreign('stamp_id')->references('id')->on('stamps')->onDelete('cascade');
            $table->string('image_before_ticked');
            $table->string('image_after_ticked');
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
        Schema::dropIfExists('stamp_images');
    }
}
