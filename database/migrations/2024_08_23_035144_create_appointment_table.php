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
            $table->string('fname')->nullable(); 
            $table->string('email')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->date('date')->nullable(); 
            $table->time('time')->nullable(); 
            $table->string('details')->nullable(); 
            $table->boolean('feedback_requested')->default(false);
            $table->boolean('feedback_given')->default(false);
            $table->string('status')->nullable();
            $table->decimal('downpayment', 10, 2)->nullable(); 
            $table->decimal('payments', 10, 2)->nullable(); // Payment amount
            $table->enum('payment_method', ['gcash', 'in_person'])->nullable(); // Payment method
            $table->string('gcash_image')->nullable(); // GCash image
            $table->date('payment_date')->nullable(); // Payment date
            $table->time('payment_time')->nullable(); // Payment time
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
