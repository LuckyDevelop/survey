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
        Schema::create('list_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_jawaban_id');
            $table->foreign('jenis_jawaban_id')->references('id')->on('jenis_jawabans')->onDelete('cascade');
            $table->integer('nilai')->nullable();
            $table->string('label')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_jawabans');
    }
};