<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_sdm_tik', function (Blueprint $table) {
            $table->id();

            // Relasi ke OPD
            $table->unsignedBigInteger('opd_id');
            $table->foreign('opd_id')->references('id')->on('tb_opd')->onDelete('cascade');
            $table->string('nama_sdm_tik')->nullable();
            $table->enum('tik_status_pegawai',['PNS','CPNS','P3K','Outsourcing (OS)'])->nullable();
            $table->enum('status_reviu_pegawai', ['Tetap','Pindah'])->nullable();
            $table->string('alasan_pindah')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('kompetensi_pekerjaan')->nullable();
            $table->string('tupoksi')->nullable();
            $table->string('pengalaman_training')->nullable();
            $table->string('sertifikasi')->nullable();
            $table->timestamps();
            $table->softDeletes(); // fitur soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_sdm_tik');
    }
};
