<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
    $table->id();

    $table->foreignId('assigned_user_id')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->string('full_name');
    $table->string('phone');
    $table->string('email')->nullable();

    $table->decimal('budget', 12, 2)->nullable();

    $table->string('purchase_purpose')->nullable();
    $table->string('payment_method')->nullable();
    $table->string('source')->nullable();

    $table->string('status')->default('new');

    $table->text('notes')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
