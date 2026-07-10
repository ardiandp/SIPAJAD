# SIPAJAD - Sistem Penjadwalan Otomatis SMK

Aplikasi web untuk menyusun jadwal mata pelajaran SMK secara otomatis menggunakan algoritma Constraint Programming (Google OR-Tools).

## Fitur

- **Manajemen Master Data**: Guru, Mata Pelajaran, Kelas, Ruangan, Hari, Jam Pelajaran
- **Beban Mengajar**: Atur guru → mapel → kelas beserta jumlah JP
- **Generate Jadwal Otomatis**: Algoritma OR-Tools menghindari bentrok guru/kelas/ruangan
- **Versi Jadwal**: Buat beberapa versi jadwal (draft → final)
- **Tampilan Jadwal**: Timetable grid per kelas, guru, ruangan, dan keseluruhan
- **Hak Akses**: Admin, Waka Kurikulum, Guru
- **Export**: PDF & Excel (via ekstensi)

## Persyaratan Sistem

### Minimum
| Komponen | Versi |
|---|---|
| PHP | ^8.1 |
| Composer | ^2.0 |
| MySQL | ^5.7 / MariaDB ^10.4 |
| Node.js | ^18 (untuk asset build) |
| Python | ^3.9 (untuk scheduler OR-Tools) |

### Library Python (Opsional - untuk generate)
| Package | Kegunaan |
|---|---|
| flask | REST API server |
| flask-cors | CORS middleware |
| ortools | Constraint Programming solver |
| gunicorn | Production WSGI server |

### Package PHP (terinstall otomatis lewat composer)
- Laravel 10
- Laravel Breeze (Blade)
- Laravel Excel (export)
- Laravel DomPDF (PDF export)
- Yajra DataTables

## Instalasi

### 1. Clone / Copy Project

```bash
# Jika dari git
git clone https://github.com/username/sipajad.git
cd sipajad

# Atau langsung dari folder project yang sudah ada
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Konfigurasi Environment

Copy file `.env.example` menjadi `.env`:

```bash
copy .env.example .env
# atau
cp .env.example .env
```

Edit file `.env` sesuaikan dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jadwal
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Buat Database

Buat database MySQL dengan nama `jadwal` (atau sesuai konfigurasi .env):

```sql
CREATE DATABASE jadwal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Jalankan Migration & Seeder

```bash
php artisan migrate --seed
```

Perintah di atas akan:
- Membuat seluruh tabel (users, gurus, mata_pelajarans, kelas, ruangan, hari, jam, beban_mengajars, schedule_versions, jadwals)
- Mengisi data awal (admin user, hari, jam, ruangan)
- Jika ada seeder khusus, jalankan:

```bash
php artisan db:seed --class=DatabaseSeeder
```

### 7. Install & Build Frontend

```bash
npm install
npm run build
```

> **Catatan**: Frontend menggunakan CDN (Tabler UI, Bootstrap, DataTables). Langkah ini opsional jika tidak menggunakan Vite.

### 8. Jalankan Aplikasi

```bash
php artisan serve --port=8080
```

Buka browser: `http://localhost:8080`

## Akun Default

| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@admin.com` | `password` |
| **Kurikulum** | `kurikulum@admin.com` | `password` |

## Generate Jadwal (Python OR-Tools)

### 1. Install Python Dependencies

```bash
cd python
pip install -r requirements.txt
```

### 2. Jalankan Python Scheduler

Buka **terminal terpisah** (jangan ditutup):

```bash
cd python
python app.py
```

Server akan berjalan di `http://127.0.0.1:5000`

### 3. Generate dari Web

1. Login sebagai Admin / Kurikulum
2. Buka menu **Versi Jadwal**
3. Klik **"Buat Versi Baru"**, isi nama (misal: "Semester Ganjil 2025/2026")
4. Klik **"Generate"** pada versi yang baru dibuat
5. Tunggu proses selesai (bisa 30-120 detik)
6. Setelah selesai, otomatis redirect ke halaman **Jadwal Keseluruhan**

### 4. Generate via Command Line (Alternatif)

```bash
php artisan jadwal:generate {id_versi}
```

## Panduan Penggunaan

### Alur Lengkap

