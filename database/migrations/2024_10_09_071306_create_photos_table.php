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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->json('photo_paths'); // This will store an array of paths
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id'); // Use this if you still want to store the user ID without the foreign key constraint.
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
        Schema::dropIfExists('testphotos');
    }
};
