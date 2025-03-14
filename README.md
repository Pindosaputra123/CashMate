<h1 align="center">Selamat datang di CashMate! 👋</h1>

## Apa itu CashMate?

**CashMate adalah Sistem penghitung uang berbasis web yang dirancang untuk menghitung seluruh laci kas dalam waktu kurang dari satu menit. Produk ini cocok untuk pemilik bisnis ritel, restoran, dan lainnya yang membutuhkan solusi penghitung uang yang akurat dan efisien.**

---

## Fitur apa saja yang tersedia di CashMate?

- Autentikasi Admin
- User & CRUD
- Barang & CRUD
- Customer & CRUD
- Transaksi & CRUD
- Setting
- Laporan
- Dan lain-lain

---

## Default Account for testing

**Admin Default Account**

- email: admin@gmail.com
- Password: admin

---

## Install

1. **Clone Repository**

```bash
git clone https://github.com/Pindosaputra123/CashMate.git
cd CashMate
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_kasir
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
```

4. **Jalankan website**

```bash
php artisan serve
```

---

## License

- **Sistem Informasi Akademik Sekolah is open-sourced software licensed under the MIT license.**
