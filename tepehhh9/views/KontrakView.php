<?php

interface KontrakView
{
    public function tampilPembalap($listPembalap): string;
    public function tampilkanFormPembalap($data = null): string;
}

?>