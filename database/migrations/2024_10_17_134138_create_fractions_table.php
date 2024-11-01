<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fractions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nft_id');
            $table->unsignedBigInteger('total_supply');
            $table->unsignedBigInteger('gallery_supply');
            $table->string('transaction_hash');
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
        Schema::dropIfExists('fractions');
    }
}
