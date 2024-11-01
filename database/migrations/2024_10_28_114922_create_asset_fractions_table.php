<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetFractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_fractions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('total_supply');
            $table->unsignedBigInteger('gallery_supply');
            $table->unsignedBigInteger('atoshin_supply');
            $table->string('token_name');
            $table->string('token_symbol');
            $table->string('token_address');
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
        Schema::dropIfExists('asset_fractions');
    }
}
