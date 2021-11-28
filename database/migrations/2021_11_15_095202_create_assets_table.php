<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('bio')->nullable();
            $table->string('price')->nullable();
            $table->integer('ownership_percentage')->default(40);
            $table->integer('commission_percentage');
            $table->integer('royalties_percentage');
            $table->integer('total_fractions')->default(100);
            $table->integer('sold_fractions')->default(0);
            $table->timestamp('start_date')->default(\Carbon\Carbon::now());
            $table->timestamp('end_date')->nullable();
            $table->enum('status', ['published','unpublished'])->default('unpublished');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('artist_id');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate();

            $table->foreign('creator_id')
                ->references('id')
                ->on('galleries')
                ->cascadeOnUpdate();

            $table->foreign('artist_id')
                ->references('id')
                ->on('artists')
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
        Schema::dropIfExists('assets');
    }
}
