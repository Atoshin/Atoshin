<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->integer('mediable_id');
            $table->string('mediable_type');
            $table->string('ipfs_hash')->nullable();
            $table->boolean('main')->default(false);
            $table->boolean('homeapage_picture')->default(false);
            $table->string('path');
            $table->string('mime_type');
            $table->boolean('video')->default(false);

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
        Schema::dropIfExists('media');
    }
}
