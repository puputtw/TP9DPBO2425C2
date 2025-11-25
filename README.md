# TP9DPBO2425C2

## Janji: 
   Saya Putri Ramadhani dengan NIM 2410975 mengerjakan TP 9 dalam mata kuliah Desain Pemrograman Berorienrasi Objek,
   untuk keberkahannya saya tidak akan melakukan kecurangan seperti yang telah dispesifikasikan,Aamiin.

## Desain Program:
   Program ini menggunakan pola arsitektur MVP
   Program ini mempunyai 3 komponen utama yaitu:
   
   1.**Model**
      sebagai data dan logia bisnis(CRUD ke database)
   2. **View**
      menampilkan antarmuka(UI) kepada user
   3. **Presenter**
      sebagai perantara antara model dan view

## Alur Program:
   1. User megakses index.php(default ke daftar pembalap atau kendaraan)
   2. index.php, menginisialisasi presenter(PresenterPembalap atau PresenterKendaraan)
   3. Presenter memanggil iniListPembalap() atau iniListKendaraan() untuk mendapaatkan data
   4. Model mengambil data dari databse
   5. Prsenter menerima data dari model,memanggil tanpilPembalap() atau tampilKendaraan() untuk mendapatkan
     data
   6. View memuat skin.html, mengisi palceholder dengan data yang diterima dari presenter
   7. Output, view mengembalikan string HTML ke index.php

## Dokumentasi:

https://github.com/user-attachments/assets/3f34442e-0fd1-49c7-adca-55f421407747



     

   
