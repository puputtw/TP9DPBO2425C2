<?php



require_once __DIR__ . '/../models/DB.php';

interface KontrakPresenterKendaraan
{
    // method untuk tampilkan kendaraan
    public function tampilkanKendaraan(): string;

    // method untuk tampilkan form kendaraan (untuk tambah/ubah)
    public function tampilkanFormKendaraan($id = null): string;

    // method untuk CRUD kendaraan
    public function tambahKendaraan(string $nama, string $jenis, string $mesin, int $top_speed, int $tahun_rilis): void;
    public function ubahKendaraan(int $id, string $nama, string $jenis, string $mesin, int $top_speed, int $tahun_rilis): void;
    public function hapusKendaraan(int $id): void;
    
    // method untuk inisialisasi list
    public function initListKendaraan(): void;
}
?>