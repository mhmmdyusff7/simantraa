<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_perangkat', function (Blueprint $table) {
            $table->id();

            // Relasi ke OPD
            $table->unsignedBigInteger('opd_id');
            $table->foreign('opd_id')->references('id')->on('tb_opd')->onDelete('cascade');

            // Kategori perangkat
            $table->enum('kategori_perangkat', [
                'Perangkat Jaringan',
                'Perangkat Keras',
                'Perangkat Keamanan',
                'Bandwidth'
            ])->nullable();

            // === PERANGKAT JARINGAN ===
            $table->string('nama_perangkat_jaringan')->nullable();
            $table->integer('jaringan_lebihdari5_tahun')->nullable();
            $table->integer('jaringan_satusampai5_tahun')->nullable();
            $table->integer('jaringan_kurangdari1_tahun')->nullable();
            $table->integer('jaringan_jumlah')->nullable();
            $table->integer('jaringan_digunakan')->nullable();
            $table->integer('jaringan_tidakdigunakan')->nullable();
            $table->longText('jaringan_alasan_tidakdigunakan')->nullable();

            // === PERANGKAT KERAS ===
            $table->string('nama_perangkat_keras')->nullable();
            $table->integer('keras_lebihdari5_tahun')->nullable();
            $table->integer('keras_satusampai5_tahun')->nullable();
            $table->integer('keras_kurangdari1_tahun')->nullable();
            $table->integer('keras_jumlah')->nullable();
            $table->integer('keras_digunakan')->nullable();
            $table->integer('keras_tidakdigunakan')->nullable();
            $table->longText('keras_alasan_tidakdigunakan')->nullable();

            // === PERANGKAT KEAMANAN ===
            $table->string('nama_perangkat_keamanan')->nullable();
            $table->integer('keamanan_jumlah_perangkat')->nullable();
            $table->enum('keamanan_status_reviu', ['Digunakan', 'Tidak Digunakan'])->nullable();
            $table->longText('')->nullable();
            $table->string('keamanan_status_kepemilikan')->nullable();
            $table->string('keamanan_pengelola')->nullable();

            // === BANDWIDTH ===
            $table->string('bandwidth_nama_jaringan')->nullable();
            $table->string('bandwidth_mbps')->nullable();
            $table->string('bandwidth_jumlah_pemasangan')->nullable();
            $table->string('bandwidth_alasan_pengadaan')->nullable();
            $table->enum('bandwidth_status_reviu', ['Digunakan', 'Tidak Digunakan'])->nullable();
            $table->longText('bandwidth_penyesuaian_operasional')->nullable();

            $table->timestamps();
            $table->softDeletes(); // fitur soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_perangkat');
    }
};
