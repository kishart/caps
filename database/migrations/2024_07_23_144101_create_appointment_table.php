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
            $table->string('status')->nullable();
            $table->string('user_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
