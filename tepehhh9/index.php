<?php


// Pastikan semua file di-include_once untuk menghindari error redeclaring class
include_once("models/DB.php");

// INCLUDE UNTUK PEMBALAP
include_once("models/Pembalap.php");
include_once("models/TabelPembalap.php");
include_once("views/KontrakView.php");
include_once("views/ViewPembalap.php");
include_once("presenters/KontrakPresenter.php");
include_once("presenters/PresenterPembalap.php");

// INCLUDE UNTUK KENDARAAN
include_once("models/Kendaraan.php");
include_once("models/TabelKendaraan.php");
include_once("views/KontrakViewKendaraan.php");
include_once("views/ViewKendaraan.php");
include_once("presenters/KontrakPresenterKendaraan.php");
include_once("presenters/PresenterKendaraan.php");


// INISIALISASI PEMBALAP
// ASUMSI: Host, DB, User, dan Password sudah benar
$tabelPembalap = new TabelPembalap('localhost', 'mvp_db', 'root', ''); 
$viewPembalap = new ViewPembalap();
$presenterPembalap = new PresenterPembalap($tabelPembalap, $viewPembalap);

// INISIALISASI KENDARAAN
$tabelKendaraan = new TabelKendaraan('localhost', 'mvp_db', 'root', '');
$viewKendaraan = new ViewKendaraan();
$presenterKendaraan = new PresenterKendaraan($tabelKendaraan, $viewKendaraan);


// --- LOGIKA GET (Menampilkan Halaman) ---
if(isset($_GET['screen'])){

    $screen = $_GET['screen'];
    
    
    // ROUTING PEMBALAP
    if($screen == 'add'){ // Form Tambah Pembalap
        echo $presenterPembalap->tampilkanFormPembalap();
    }
    else if($screen == 'edit' && isset($_GET['id'])){ // Form Ubah Pembalap
        echo $presenterPembalap->tampilkanFormPembalap($_GET['id']);
    }
    else if($screen == 'pembalap_list'){ // Daftar Pembalap (opsional, default sudah ke sini)
        echo $presenterPembalap->tampilkanPembalap();
    }

    // ROUTING KENDARAAN
    else if($screen == 'kendaraan_list'){ // Daftar Kendaraan
        echo $presenterKendaraan->tampilkanKendaraan();
    }
    else if($screen == 'kendaraan_add'){ // Form Tambah Kendaraan
        echo $presenterKendaraan->tampilkanFormKendaraan();
    }
    else if($screen == 'kendaraan_edit' && isset($_GET['id'])){ // Form Ubah Kendaraan
        echo $presenterKendaraan->tampilkanFormKendaraan($_GET['id']);
    }
} 


// --- LOGIKA POST (Aksi CRUD) ---
// Di index.php, ganti seluruh blok LOGIKA POST
else if(isset($_POST['action'])){
    
    $action = $_POST['action'];
    $id = $_POST['id'] ?? null;
    $redirectUrl = 'index.php'; // Default redirect ke Daftar Pembalap
    
    // TINDAKAN CRUD PEMBALAP
    if($action == "add") {
        $presenterPembalap->tambahPembalap(
            $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']
        );
    }
    else if($action == "update") {
        $presenterPembalap->ubahPembalap(
            $id, $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']
        );
    }
    else if($action == "delete") {
        $presenterPembalap->hapusPembalap($id);
    }
    
    // TINDAKAN CRUD KENDARAAN
    else if($action == "kendaraan_add") {
        $presenterKendaraan->tambahKendaraan(
            $_POST['nama'], $_POST['jenis'], $_POST['mesin'], $_POST['top_speed'], $_POST['tahun_rilis']
        );
        $redirectUrl = 'index.php?screen=kendaraan_list'; // <-- SET REDIRECT KENDARAAN
    }
    else if($action == "kendaraan_update") {
        $presenterKendaraan->ubahKendaraan(
            $id, $_POST['nama'], $_POST['jenis'], $_POST['mesin'], $_POST['top_speed'], $_POST['tahun_rilis']
        );
        $redirectUrl = 'index.php?screen=kendaraan_list'; // <-- SET REDIRECT KENDARAAN
    }
    else if($action == "kendaraan_delete") {
        $presenterKendaraan->hapusKendaraan($id);
        $redirectUrl = 'index.php?screen=kendaraan_list'; // <-- SET REDIRECT KENDARAAN
    }

    // Arahkan kembali ke halaman yang sesuai setelah aksi
    header('location: ' . $redirectUrl); // <-- GUNAKAN VARIABEL $redirectUrl

} else {
    // Tampilan default (saat index.php dipanggil tanpa parameter)
    // Kita tetap default ke Pembalap (index.php)
    echo $presenterPembalap->tampilkanPembalap();
}