# BukuKita - Kerangka Awal (Starter)

Project latihan LKS: **CRUD Kategori**, Register, Login, Logout, dan Otorisasi
(middleware) dengan PHP Native + MySQL. Latihan akhir: **CRUD Buku** (dibuat sendiri).

> Folder, tampilan (HTML + CSS), komponen, dan struktur sudah disediakan.
> Logika belum dibuat. Cari penanda `TODO` di setiap file.

## Cara Menjalankan

1. Salin folder `bukukita` ke `C:\laragon\www\`
2. Buka Laragon, klik **Start All**, lalu klik **Terminal**
3. **Buat database sendiri** sesuai materi (database `smk_immanuel_library`
   dan tabel `users`, `categories`, `books`)
4. Buat file koneksi `config/database.php` (ikuti TODO di dalam file)
5. Di terminal, masuk ke folder project lalu jalankan server PHP:

   ```
   cd C:\laragon\www\bukukita
   php -S localhost:8000
   ```
6. Buka `http://localhost:8000` (port boleh diganti, misalnya 8080)

> Server harus dijalankan **dari dalam folder project** karena alamat di middleware
> diawali `/pages/...`.

## Urutan Pengerjaan (3 Tahap + Latihan)

**Persiapan:** database dan `config/database.php`

**Tahap 1 - CRUD Kategori** (tanpa login; baris pertama setiap file `session_start();`)
1. `repositories/category-repository.php`
2. `validations/category-validation.php`
3. `pages/categories/*` (index, create, edit)
4. `actions/categories/store.php`, `update.php`, `destroy.php`

**Tahap 2 - Autentikasi**
1. `repositories/user-repository.php`, `validations/auth-validation.php`
2. `actions/auth/register.php`, `login.php`, `logout.php`
3. `pages/auth/*`
4. `middleware/auth.php`: konstanta URL, `startSession`, `isLoggedIn`, `getAuthUser`

**Tahap 3 - Otorisasi (Middleware)**
1. `middleware/auth.php`: `hasRole`, `requireAuth`, `requireRole`, `requireGuest`
2. Ganti `session_start();` di baris pertama page dan action dengan middleware
3. Sembunyikan tombol admin dengan `$isAdmin`

**Latihan - CRUD Buku:** lihat slide "Latihan: CRUD Buku" pada materi.

## Struktur Folder (mengikuti project referensi)

```
bukukita/
├── index.php            -> landing page                       [SIAP]
├── actions/
│   ├── auth/            register, login, logout               [TODO]
│   ├── categories/      store, update, destroy                [TODO]
│   └── books/           (latihan: dibuat sendiri)
├── components/
│   ├── admin/           sidebar, topbar                       [SIAP]
│   └── landing/         header, footer                        [SIAP]
├── config/database.php  koneksi PDO                           [TODO]
├── middleware/auth.php  penjaga halaman                       [TODO tahap 2-3]
├── pages/
│   ├── auth/            login, register                       [TODO]
│   ├── categories/      index, create, edit                   [TODO]
│   ├── books/           (latihan: dibuat sendiri)
│   └── errors/          403                                   [SIAP]
├── repositories/        user, category                        [TODO]
├── styles/              CSS semua halaman (termasuk books)    [SIAP]
└── validations/         auth, category                        [TODO]
```

## Kebutuhan

PHP 8.0+ dengan ekstensi PDO MySQL dan mbstring (sudah aktif di Laragon).
