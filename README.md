<p align="center">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/main/Screenshot%20(279).png" width="800" alt="Banner SIPAK">
</p>

<h1 align="center">Sistem Peminjaman Alat Kantor (SIPAK)</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Tailwind-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind">
</p>

---

### 🌐 Informasi Project
Aplikasi ini dikembangkan untuk **Ujian Kompetensi Keahlian (UKK) Rekayasa Perangkat Lunak**.
- **Live Demo:** [sipak-sela.rf.gd](http://sipak-sela.rf.gd/)
- **Hosting:** InfinityFree

### 🔑 Kredensial Login
| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `password` |
| **Operator** | `operator@gmail.com` | `password` |
| **User** | `user@gmail.com` | `password` |

---

## 🏗️ Arsitektur Sistem

### 📊 Entity Relationship Diagram (ERD)
Menggambarkan hubungan antar tabel dalam database untuk memastikan integritas data.
<p align="center">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/f218b01b4b26ff210007f56e3d3b93edd7f4964f/erdsipak.drawio%20(1).png" width="700" alt="ERD SIPAK">
</p>

### 🔄 Flowchart Sistem
Alur kerja aplikasi mulai dari proses login hingga transaksi peminjaman selesai.
<p align="center">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/f218b01b4b26ff210007f56e3d3b93edd7f4964f/SPK.drawio.png" width="700" alt="Flowchart SIPAK">
</p>

---

## 🚀 Fitur Berdasarkan Role

### 🛡️ 1. Panel Admin
Admin memiliki otoritas tertinggi untuk mengelola seluruh ekosistem aplikasi.
- **Inventory Management:** Mengelola data barang, stok, dan kategori.
- **User Management:** Mengelola akun Admin, Operator, dan User.
- **Monitoring:** Dashboard statistik peminjaman secara real-time.

<p align="center">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/main/Screenshot%20(280).png" width="45%">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/main/Screenshot%20(281).png" width="45%">
</p>

---

### 👨‍💼 2. Panel Operator
Operator fokus pada validasi transaksi dan penyusunan laporan.
- **Verifikasi Peminjaman:** Melakukan validasi (Setujui/Tolak) pengajuan user.
- **Laporan:** Menghasilkan rekapitulasi peminjaman periodik.

<p align="center">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/main/Screenshot%20(284).png" width="30%">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/main/Screenshot%20(285).png" width="30%">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/main/Screenshot%20(290).png" width="30%">
</p>

---

### 👤 3. Panel User (Peminjam)
User dapat melakukan proses peminjaman mandiri melalui sistem.
- **Katalog Digital:** Melihat detail dan stok alat kantor.
- **Booking Online:** Mengajukan peminjaman secara digital.
- **Status Tracking:** Melacak riwayat dan status peminjaman.

<p align="center">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/main/Screenshot%20(286).png" width="45%">
  <img src="https://raw.githubusercontent.com/Marselalestari/SistemPeminjamanAlatKantor/main/Screenshot%20(287).png" width="45%">
</p>

---

## 🛠 Teknologi yang Digunakan
- **Backend:** PHP 8.3.30 & Laravel Framework
- **Database:** MySQL
- **Frontend:** Blade Template Engine & Tailwind CSS
- **Icons:** FontAwesome / Lucide Icons

---
<p align="center">Dibuat dengan ❤️ untuk Tugas UKK Rekayasa Perangkat Lunak</p>
