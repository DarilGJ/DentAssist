<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_confirmations', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->index()->unique();
            $table->string('link');
            $table->foreignId('appointment_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_confirmations');
    }
};
