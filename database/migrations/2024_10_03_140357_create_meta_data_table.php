<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_data', function (Blueprint $table) {
            $table->id();
            $table->string('metadata_uri')->nullable();
            $table->integer('token_id')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')
                ->references('id')
                ->on('assets')
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
        Schema::dropIfExists('meta_data');
    }
}
