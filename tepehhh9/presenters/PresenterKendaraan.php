<?php

include_once(__DIR__ . "/KontrakPresenterKendaraan.php");
include_once(__DIR__ . "/../models/TabelKendaraan.php");
include_once(__DIR__ . "/../models/Kendaraan.php");
include_once(__DIR__ . "/../views/KontrakViewKendaraan.php"); // Gunakan KontrakView

class PresenterKendaraan implements KontrakPresenterKendaraan
{
    private $tabelKendaraan; 
    private $viewKendaraan;  
    private $listKendaraan = []; 

    public function __construct(TabelKendaraan $tabelKendaraan, KontrakViewKendaraan $viewKendaraan)
    {
        $this->tabelKendaraan = $tabelKendaraan;
        $this->viewKendaraan = $viewKendaraan;
        $this->initListKendaraan(); 
    }

    public function initListKendaraan(): void
    {
        $data = $this->tabelKendaraan->getAllKendaraan();

        $this->listKendaraan = []; 
        foreach ($data as $item) {
            $kendaraan = new Kendaraan(
                (int)$item['id'],
                $item['nama'],
                $item['jenis'],
                $item['mesin'],
                (int)$item['top_speed'],
                (int)$item['tahun_rilis']
            );
            $this->listKendaraan[] = $kendaraan;
        }
    }

    public function tampilkanKendaraan(): string
    {
        $this->initListKendaraan(); // Refresh data sebelum ditampilkan
        return $this->viewKendaraan->tampilKendaraan($this->listKendaraan);
    }

    public function tampilkanFormKendaraan( $id = null): string
    {
        $data = null;
        if ($id != null) {
            $data = $this->tabelKendaraan->getKendaraanById($id);
        }
        return $this->viewKendaraan->tampilkanFormKendaraan($data);
    }
    
    public function tambahKendaraan($nama, $jenis, $mesin,$top_speed, int $tahun_rilis): void {
        $this->tabelKendaraan->addKendaraan($nama, $jenis, $mesin, $top_speed, $tahun_rilis);
        $this->initListKendaraan();
    }

    public function ubahKendaraan($id,$nama, $jenis, $mesin, $top_speed, $tahun_rilis): void {
        $this->tabelKendaraan->updateKendaraan($id, $nama, $jenis, $mesin, $top_speed, $tahun_rilis);
        $this->initListKendaraan();
    }

    public function hapusKendaraan($id): void {
        $this->tabelKendaraan->deleteKendaraan($id);
        $this->initListKendaraan();
    }
}
?>