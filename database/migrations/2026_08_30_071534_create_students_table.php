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
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->string('roll_no');
            $table->string('admission_no');
            $table->string('name');
            $table->string('father_name');
            $table->string('gender');
            $table->string('dob');
            $table->string('b_form_no')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('nationality')->nullable();
            $table->string('previous_school')->nullable();

            $table->string('father_occupation')->nullable();
            $table->string('father_contact_numer');
            $table->string('mother_name')->nullable();
            $table->string('mother_contact_numer')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_contact_numer')->nullable();
            $table->string('guardian_email')->nullable();

            $table->string('address');
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();

            $table->date('admission_date');
            $table->foreignId('class_section_id')->constrained('class_sections')->cascadeOnDelete();
            $table->string('admission_type');
            $table->string('previous_class')->nullable();
            $table->boolean('transport_required')->default(false)->nullable();

            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('medical_conditions')->nullable();

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
