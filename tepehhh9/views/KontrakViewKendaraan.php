<?php

interface KontrakViewKendaraan
{
    public function tampilKendaraan(array $listKendaraan): string;
    public function tampilkanFormKendaraan(?array $data = null): string;
}
?>