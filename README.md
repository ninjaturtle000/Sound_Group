# SOUND Group Entertainment Portal

[![Laravel 11](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP 8.3](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Dark Theme](https://img.shields.io/badge/Theme-Dark_Spotify_Aesthetic-10B981?style=for-the-badge)](https://soundgroup.com)
[![Database Backup](https://img.shields.io/badge/Database_Backup-SQL_Export-38BDF8?style=for-the-badge)](sound_group_backup.sql)

---

## 📌 Project Overview & Problem Statement

**SOUND Group** is an entertainment enterprise hosting old and new **Songs and Videos** across both **Regional** (Hindi, Tamil, Telugu, Punjabi, Spanish, French, Korean) and **English** languages.

This real-life web application is built strictly using **Laravel 11** with a modern **Dark Theme (Spotify-inspired aesthetic)**. It features deep categorization by **Album, Artist, Year, Genre, and Language**, community **Reviews & Ratings (Add & Modify)**, an **interactive persistent audio player bar**, **4K/HD video player**, and a complete **Administrator Control Panel**.

---

## 🚀 Key Features & Customer Specifications Checklist

| Requirement | Implementation Details | Status |
|---|---|:---:|
| **Theme: Dark** | Spotify-inspired dark aesthetic (`#0a0d14`), glowing emerald highlights (`#10b981`), glassmorphism, responsive cards. | ✅ Completed |
| **Framework: Laravel 11** | Modern Laravel 11 architecture, route model binding, Blade components, Form Request validations. | ✅ Completed |
| **Menu Structure** | Top navigation + category dropdown: Home, Music, Videos, Artists, Albums, Genres, Years, Regional/English Languages, About, Live Search. | ✅ Completed |
| **Categorization** | Arranged by **ALBUM, ARTIST, YEAR, GENRE, LANGUAGE (Regional & English)** with dedicated browse and detail pages. | ✅ Completed |
| **Home Page (5 Music & 5 Videos)** | Hero banner, dynamic announcement, **Latest 5 Music** + **Latest 5 Videos** with **pulsing animated "NEW" flashing badge**. | ✅ Completed |
| **Flashing "NEW" Badge** | Animated neon gradient badge (`.badge-new-flash`) pulsing along with all new additions to Music and Videos. | ✅ Completed |
| **Reviews & Ratings** | Authenticated users can **ADD and MODIFY ratings (1-5 stars)** and written reviews with timestamps and ratings breakdown. | ✅ Completed |
| **User Registration & Validations** | Mandatory fields with strict validation: **USERID (unique), Name, Address, Phone Number, Email-id, Password**. | ✅ Completed |
| **Interactive Audio Player** | Persistent bottom audio player bar: play/pause, seek scrubber, volume control, track artwork, title, and artist. | ✅ Completed |
| **Interactive Video Player** | HTML5 HD video player container with custom controls, duration tags, view counts, and related videos sidebar. | ✅ Completed |
| **Admin: Add/Delete Music** | Upload audio files or stream URLs with artwork, lyrics, description, duration, and "New" toggle. | ✅ Completed |
| **Admin: Add/Delete Videos** | Upload video files, MP4 links, or YouTube embeds with thumbnails, descriptions, and "New" toggle. | ✅ Completed |
| **Admin: Create Categories** | Add and delete Artists, Albums, Genres, Release Years, and Regional/English Languages. | ✅ Completed |
| **Admin: Manage Users/Logins** | View all users, search, create user with mandatory fields, edit details, toggle role, activate/deactivate account. | ✅ Completed |
| **Admin: Manage Website Details** | Update portal name, tagline, announcement banner, about text, contact phone, email, and address. | ✅ Completed |
| **Database Backup** | Pre-populated `database/database.sqlite` + full MySQL export `sound_group_backup.sql` with schema and data. | ✅ Completed |

---

## 🔑 Default Credentials

### 1. Administrator Account
- **USERID**: `admin`
- **Email**: `admin@soundgroup.com`
- **Password**: `admin123`
- **Role**: Administrator (Full control over music, videos, categories, users, settings, backups)

### 2. Standard User Accounts
- **USERID**: `johndoe`
  - **Email**: `john@example.com`
  - **Password**: `user123`
  - **Role**: USER
- **USERID**: `priyasharma`
  - **Email**: `priya@example.com`
  - **Password**: `user123`
  - **Role**: USER

> 💡 **Quick Login**: The `/login` page includes **1-Click Demo Buttons** to instantly autofill Administrator or User credentials for rapid testing!

---

## 🛠️ Installation & Setup Guide

### Prerequisites
- PHP 8.2 or 8.3+
- Composer
- Node.js & npm (for asset compilation)
- SQLite (included by default) or MySQL / MariaDB

### Step 1: Clone or Navigate to the Project
```bash
cd Spotify
```

### Step 2: Install PHP & Node Dependencies
```bash
composer install
npm install
npm run build
```

### Step 3: Environment Configuration
The `.env` file is pre-configured for SQLite by default:
```env
APP_NAME="SOUND Group"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite
```

*(Optional) If using MySQL:*
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sound_group
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Run Migrations & Seeders
```bash
php artisan migrate --seed
php artisan storage:link
```

### Step 5: Start Local Server
```bash
php artisan serve
```
Visit **`http://127.0.0.1:8000`** in your browser.

---

## 💾 Database Backup & Export

The project comes with a **complete database backup** exported as an SQL dump:
- **Location 1**: [sound_group_backup.sql](file:///c:/Users/UNKNOWN/Documents/Spotify/sound_group_backup.sql)
- **Location 2**: [database/sound_group_backup.sql](file:///c:/Users/UNKNOWN/Documents/Spotify/database/sound_group_backup.sql)

### How to re-export the SQL backup anytime:
Via Artisan command:
```bash
php artisan db:export-sql
```
Or directly from the Admin Panel:
1. Log in as Administrator.
2. Navigate to **Website Details & Backup** (`/admin/settings`).
3. Click **"Regenerate Backup"** or **"Download SQL File"**.

### Importing to MySQL / phpMyAdmin:
1. Create database `sound_group` in phpMyAdmin or MySQL CLI:
   ```sql
   CREATE DATABASE sound_group CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
2. Import `sound_group_backup.sql`:
   ```bash
   mysql -u root -p sound_group < sound_group_backup.sql
   ```

---

## 🗺️ Sitemap & Application Navigation

```
SOUND Group Entertainment Portal
├── Home (/) [Featured Hero + 5 Latest Music + 5 Latest Videos + Categories + About + Stats]
├── Music (/music) [Multi-facet catalog by Artist, Album, Genre, Year, Language]
│   └── Song Detail (/music/{id}) [Cover Art, Audio Player, Lyrics, Add/Modify Reviews & Ratings]
├── Videos (/videos) [HD Video Catalog by Artist, Album, Genre, Year, Language]
│   └── Watch Video (/videos/{id}) [4K Player, Views Counter, Add/Modify Reviews & Ratings]
├── Categories
│   ├── Artists (/categories/artists & /categories/artists/{id})
│   ├── Albums (/categories/albums & /categories/albums/{id})
│   ├── Genres (/categories/genres & /categories/genres/{id})
│   ├── Years (/categories/years & /categories/years/{year})
│   └── Regional & English Languages (/categories/languages & /categories/languages/{id})
├── Search (/search?q=...) [Global Multi-Tab Live Search]
├── About SOUND Group (/about) [Company mission, regional catalog, contact info]
├── Authentication
│   ├── Register (/register) [USERID unique, Name, Email, Phone, Address mandatory]
│   ├── Login (/login) [USERID/Email authentication with 1-click demo buttons]
│   └── Profile (/profile) [Profile update, password reset, My Reviews & Ratings]
└── Administrator Control Panel (/admin)
    ├── Dashboard (/admin) [Entertainment metrics, recent additions, user list]
    ├── Music Management (/admin/music) [Add, Edit, Delete, Toggle Flashing NEW]
    ├── Video Management (/admin/videos) [Add, Edit, Delete, Toggle Flashing NEW]
    ├── Category Management (/admin/categories) [Artists, Albums, Genres, Years, Languages]
    ├── User Management (/admin/users) [Create user, Edit, Change Role, Deactivate, Delete]
    └── Website Settings & Backup (/admin/settings) [Copy management + SQL Export & Download]
```

---

## 📄 License & Attribution
Developed for the **SOUND Group Entertainment Portal Real-Life Project Evaluation**.
Built using Laravel 11 Framework and modern Vanilla CSS dark theme aesthetics.
