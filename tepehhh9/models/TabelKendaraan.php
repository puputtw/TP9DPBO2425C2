<?php

include_once ("models/DB.php");
include_once ("KontrakModelKendaraan.php");

// Pastikan class ini mengimplementasikan KontrakModelKendaraan
class TabelKendaraan extends DB implements KontrakModelKendaraan {

    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // --- READ: Mendapatkan semua data kendaraan ---
    public function getAllKendaraan(): array {
        $query = "SELECT * FROM kendaraan";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    // --- READ: Mendapatkan data kendaraan berdasarkan ID ---
    // CATATAN: Method ini menggunakan Parameter Binding yang lebih aman.
    public function getKendaraanById($id): ?array {
        $query = "SELECT * FROM kendaraan WHERE id = :id";
        $this->executeQuery($query, ['id' => $id]);
        $results = $this->getAllResult();
        return $results[0] ?? null;
    }

    // --- CREATE: Menambah data kendaraan baru ---
    // MENGGUNAKAN QUERY LANGSUNG (Sesuai permintaan Anda)
    public function addKendaraan($nama, $jenis, $mesin, $top_speed, $tahun_rilis): void {
        // Perhatikan tanda petik (') untuk string (nama, jenis, mesin) dan tidak ada petik untuk integer (top_speed, tahun_rilis)
        $query = "INSERT INTO kendaraan (nama, jenis, mesin, top_speed, tahun_rilis) 
                  VALUES ('$nama', '$jenis', '$mesin', $top_speed, $tahun_rilis)";
        $this->executeQuery($query);
    }


    // --- UPDATE: Mengubah data kendaraan ---
    // MENGGUNAKAN QUERY LANGSUNG (Sesuai permintaan Anda)
    public function updateKendaraan($id, $nama, $jenis, $mesin, $top_speed, $tahun_rilis): void {
        // Perhatikan tanda petik (') untuk string dan tidak ada petik untuk integer
        $query = "UPDATE kendaraan 
                  SET nama = '$nama', jenis = '$jenis', mesin = '$mesin', top_speed = $top_speed, tahun_rilis = $tahun_rilis
                  WHERE id = $id";
        $this->executeQuery($query);
    } // <-- BRACKET PENUTUP UNTUK updateKendaraan()

    // --- DELETE: Menghapus data kendaraan ---
    // CATATAN: Method ini menggunakan Parameter Binding yang lebih aman.
    public function deleteKendaraan($id): void {
        $query = "DELETE FROM kendaraan WHERE id = :id";
        $this->executeQuery($query, ['id' => $id]);
    }
}
?>