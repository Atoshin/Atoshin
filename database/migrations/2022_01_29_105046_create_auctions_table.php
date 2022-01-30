<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {

            $table->string('material')->nullable();
            $table->string('size')->nullable();
            $table->integer('creation_date')->nullable();
            $table->string('asset_name')->nullable();
            $table->string('auction_name')->nullable();
            $table->date('auction_date')->nullable();
            $table->string('sold_price')->nullable();
            $table->string('estimated_price')->nullable();
            $table->string('hammer_price')->nullable();
            $table->unsignedBigInteger('artist_id');

            $table->foreign('artist_id')
                ->references('id')
                ->on('artists')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->id();
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
        Schema::dropIfExists('auctions');
    }
}
