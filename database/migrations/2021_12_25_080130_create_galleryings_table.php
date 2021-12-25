<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleryings', function (Blueprint $table) {
                $table->id();
                $table->string('full_name');
                $table->string('title')->nullable();
                $table->string('email')->nullable();
                $table->string('telephone')->nullable();
                $table->boolean('is-owner')->default(false);
            $table->unsignedBigInteger('gallery_id')->nullable();
                $table->timestamps();
            $table->foreign('gallery_id')
                ->references('id')
                ->on('galleries')
                ->cascadeOnUpdate();
            });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleryings');
    }
}
