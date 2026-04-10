<!-- # 📰 News Portal (Laravel Project)

A multi-author news portal built using Laravel where admins manage categories and authors publish news.

---

## 🚀 Features

- 🔐 Authentication (Login & Register)
- 👤 Role-based system (Admin & Author)
- 🗂 Admin assigns categories to authors
- ✍ Authors can post news only in assigned categories
- 🖼 Image upload for news posts
- 🗑 Delete posts
- 📖 Popup view for full news (Read More)
- 🎨 Clean UI using Tailwind CSS

---

## 🛠 Tech Stack

- Laravel 13
- PHP 8+
- MySQL
- Tailwind CSS
- JavaScript

---

## ⚙️ Installation

1. Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/news-portal.git
cd news-portal

Step 1(Install dependencies)
composer install
npm install

Step 2(Setup environment files)
cp .env.example .env
php artisan key:generate

Step 3(Configure database in .env)
DB_DATABASE=news_portal
DB_USERNAME=root
DB_PASSWORD=

Step 4(Run Migrations)
php artisan migrate

Step 5(Create Storage Links)
php artisan storage:link

Step 6 (Run Projrct)
php artisan serve
npm run dev

Usage
Register as a user
Admin assigns categories
Authors create posts
View posts on homepage
Click "Read More" to view full content

Author
"Kushal Poudel" -->