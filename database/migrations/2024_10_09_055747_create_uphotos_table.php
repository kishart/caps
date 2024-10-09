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
         Schema::dropIfExists('files'); // Drop the table if it already exists
     
         Schema::create('files', function (Blueprint $table) {
             $table->id();
             $table->string('filename'); // Store each uploaded file's name
             $table->text('description')->nullable(); // Allow storing longer descriptions
             $table->string('category')->nullable(); // Allow storing category for each file
             $table->foreignId('user_id')->constrained('users'); // Connect the file to a user
             $table->string('fileid')->nullable(); // Optional field if you need to track file batches or ids
             $table->timestamps(); // Store created_at and updated_at
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
