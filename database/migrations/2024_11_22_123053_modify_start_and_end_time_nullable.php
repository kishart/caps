<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->time('start_time')->nullable()->change();
            $table->time('end_time')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->time('start_time')->nullable(false)->change();
            $table->time('end_time')->nullable(false)->change();
        });
    }
};
