<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); // This creates created_at and updated_at columns
            $table->string('fname');
            $table->string('email');
            $table->string('phone');
            $table->date('date');
            $table->time('time');
            $table->string('details');
            $table->boolean('feedback_requested')->default(false);
            $table->boolean('feedback_given')->default(false);
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // User ID column

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
