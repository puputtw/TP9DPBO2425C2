<?php

include_once ("KontrakViewKendaraan.php");
// Asumsi Anda sudah membuat models/Kendaraan.php
include_once __DIR__ . "/../models/Kendaraan.php"; // P

class ViewKendaraan implements KontrakViewKendaraan {

    public function __construct(){}

    // Method untuk menampilkan daftar kendaraan (Menggunakan skin.html)
    public function tampilKendaraan($listKendaraan): string {
        $tbody = '';
        $no = 1;
        
        foreach($listKendaraan as $kendaraan){
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($kendaraan->getNama()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($kendaraan->getJenis()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($kendaraan->getMesin()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($kendaraan->getTopSpeed()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($kendaraan->getTahunRilis()) .'</td>';
            $tbody .= '<td class="col-actions">
                    <a href="index.php?screen=kendaraan_edit&id='. $kendaraan->getId() .'" class="btn btn-edit">Edit</a>
                    <button data-id="'. $kendaraan->getId() .'" class="btn btn-delete btn-delete-kendaraan">Delete</button>
                  </td>';
            $tbody .= '</tr>';
            $no++;
        }

        $template = file_get_contents(__DIR__ . "/../template/skin.html");
        
        // 1. Ganti Judul
        $template = str_replace('Pembalap — Daftar', 'Kendaraan — Daftar', $template);
        $template = str_replace('Daftar Pembalap', 'Daftar Kendaraan', $template);
        $template = str_replace('List data Pembalap yang tersimpan dalam sistem.', 'List data Kendaraan yang tersimpan dalam sistem.', $template);
        
        // 2. Ganti Header Kolom (Mengganti placeholder _HEADER_DINAMIS_)
        $headerKendaraan = '<th>Jenis</th><th>Mesin</th><th>Top Speed (km/h)</th><th>Tahun Rilis</th>';
        $template = str_replace('_HEADER_DINAMIS_', $headerKendaraan, $template); 
        
        // 3. Inject data baris (Mengganti placeholder _DATA_BARIS_)
        $template = str_replace('_DATA_BARIS_', $tbody, $template);
        
        // 4. Ganti Tombol Tambah dan JavaScript Delete Logic
        $template = str_replace('+ Tambah Pembalap', '+ Tambah Kendaraan', $template);
        $template = str_replace('index.php?screen=add', 'index.php?screen=kendaraan_add', $template);
        
        // 5. Update Total
        $total = count($listKendaraan);
        $template = str_replace('_TOTAL_DATA_', $total, $template);
        
        // 6. Update tab active class
        $template = str_replace('_TAB_PEMBALAP_CLASS_', 'btn-muted', $template);
        $template = str_replace('_TAB_KENDARAAN_CLASS_', 'tab-active', $template);

        return $template;
    }

    // Method untuk menampilkan form tambah/ubah kendaraan (sisanya sama)
    public function tampilkanFormKendaraan(?array $data = null): string {
        $template = file_get_contents(__DIR__ . '/../template/form.html');$template = file_get_contents(__DIR__ . '/../template/form.html');
        
        $isUpdate = $data !== null;
        $title = $isUpdate ? 'Ubah Data Kendaraan' : 'Tambah Data Kendaraan';
        $action_val = $isUpdate ? 'kendaraan_update' : 'kendaraan_add';

        $id_val = $data['id'] ?? '';
        $nama_val = $data['nama'] ?? '';
        $jenis_val = $data['jenis'] ?? '';
        $mesin_val = $data['mesin'] ?? '';
        $top_speed_val = $data['top_speed'] ?? '';
        $tahun_rilis_val = $data['tahun_rilis'] ?? '';

        // --- 1. Ganti Judul dan Action Form ---
        $template = str_replace('Tambah Data Pembalap', $title, $template);
        
        // Ganti name & id untuk action dan id
        $template = str_replace('id="pembalap-action"', 'id="kendaraan-action"', $template);
        $template = str_replace('id="pembalap-id"', 'id="kendaraan-id"', $template);

        $template = str_replace('value="add"', 'value="' . $action_val . '"', $template);
        $template = str_replace('value="" id="kendaraan-id"', 'value="' . htmlspecialchars($id_val) . '" id="kendaraan-id"', $template);

        // --- 2. Ganti Label dan Input Field Pembalap menjadi Kendaraan ---
        
        // Nama (Inject value dan ganti placeholder)
        $template = str_replace('placeholder="Nama pembalap"', 'placeholder="Nama Model Kendaraan"', $template);
        $template = str_replace(
            'id="nama" name="nama" type="text" placeholder="Nama Model Kendaraan" required data-field', 
            'id="nama" name="nama" type="text" placeholder="Nama Model Kendaraan" value="' . htmlspecialchars($nama_val) . '" required data-field', 
            $template
        );
        
        // Tim diganti Jenis
        $template = str_replace('<label for="tim">Tim</label>', '<label for="jenis">Jenis</label>', $template);
        $template = str_replace('id="tim" name="tim" type="text" placeholder="Nama tim" required data-field', 'id="jenis" name="jenis" type="text" placeholder="Mobil / Motor" required data-field value="' . htmlspecialchars($jenis_val) . '"', $template);

        // Negara diganti Mesin
        $template = str_replace('<label for="negara">Negara</label>', '<label for="mesin">Mesin</label>', $template);
        $template = str_replace('id="negara" name="negara" type="text" placeholder="Negara (mis. Indonesia)" data-field', 'id="mesin" name="mesin" type="text" placeholder="Spesifikasi Mesin" data-field value="' . htmlspecialchars($mesin_val) . '"', $template);
        
        // Poin Musim diganti Top Speed
        $template = str_replace('<label for="poinMusim">Poin Musim</label>', '<label for="top_speed">Top Speed (km/h)</label>', $template);
        $template = str_replace('id="poinMusim" name="poinMusim" type="number" min="0" step="1" placeholder="0" data-field', 'id="top_speed" name="top_speed" type="number" min="100" step="1" placeholder="300" data-field value="' . htmlspecialchars($top_speed_val) . '"', $template);

        // Jumlah Menang diganti Tahun Rilis
        $template = str_replace('<label for="jumlahMenang">Jumlah Menang</label>', '<label for="tahun_rilis">Tahun Rilis</label>', $template);
        $template = str_replace('id="jumlahMenang" name="jumlahMenang" type="number" min="0" step="1" placeholder="0" data-field', 'id="tahun_rilis" name="tahun_rilis" type="number" min="1950" step="1" placeholder="2024" data-field value="' . htmlspecialchars($tahun_rilis_val) . '"', $template);

        // Ganti Tombol Simpan
        $template = str_replace('Simpan', $isUpdate ? 'Simpan Perubahan' : 'Tambah Kendaraan', $template);

        return $template;
    }
}
?>