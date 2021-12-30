<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->double('lat')->nullable();
            $table->double('long')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->unsignedBigInteger('gallery_id')->nullable();
            $table->timestamps();

            $table->foreign('gallery_id')
                ->references('id')
                ->on('galleries')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
