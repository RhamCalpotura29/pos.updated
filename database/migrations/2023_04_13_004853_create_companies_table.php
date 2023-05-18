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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Project POS');
            $table->string('company_address')->default('Project POS address');
            $table->string('company_phone')->default('09563787498');
            $table->string('company_email')->default('20214556@s.ubaguio.edu');
            $table->string('company_fax')->default('+63 9563787498');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
