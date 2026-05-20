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
        Schema::create('student_leaving_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->date('date_left')->nullable();
            $table->string('slc_no')->nullable();
            $table->text('reason')->nullable();
            $table->text('note')->nullable();
            $table->enum('leaving_type', ['withdrawal', 'transfer', 'expulsion', 'completion'])->nullable();
            $table->string('transferred_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_leaving_details');
    }
};
