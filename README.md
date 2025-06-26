<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# 🚀 Laravel CRUD Project

This project is a Laravel-based CRUD application for managing items, customers, sales, and transactions.

## 🧾 Features

-   Customer & Item management
-   Sales with date, subtotal, and relationships
-   Transactions auto-calculate subtotal
-   Modular structure (using Laravel Modules)
-   API Ready (with Resource formatting)

---

## ⚙️ Installation Instructions

```bash
cp .env.example .env
composer install
php artisan storage:link
php artisan migrate:fresh --seed
php artisan optimize:clear
php artisan route:clear
php artisan cache:clear
php artisan serve
```
