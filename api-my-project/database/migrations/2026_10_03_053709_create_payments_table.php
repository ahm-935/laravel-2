<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->string('transaction_id')->unique();
            $table->string('validation_id')->nullable();

            $table->decimal('amount', 10, 2);

            $table->string('currency', 10)
                ->default('BDT');

            $table->string('payment_method')
                ->nullable();

            $table->string('status', 20)
                ->default('pending');

            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};