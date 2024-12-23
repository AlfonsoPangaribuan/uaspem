# README: CRUD Data Mahasiswa dengan Cookie Management

## Deskripsi Proyek
Proyek ini adalah aplikasi berbasis web sederhana untuk mengelola data mahasiswa. Aplikasi ini mencakup fitur CRUD (Create, Read, Update, Delete) serta pengelolaan cookie untuk menyimpan data tertentu. Dibangun menggunakan PHP, MySQL, dan HTML/CSS, aplikasi ini juga menggunakan JavaScript untuk validasi form dan interaktivitas.

## Fitur Utama
1. **CRUD Data Mahasiswa**
   - Tambah, lihat, edit, dan hapus data mahasiswa.
2. **Pagination**
   - Menampilkan data mahasiswa dalam bentuk paginasi untuk kemudahan navigasi.
3. **Manajemen Cookie**
   - Menyimpan data mahasiswa tertentu ke dalam cookie.
4. **Validasi Form**
   - Validasi input pengguna untuk memastikan data yang valid.
5. **Bootstrap Styling**
   - Tampilan antarmuka yang responsif menggunakan Bootstrap.

## Struktur File
- **cookie_handler.php**
  Berisi fungsi untuk mengatur cookie:
  - `setCustomCookie($name, $value, $days)`: Menetapkan cookie dengan nama, nilai, dan durasi tertentu.
  - `getCustomCookie($name)`: Mendapatkan nilai cookie.
  - `deleteCustomCookie($name)`: Menghapus cookie.

- **db_connection.php**
  Berisi konfigurasi koneksi ke database MySQL.

- **db_schema.sql**
  Skrip SQL untuk membuat database `uas_pemrograman` dan tabel `users`.

- **index.php**
  Halaman registrasi akun dengan validasi input (username, email, password) dan antarmuka yang menarik.

- **manage_cookie.php**
  Halaman untuk mengelola cookie, termasuk menambah dan menghapus cookie, serta menampilkan daftar cookie yang ada.

- **table.php**
  Halaman utama untuk mengelola data mahasiswa, termasuk fitur CRUD dan paginasi.

## Instalasi
1. **Persiapan Lingkungan**
   - Pastikan Anda memiliki server web seperti XAMPP atau WAMP yang sudah terinstal.
   - Aktifkan modul PHP dan MySQL.

2. **Konfigurasi Database**
   - Jalankan skrip `db_schema.sql` di MySQL untuk membuat database dan tabel yang diperlukan.

3. **Konfigurasi Koneksi Database**
   - Edit file `db_connection.php` sesuai dengan kredensial MySQL Anda.

4. **Pindahkan File Proyek**
   - Salin semua file proyek ke direktori root server web Anda (misalnya, `htdocs` untuk XAMPP).

5. **Akses Aplikasi**
   - Buka browser dan akses `http://localhost/nama-folder-proyek`.

## Cara Penggunaan
1. **Registrasi Akun**
   - Isi form registrasi di `index.php` dengan username, email, dan password yang valid.
   - Setelah registrasi berhasil, Anda akan diarahkan ke halaman tabel data mahasiswa.

2. **Kelola Data Mahasiswa**
   - Tambahkan data mahasiswa baru dengan mengisi form di bagian atas tabel.
   - Edit atau hapus data mahasiswa melalui tombol yang tersedia di tabel.

3. **Manajemen Cookie**
   - Gunakan halaman `manage_cookie.php` untuk menyimpan atau menghapus cookie.
   - Lihat daftar cookie yang tersimpan di bagian bawah halaman.

## Teknologi yang Digunakan
- **Backend**: PHP, MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Framework CSS**: Bootstrap 4

## Validasi Form
- **Username**: Minimal 3 karakter.
- **Email**: Format email yang valid.
- **Password**: Minimal 8 karakter, mengandung huruf kapital dan angka.

## Catatan
- Pastikan koneksi database sudah dikonfigurasi dengan benar sebelum menjalankan aplikasi.
- Gunakan browser modern untuk pengalaman terbaik.

## Pengembang
- **Nama**: Alfonso Pangaribuan
- **NIM**: 122140206
- **Program Studi**: Teknik Informatika, Institut Teknologi Sumatera (ITERA)
- **Tahun**: 2024

