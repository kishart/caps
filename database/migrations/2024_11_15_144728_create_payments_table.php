<?php
// Run `php artisan make:migration create_payments_table` to create the migration

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade'); // Foreign key to the appointments table
            $table->enum('payment_method', ['gcash', 'in_person']); // Payment method
            $table->string('gcash_image')->nullable(); // Gcash image (for Gcash payment)
            $table->date('payment_date')->nullable(); // Date (for in-person payment)
            $table->time('payment_time')->nullable(); // Time (for in-person payment)
            $table->text('payment_details')->nullable(); // Payment details (for in-person payment)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
