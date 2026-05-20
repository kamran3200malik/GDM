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
        Schema::create('student_admission_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->date('admission_date');
            $table->integer('admission_year')->nullable();
            $table->enum('admission_type', ['new_admission', 'transfer', 'readmission'])->nullable();
            $table->enum('admission_class', ['Junior', 'Senior', 'Advance'])->nullable();
            $table->foreignId('admission_section_id')->nullable()->constrained('sections')->onDelete('set null');
            $table->boolean('prospectus_issued')->default(false);
            $table->date('card_generated_date')->nullable();
            $table->string('previous_school')->nullable();
            $table->text('admission_notes')->nullable();
            $table->date('current_admission_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_admission_details');
    }
};
