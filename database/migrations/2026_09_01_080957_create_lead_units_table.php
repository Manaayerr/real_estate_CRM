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
        Schema::create('lead_units', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lead_id')
                ->constrained('leads')
                ->cascadeOnDelete();

            $table->foreignId('unit_id')
                ->constrained('units')
                ->cascadeOnDelete();

            $table->string('interest_status')->default('interested');
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['lead_id', 'unit_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_units');
    }
};