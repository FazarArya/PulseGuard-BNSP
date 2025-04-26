# PulseGuard

<p align="center">
  <img src="public/img/logo-footer.png" width="300" alt="PulseGuard Logo">
</p>

## Empowering Communities with Cardio Care

PulseGuard adalah aplikasi berbasis web yang dirancang untuk membantu dalam pemantauan dan pengelolaan kesehatan pengguna, khususnya untuk menurunkan angka kematian yang disebabkan oleh penyakit kardiovaskular, kanker, diabetes, dan penyakit pernapasan kronis, sesuai dengan tujuan SDG 3.4. Aplikasi ini dikembangkan sebagai bagian dari **Tugas Besar Mata Kuliah Web Application Development (WAD)** dan juga untuk memenuhi sertifikasi **BNSP Web Development**.

## Getting Started

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi PulseGuard di komputer lokal kamu.

### Prerequisites

Pastikan software berikut sudah terpasang di sistem kamu:

- PHP (versi 8.2.0 atau lebih baru)
- Composer
- Laravel (versi 11.x)

### Installation

Clone repository ini:

```bash
git clone https://github.com/FazarArya/PulseGuard-BNSP.git
```

Masuk ke direktori project:

```bash
cd PulseGuard-BNSP
```

Install semua dependencies dengan Composer:

```bash
composer install
```

Salin file environment:

```bash
cp .env.example .env
```
*(Untuk Windows, rename `.env.example` menjadi `.env`)*

Update konfigurasi yang diperlukan di file `.env`, terutama bagian database.

Generate application key:

```bash
php artisan key:generate
```

Buat database baru di MySQL, lalu jalankan migrasi:

```bash
php artisan migrate:fresh --seed
```

### Running the Project

Jalankan server lokal:

```bash
php artisan serve
```

Akses aplikasi di browser:

```
http://localhost:8000
```

### Admin Credentials

Untuk login sebagai admin, silakan cek kredensial di file seeder:

```
database/seeders/UserSeeder.php
```

---

## Features

- **User Registration & Login**: Pengguna dapat mendaftar dan masuk ke sistem untuk memantau kesehatan mereka.
- **Health Monitoring**: Fitur untuk memonitor gejala penyakit kardiovaskular, diabetes, dan pernapasan kronis.
- **Data Analytics**: Analisis kesehatan berdasarkan data yang dimasukkan oleh pengguna.
- **Admin Dashboard**: Dashboard admin untuk mengelola data pengguna dan pemantauan kesehatan.
- **CRUD Operations**: Admin dapat menambah, mengedit, atau menghapus data pengguna dan informasi kesehatan.

---

### Notes
Aplikasi ini dibuat dengan fokus pada **SDG 3.4** untuk **menurunkan angka kematian yang disebabkan oleh penyakit kardiovaskular, kanker, diabetes, dan penyakit pernapasan kronis** pada tahun 2030. Website ini juga digunakan untuk **sertifikasi BNSP Web Development** dan untuk memenuhi Tugas Besar pada mata kuliah **Web Application Development (WAD)**.

---

> Dibuat dengan ❤️ oleh [Fazar Arya](https://github.com/FazarArya) dan TEAM.
