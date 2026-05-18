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
            $table->string('gender');
            $table->enum('bloodgroup', ['A+ve', 'A-ve', 'B+ve', 'B-ve', 'AB+ve', 'AB-ve', 'O+ve', 'O-ve'])->nullable(); // blood group type



            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('set null'); // Unit/Grade
            $table->enum('admission_type', ['new_admission', 'transfer', 'readmission'])->nullable(); // Admission type
            $table->enum('class', ['Junior', 'Senior', 'Advance'])->nullable(); // Class section
            $table->string('pak_no')->nullable(); // Pakistan ID number
            $table->foreignId('trade_id')->nullable()->constrained('trades')->onDelete('set null'); // Trade/Specialization
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('set null'); // Section within class
            $table->foreignId('religion_id')->nullable()->constrained('religions')->onDelete('set null'); // Religion
            $table->foreignId('rank_id')->nullable()->constrained('ranks')->onDelete('set null'); // Rank/Position
            $table->enum('admission_class', ['Junior', 'Senior', 'Advance'])->nullable(); // Admission class
            $table->foreignId('admission_section_id')->nullable()->constrained('sections')->onDelete('set null'); // Admission section

            $table->string('office_phone')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->text('address')->nullable();
            $table->enum('category', ['Officer', 'civilian', 'CNE'])->nullable(); // Student category
            $table->date('admission_date');
            $table->string('cnic_number')->nullable();
            $table->boolean('using_van')->default(false); // Using van transport
            $table->string('place_of_birth')->nullable();
            $table->integer('admission_year')->nullable();
            $table->text('reason')->nullable(); // Reason for leaving/notes
            $table->text('note')->nullable();
            $table->boolean('polio_vaccination')->default(false);
            $table->boolean('prospectus_issued')->default(false);
            $table->date('date_left')->nullable(); // Date when student left
            $table->string('slc_no')->nullable(); // School leaving certificate number
            $table->string('stu_image')->nullable(); // Student picture path
            $table->date('card_generated_date')->nullable();
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
