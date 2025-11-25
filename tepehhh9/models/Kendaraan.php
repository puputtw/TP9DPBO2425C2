<?php

class Kendaraan{

    private $id;
    private $nama;
    private $jenis;
    private $mesin;
    private $top_speed;
    private $tahun_rilis;


    public function __construct($id, $nama, $jenis, $mesin, $top_speed, $tahun_rilis){
        $this->id = $id;
        $this->nama = $nama;
        $this->jenis = $jenis;
        $this->mesin = $mesin;
        $this->top_speed = $top_speed;
        $this->tahun_rilis = $tahun_rilis;
    }

    public function getId(){
        return $this->id;
    }
    public function getNama(){
        return $this->nama;
    }
    public function getJenis(){
        return $this->jenis;
    }
    public function getMesin(){
        return $this->mesin;
    }
    public function getTopSpeed(){
        return $this->top_speed;
    }
    public function getTahunRilis(){
        return $this->tahun_rilis;
    }

    public function setNama($nama){
        $this->nama = $nama;
    }
    public function setJenis($jenis){
        $this->jenis = $jenis;
    }
    public function setMesin($mesin){
        $this->mesin = $mesin;
    }
    public function setTopSpeed($top_speed){
        $this->top_speed = $top_speed;
    }
    public function setTahunRilis($tahun_rilis){
        $this->tahun_rilis = $tahun_rilis;
    }
}
?>