```
1. Login sebagai Admin
2. Input data master:
   ├── Jurusan (untuk SMK)
   ├── Guru
   ├── Mata Pelajaran
   ├── Kelas
   ├── Ruangan
   ├── Hari
   └── Jam Pelajaran
3. Atur Beban Mengajar:
   └── Pilih Guru → Mapel → Kelas → Jumlah JP
4. Buat Versi Jadwal
5. Generate Jadwal (Otomatis)
6. Lihat hasil:
   ├── Jadwal Keseluruhan
   ├── Jadwal Per Kelas
   ├── Jadwal Per Guru
   └── Jadwal Per Ruangan
7. Finalkan jika sudah sesuai
```

### Menu-Menu

| Menu | Deskripsi | Akses |
|---|---|---|
| **Dashboard** | Statistik jumlah guru, mapel, kelas, ruangan | Semua |
| **Jurusan** | CRUD jurusan (TKJ, AKL, MPLB, TSM, dll) | Admin |
| **Guru** | Data guru, NIP, bidang, maks jam | Admin, Kurikulum |
| **Mata Pelajaran** | Data mapel, kelompok A/B/C, jenis teori/praktikum | Admin, Kurikulum |
| **Kelas** | Data kelas, relasi jurusan, wali kelas, ruangan | Admin, Kurikulum |
| **Ruangan** | Ruang kelas, lab, bengkel, aula | Admin, Kurikulum |
| **Hari** | Hari sekolah (Senin - Sabtu) | Admin, Kurikulum |
| **Jam Pelajaran** | Sesi jam belajar + waktu | Admin, Kurikulum |
| **Beban Mengajar** | Mapping guru → mapel → kelas → JP | Admin, Kurikulum |
| **Versi Jadwal** | Kelola versi, generate, finalkan | Admin, Kurikulum |
| **Jadwal Keseluruhan** | Tampilan semua jadwal + filter kelas | Semua |
| **Jadwal Per Kelas** | Timetable per kelas | Semua |
| **Jadwal Per Guru** | Timetable per guru | Semua |
| **Jadwal Per Ruangan** | Timetable per ruangan | Semua |

## Hak Akses

| Fitur | Admin | Kurikulum | Guru |
|---|---|---|---|
| Kelola Jurusan | ✅ | ❌ | ❌ |
| CRUD Guru/Mapel/Kelas/Ruangan/Hari/Jam | ✅ | ✅ | ❌ |
| Beban Mengajar | ✅ | ✅ | ❌ |
| Generate Jadwal | ✅ | ✅ | ❌ |
| Lihat Jadwal | ✅ | ✅ | ✅ |
| Export PDF/Excel | ✅ | ✅ | ✅ |

## Struktur Database

```
users                  - Auth & role (admin/kurikulum/guru)
├── jadwals            - Hasil generate jadwal
└── schedule_versions  - Versi jadwal (draft/final)

jurusans               - Jurusan SMK
├── kelas              - Data kelas

gurus                  - Data guru
├── beban_mengajars    - Mapping guru → mapel → kelas
└── jadwals            - Jadwal per guru

mata_pelajarans        - Mata pelajaran
├── beban_mengajars
└── jadwals

ruangans               - Ruangan
├── kelas
└── jadwals

hari                   - Hari sekolah
└── jadwals

jam                    - Jam pelajaran
└── jadwals
```

## Troubleshooting

### Error: "Gagal terhubung ke Python scheduler"

**Penyebab:** Python service belum dijalankan.

**Solusi:**
```bash
cd python
pip install -r requirements.txt
python app.py
```

### Error: "SQLSTATE[HY000] - Connection refused"

**Penyebab:** MySQL service tidak berjalan.

**Solusi:** Jalankan MySQL server (via Laragon / XAMPP / MAMP).

### Error: "Target class [controller] does not exist"

**Penyebab:** Cache routing belum di-clear setelah perubahan.

**Solusi:**
```bash
php artisan optimize:clear
```

### Error: "No application encryption key"

**Solusi:**
```bash
php artisan key:generate
```

### Error: "Class DatabaseSeeder not found"

**Solusi:**
```bash
composer dump-autoload
php artisan db:seed
```

## Opsi Generate Tanpa Python

Jika tidak ingin menginstall Python / OR-Tools, scheduler bisa diganti dengan implementasi PHP native (greedy algorithm). Hubungi developer untuk aktivasi.

## Teknologi

- **Frontend**: Bootstrap 5, Tabler UI, jQuery, DataTables
- **Backend**: Laravel 10, PHP 8.1+
- **Database**: MySQL / MariaDB
- **Scheduler**: Python 3, Google OR-Tools (CP-SAT Solver)

## Lisensi

SIPAJAD dikembangkan untuk keperluan pendidikan SMK.
