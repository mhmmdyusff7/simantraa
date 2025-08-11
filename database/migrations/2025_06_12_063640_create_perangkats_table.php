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
            $table->date('tanggal_pembelian_jaringan')->required();
            $table->string('kode_jaringan')-> required();
            $table->string('nama_jaringan')-> required();
            $table->string('spesifikasi_jaringan')-> required();
            $table->enum('status_jaringan', ['Baik', 'Perlu Diperbaiki', 'Rusak Berat'])-> required();
            $table->string('nama_ruangan_jaringan')-> required();
            $table->string('penanggung_jawab_jaringan')-> required();
            // === PERANGKAT KERAS ===
            $table->date('tanggal_pembelian_keras')-> required();
            $table->string('kode_keras')-> required();
            $table->string('nama_keras')-> required();
            $table->string('spesifikasi_keras')-> required();
            $table->enum('status_keras', ['Baik', 'Perlu Diperbaiki', 'Rusak Berat'])-> required();
            $table->string('nama_ruangan_keras')-> required();
            $table->string('penanggung_jawab_keras')-> required();
            // === PERANGKAT KEAMANAN ===
            $table->date('tanggal_pembelian_keamanan')-> required();
            $table->string('kode_keamanan')-> required();
            $table->string('nama_keamanan')-> required();
            $table->string('spesifikasi_keamanan')-> required();
            $table->enum('status_keamanan', ['Baik', 'Perlu Diperbaiki', 'Rusak Berat'])-> required();
            $table->string('nama_ruangan_keamanan')-> required();
            $table->string('penanggung_jawab_keamanan')-> required();
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
