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
        Schema::create('data_kontens', function (Blueprint $table) {
            $table->id();
            $table->biginteger('idkonten');
            $table->string('subjudul');
            $table->longText('isi')->nullable();
            $table->string('image')->nullable();
            $table->boolean('aktif');
            $table->datetime('created_at');
            $table->string('created_by');
            $table->datetime('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kontens');
    }
};
