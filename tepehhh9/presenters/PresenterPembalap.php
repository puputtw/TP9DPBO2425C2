<?php

include_once(__DIR__ . "/KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelPembalap.php");
include_once(__DIR__ . "/../models/Pembalap.php");
include_once(__DIR__ . "/../views/KontrakView.php"); // Gunakan KontrakView

class PresenterPembalap implements KontrakPresenter
{
    private $tabelPembalap;
    private $viewPembalap;
    private $listPembalap = [];

    // Gunakan KontrakView pada View untuk kepastian kontrak
    public function __construct(TabelPembalap $tabelPembalap, KontrakView $viewPembalap) 
    {
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
        $this->initListPembalap();
    }

    public function initListPembalap(): void // Tambahkan type void
    {
        $data = $this->tabelPembalap->getAllPembalap();

        $this->listPembalap = [];
        foreach($data as $item) {
            $pembalap = new Pembalap(
                $item['id'],
                $item['nama'],
                $item['tim'],
                $item['negara'],
                (int)$item['poinMusim'], // Pastikan int
                (int)$item['jumlahMenang'] // Pastikan int
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    public function tampilkanPembalap(): string
    {
        $this->initListPembalap(); // Refresh data sebelum ditampilkan
        return $this->viewPembalap->tampilPembalap($this->listPembalap);
    }

    public function tampilkanFormPembalap($id = null): string
    {
        $data = null;
        if($id !== null) {
            $data = $this->tabelPembalap->getPembalapById($id);
        }
        return $this->viewPembalap->tampilkanFormPembalap($data);
    }

    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $this->tabelPembalap->addPembalap(
            $nama,
            $tim,
            $negara,
            $poinMusim,
            $jumlahMenang
        );
        $this->initListPembalap();
    }
    
    public function ubahPembalap( $id, $nama, $tim,  $negara, $poinMusim,  $jumlahMenang): void {
        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
        $this->initListPembalap();
    }
    
    public function hapusPembalap($id): void {
        $this->tabelPembalap->deletePembalap($id);
        $this->initListPembalap();
    }
}

?>