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
        Schema::create('gaurdian_details', function (Blueprint $table) {
            $table->id();
            $table->morphs('personalable');
            $table->enum('category', ['Officer', 'civilian', 'CNE'])->nullable();
            $table->string('pak_no')->nullable();
            $table->string('cnic_number')->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('set null'); // Unit/Grade
            $table->foreignId('trade_id')->nullable()->constrained('trades')->onDelete('set null'); // Trade/Specialization
            $table->string('section')->nullable(); // Section
            $table->foreignId('rank_id')->nullable()->constrained('ranks')->onDelete('set null'); // Rank/Position
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaurdian_details');
    }
};
