<?php

interface KontrakModelKendaraan
{
    // READ
    public function getAllKendaraan(): array;
    public function getKendaraanById($id): ?array;

    // CREATE
    public function addKendaraan($nama, $jenis, $mesin, $top_speed, $tahun_rilis): void;

    // UPDATE
    public function updateKendaraan($id, $nama, $jenis, $mesin, $top_speed, $tahun_rilis): void;

    // DELETE
    public function deleteKendaraan($id): void;
}
?>