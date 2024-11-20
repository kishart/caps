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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('fname')->nullable(); // Make sure the fname field is added
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('fname'); // In case you want to rollback
        });
    }
};
