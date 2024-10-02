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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('filename'); // Make sure this matches your model
            $table->string('description')->nullable();
            $table->string('category')->nullable();
            $table->string('username')->nullable();
            $table->string('fileid')->nullable(); // If you have this field
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
        Schema::dropIfExists('uphotos');
    }
};
