# SoloPM

> A lightweight, modern project management board built with Laravel + Filament.

SoloPM is a simple and fast Kanban-style project management tool designed for small teams, solo founders, and internal workflows. It focuses on clarity, speed, and minimal setup — no bloated enterprise complexity.

---

## ✨ Features

- 🗂️ Kanban task boards (To Do / In Progress / Completed)
- 🔄 Drag & drop task ordering
- 👤 User assignment & avatars
- 🏷️ Priority badges (Low / Medium / High)
- 📅 Due dates & overdue filters
- 🔍 Search & filters
- ⚡ Fast admin UI powered by Filament
- 🧩 Built with modern Laravel stack

---

## 🛠 Tech Stack

- PHP 8+
- Laravel
- Filament Admin Panel
- Livewire
- React
- MySQL / PostgreSQL
- Vite

---

## 🚀 Installation

Clone the repository:

```bash
git clone https://github.com/your-username/solopm.git
cd solopm
```

Install dependencies:

```bash
composer install
npm install
```

Environment setup:

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`, then run:

```bash
php artisan migrate --seed
npm run dev
php artisan serve
```

Open:

```
http://localhost:8000
```

---

## 🔐 Creating an Admin User

```bash
php artisan make:filament-user
```

Then login to `/admin`.

---

## 📦 Production Deploy

```bash
npm run build
php artisan migrate --force
php artisan optimize
```

---

## 📁 Project Status

🚧 Active development

Core features are usable, but APIs and advanced features may change.
Expect breaking changes until v1.0.

---

## 🤝 Contributing

Contributions are welcome!

1. Fork the repo
2. Create a feature branch
3. Submit a PR

Bug reports, ideas, and improvements are appreciated.

---

## 📄 License

This project is open-sourced under the MIT License.
You are free to use, modify, and distribute it for personal or commercial use.

---

## 💬 About

Built with ❤️ by Ty Aung to simplify project management for small teams and solo builders.
