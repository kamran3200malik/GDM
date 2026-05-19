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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('form_number')->unique(); // Student form number
            $table->string('student_name'); // Full name
            $table->string('father_name'); // Father name
            $table->string('mother_name'); // mother name
            $table->date('dob'); // Date of birth
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('current_class', ['Junior', 'Senior', 'Advance'])->nullable(); // Class section
            $table->foreignId('current_section_id')->nullable()->constrained('sections')->onDelete('set null');
            $table->foreignId('place_of_birth_tehseel_id')->nullable()->constrained('tehseels')->onDelete('set null');
            $table->string('image')->nullable();
            $table->string('religion')->nullable();
            $table->enum('bloodgroup', ['A+ve', 'A-ve', 'B+ve', 'B-ve', 'AB+ve', 'AB-ve', 'O+ve', 'O-ve'])->nullable();
            $table->boolean('polio_vaccination')->default(false);
            $table->foreignId('religion_id')->nullable()->constrained('religions')->onDelete('set null'); // Religion
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
