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
            $table->string('filename'); // Ensure this matches your model
            $table->string('description')->nullable(); // Optional field
            $table->string('category')->nullable(); // Optional field
            $table->string('fileid')->nullable(); // Optional field, if needed

            // Define foreign key for the user_id
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); // Delete files if the user is deleted

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
        Schema::dropIfExists('files');
    }
};
