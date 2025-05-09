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
        Schema::create('clinical_records', function (Blueprint $table) {
            $table->id();
    
            // Información del paciente
            $table->string('name');
            $table->date('birthdate');
            $table->string('gender');
            $table->string('dpi')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('medical_record_number')->nullable();
    
            // Historial médico
            $table->text('conditions')->nullable();
            $table->text('surgeries')->nullable();
            $table->text('allergies')->nullable();
            $table->text('family_history')->nullable();
    
            // Medicamentos actuales
            $table->string('medication_name')->nullable();
            $table->string('medication_frequency')->nullable();
            $table->text('medication_observations')->nullable();
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinical_records');
    }
};
