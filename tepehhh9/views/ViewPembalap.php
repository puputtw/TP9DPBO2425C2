<?php

include_once ("KontrakView.php");
include_once __DIR__ . "/../models/Pembalap.php";


class ViewPembalap implements KontrakView{

    public function __construct(){
        // Konstruktor kosong
    }

    // Method untuk menampilkan daftar pembalap
    public function tampilPembalap($listPembalap): string {
        // Build table rows
        $tbody = '';
        $no = 1;
        foreach($listPembalap as $pembalap){
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getNama()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getTim()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getNegara()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getPoinMusim()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getJumlahMenang()) .'</td>';
            $tbody .= '<td class="col-actions">
                    <a href="index.php?screen=edit&id='. $pembalap->getId() .'" class="btn btn-edit">Edit</a>
                    <button data-id="'. $pembalap->getId() .'" class="btn btn-delete">Delete</button>
                  </td>';
            $tbody .= '</tr>';
            $no++;
        }

        // --- Perbaikan Injeksi Data dan Header ---
        $templatePath = __DIR__ . '/../template/skin.html';
        $template = '';
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            
            // 1. Injeksi Baris Data yang sudah benar
            $template = str_replace('_DATA_BARIS_', $tbody, $template);
            
            // 2. Injeksi Header Pembalap
            $headerPembalap = '<th>Tim</th><th>Negara</th><th>Poin Musim</th><th>Jumlah Menang</th>';
            $template = str_replace('_HEADER_DINAMIS_', $headerPembalap, $template);

            // 3. Update Total
            $total = count($listPembalap);
            $template = str_replace('_TOTAL_DATA_', $total, $template);
            
            // 4. Update tab active class
            $template = str_replace('_TAB_PEMBALAP_CLASS_', 'tab-active', $template);
            $template = str_replace('_TAB_KENDARAAN_CLASS_', 'btn-muted', $template);
            
            return $template;
        }

        return $tbody; // Fallback
    }

    // Method untuk menampilkan form tambah/ubah pembalap (sisanya sama)
    public function tampilkanFormPembalap($data = null): string {
        $template = file_get_contents(__DIR__ . '/../template/form.html');
        // ... Logika form tetap sama ...
        if ($data) {
            $template = str_replace('value="add" id="pembalap-action"', 'value="update" id="pembalap-action"', $template);
            $template = str_replace('value="" id="pembalap-id"', 'value="' . htmlspecialchars($data['id']) . '" id="pembalap-id"', $template);
            $template = str_replace('id="nama" name="nama" type="text" placeholder="Nama pembalap"', 'id="nama" name="nama" type="text" placeholder="Nama pembalap" value="' . htmlspecialchars($data['nama']) . '"', $template);
            $template = str_replace('id="tim" name="tim" type="text" placeholder="Nama tim"', 'id="tim" name="tim" type="text" placeholder="Nama tim" value="' . htmlspecialchars($data['tim']) . '"', $template);
            $template = str_replace('id="negara" name="negara" type="text" placeholder="Negara (mis. Indonesia)"', 'id="negara" name="negara" type="text" placeholder="Negara (mis. Indonesia)" value="' . htmlspecialchars($data['negara']) . '"', $template);
            $template = str_replace('id="poinMusim" name="poinMusim" type="number" min="0" step="1" placeholder="0"', 'id="poinMusim" name="poinMusim" type="number" min="0" step="1" placeholder="0" value="' . htmlspecialchars($data['poinMusim']) . '"', $template);
            $template = str_replace('id="jumlahMenang" name="jumlahMenang" type="number" min="0" step="1" placeholder="0"', 'id="jumlahMenang" name="jumlahMenang" type="number" min="0" step="1" placeholder="0" value="' . htmlspecialchars($data['jumlahMenang']) . '"', $template);
        }
        return $template;
    }
}
?>