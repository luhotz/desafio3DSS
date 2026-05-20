<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('court_id')
                ->constrained('courts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->date('reservation_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['Pendiente', 'Confirmada', 'Cancelada', 'Finalizada'])->default('Pendiente');
            $table->text('notes')->nullable();
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();

            $table->index(['reservation_date', 'status']);
            $table->unique(['court_id', 'reservation_date', 'start_time'], 'unique_court_schedule');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
