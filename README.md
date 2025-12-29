## DP3AP2KB Tala Web Application

Sistem informasi berbasis web untuk Dinas Pemberdayaan Perempuan, Perlindungan Anak, Pengendalian Penduduk dan Keluarga Berencana Kabupaten Tanah Laut (DP3AP2KB Tala), dibangun menggunakan CodeIgniter 4.

Cek Secara Online 
https://dp3ap2kb-tala.online/ 

---

### Fitur Utama
- Manajemen artikel, berita, pengumuman, dan media
- Autentikasi pengguna dan manajemen pegawai
- Dashboard admin
- Upload dan manajemen file media
- Halaman landing page dan profil instansi

---

### Struktur Direktori
- `app/` — Kode utama aplikasi (Controllers, Models, Views, Config, dsb)
- `public/` — Root dokumen web server (index.php, assets, uploads, dsb)
- `writable/` — Folder untuk cache, logs, uploads, dsb
- `vendor/` — Dependensi Composer
- `tests/` — Unit test dan pengujian

---

### Instalasi
1. **Clone repository**
	```bash
	git clone <repo-url>
	cd dp3ap2kb-tala
	```
2. **Install dependensi**
	```bash
	composer install
	```
3. **Salin file environment**
	```bash
	cp .env.example .env
	# Edit konfigurasi database di .env
	```
4. **Generate key aplikasi**
	```bash
	php spark key:generate
	```
5. **Migrasi database**
	```bash
	php spark migrate
	```
6. **Jalankan server lokal**
	```bash
	php spark serve
	```

---

### Konfigurasi Penting
- Pastikan folder `writable/` dapat ditulis oleh web server
- Atur konfigurasi database di `.env`
- Untuk produksi, arahkan root domain ke folder `public/`

---

### Kontak & Lisensi
- **Lisensi:** MIT
- **Pengembang:** DP3AP2KB Tala
- Untuk pertanyaan, silakan hubungi admin instansi
