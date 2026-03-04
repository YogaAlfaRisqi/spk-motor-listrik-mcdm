# ⚡ SPK Rekomendasi Pemilihan Motor Listrik
Sistem Pendukung Keputusan (SPK) untuk merekomendasikan motor listrik terbaik menggunakan metode Multi-Criteria Decision Making (MCDM).

---

## 📌 Deskripsi Project
Aplikasi ini membantu pengguna memilih motor listrik terbaik berdasarkan beberapa kriteria seperti:

- Harga
- Jarak Tempuh
- Kapasitas Baterai
- Waktu Pengisian
- Kecepatan Maksimal
- Garansi


## 🏗️ Arsitektur Sistem

Laravel 12 menggunakan pendekatan:

- Blade (Layout & View)
- Livewire (Reactive UI)
- Service Layer (Engine MCDM)
- Repository Pattern
- Role-based Access (Admin & User)

Struktur utama:
```
app/
 ├── Livewire/
 ├── Services/MCDM/
 ├── Repositories/
 ├── Models/
```

---
## 👥 Role Sistem

### 👨‍💼 Admin
- Login
- CRUD Motor
- CRUD Kriteria
- Input Nilai Alternatif
- Melihat Proses Perhitungan
- Grafik Hasil

### 👤 User
- Register & Login
- Simulasi Pemilihan
- Melihat Ranking
- Melihat Detail Perhitungan
---

## 📊 Fitur Utama

- 🔐 Authentication (Login & Register)
- 🛡 Role-based Authorization
- 📈 Grafik Ranking (Chart.js)
- 📊 Tampilkan proses perhitungan
- ⚡ Livewire reactive component
- 📦 REST API Support
- 🧪 Testing Ready

---

## 🛠 Tech Stack

| Technology | Version |
|------------|----------|
| PHP | 8.3+ |
| Laravel | 12 |
| Livewire | v3 |
| Tailwind CSS | Latest |
| Chart.js | Latest |

---

## ⚙️ Instalasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/spk-motor-listrik-mcdm.git
cd spk-motor-listrik-mcdm
```

### 2️⃣ Install Dependency

```bash
composer install
npm install
```

### 3️⃣ Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit konfigurasi database pada `.env`

### 4️⃣ Migrasi Database

```bash
php artisan migrate --seed
```

### 5️⃣ Build Asset

```bash
npm run build
```

### 6️⃣ Jalankan Server

```bash
php artisan serve
```

Akses:
```
http://127.0.0.1:8000
```
---

## 🔑 Default Login (Seeder)

Admin:
```
email: admin@spk.com
password: password
```

User:
```
email: user@spk.com
password: password
```

---

## 📁 Struktur Folder

```
app/
 ├── Livewire/
 ├── Services/
 ├── Repositories/
 ├── Models/

resources/views/
 ├── layouts/
 ├── admin/
 ├── user/
 └── livewire/

routes/
 ├── web.php
 ├── admin.php
 └── user.php
```

---

## 🔄 Git Branch Strategy

- main → Production
- develop → Development
- feature/* → Fitur baru
- hotfix/* → Bug fix

---

## 🧪 Testing

```bash
php artisan test
```

---

## 📡 API Endpoint (Optional)

```
GET /api/motor
GET /api/kriteria
POST /api/perhitungan
```
