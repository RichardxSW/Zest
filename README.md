# Zest - Website Inventaris Toko Buah

Kelompok 5-TI-A
- Tanjaya Jason Winata (535220041)
- Richard Souwiko (53522042)
- Jason Sutanto (535220052)

## Tentang Zest

**Zest** adalah sebuah aplikasi web yang dirancang untuk mengelola inventaris toko buah. Website ini dibuat menggunakan framework Laravel dengan database PostgreSQL, dan dilengkapi dengan otentikasi menggunakan Laravel UI. Zest memberikan kemudahan dalam mengelola berbagai aspek toko buah seperti kategori produk, produk, pelanggan, pemasok, penjualan, pembelian, dan pengguna sistem. Terdapat tiga role berbeda dengan akses terbatas, dan super admin yang dapat mengakses semua fitur.

## Fitur-fitur

### 1. Otentikasi dan Role User
- **Registrasi Pengguna dan Otentikasi**: Menggunakan Laravel UI, pengguna diharuskan untuk mendaftar dan melakukan verifikasi email sebelum mendapatkan akses ke sistem.
- **Role Management**: Terdapat tiga role berbeda dengan akses terbatas, serta seorang super admin yang memiliki akses penuh ke seluruh sistem.

### 2. Dashboard
- **Dashboard Interaktif**: Menyediakan tampilan ringkasan dari berbagai data penting seperti total produk, penjualan, pembelian, dan lain-lain.

### 3. Manajemen Kategori
- **CRUD Kategori**: Mengelola kategori produk dengan menambah, mengedit, dan menghapus kategori sesuai kebutuhan.

### 4. Manajemen Produk
- **CRUD Produk**: Mengelola inventaris produk, termasuk menambah, mengedit, dan menghapus produk dari sistem.

### 5. Manajemen Pelanggan
- **CRUD Pelanggan**: Mengelola data pelanggan, memungkinkan toko untuk melacak pelanggan mereka dengan lebih efektif.

### 6. Manajemen Pemasok
- **CRUD Pemasok**: Mengelola data pemasok untuk memastikan ketersediaan produk selalu terjaga.

### 7. Penjualan Produk
- **Transaksi Penjualan**: Mencatat penjualan produk, membantu dalam pengelolaan inventaris dan laporan penjualan.

### 8. Pembelian Produk
- **Transaksi Pembelian**: Mencatat pembelian produk dari pemasok, memastikan stok selalu terjaga.

### 9. Manajemen Pengguna Sistem
- **CRUD Pengguna**: Super admin dapat mengelola pengguna sistem, termasuk menambah, mengedit, dan menghapus pengguna.

## Instalasi 

Untuk menjalankan Zest secara lokal, ikuti langkah-langkah berikut:

### 1. Clone Repository
```bash
git clone https://github.com/RichardxSW/Zest.git
```

### 2. Install Dependencies
```bash 
cd Zest
composer install
```

### 3. Atur file .env
- Perbarui konfigurasi database dan password pgadmin di file .env

### 4. Migrasi Database
```bash
php artisan migrate
```

### 5. Seed Database
```bash
php artisan db:seed
```

### 6. Compile Asset
```bash
npm install
```

### 7. Jalankan server pengembangan
```bash
npm run dev
```
**buka terminal baru**
```bash
php artisan serve
```

### 8. Akses Website
- Buka browser web Anda dan akses http://127.0.0.1:8000 untuk mulai menggunakan Zest.

