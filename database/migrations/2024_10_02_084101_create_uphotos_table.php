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
         Schema::dropIfExists('files');  // Drop the table if it already exists
     
         Schema::create('files', function (Blueprint $table) {
             $table->id();
             $table->string('filename');
             $table->string('description')->nullable();
             $table->string('category')->nullable();
             $table->foreignId('user_id')->constrained('users');  // Connect file to user
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
        // Schema::dropIfExists('uphotos');
        Schema::dropIfExists('files');

    }
};
