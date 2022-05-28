<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMintedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('minteds', function (Blueprint $table) {
            $table->enum('status', ['sold', 'suspended', 'unsold'])->default('unsold');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('minteds', function (Blueprint $table) {
            $table->removeColumn('status');
        });
    }
}
