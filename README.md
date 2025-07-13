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

# 📚 KialaLibrary – Laravel REST API

**KialaLibrary** is a RESTful API built with Laravel, designed to manage a virtual library.  
It includes book cataloging, search features, borrowing logic, and full Swagger documentation.

---

## ✨ Features

- CRUD operations for Books
- Search books by title, author, genre, year
- Filter available/unavailable books
- Book statistics and latest entries
- Swagger documentation (OpenAPI 3.0)
- Sanctum-based API authentication (Breeze API)

---

## 📂 API Endpoints

| Method | Endpoint                   | Description                      |
|--------|----------------------------|----------------------------------|
| GET    | `/api/books`              | List all books                   |
| GET    | `/api/books/{id}`         | Show a book                      |
| POST   | `/api/books`              | Create a book                    |
| PUT    | `/api/books/{id}`         | Update a book                    |
| DELETE | `/api/books/{id}`         | Delete a book                    |
| GET    | `/api/books/search?q=...` | Search by title or author        |
| GET    | `/api/books/available`    | Available books                  |
| GET    | `/api/books/unavailable`  | Unavailable books                |
| GET    | `/api/books/genre/{genre}`| Filter by genre                  |
| GET    | `/api/books/author/{name}`| Filter by author                 |
| GET    | `/api/books/year/{year}`  | Filter by publication year       |
| GET    | `/api/books/latest`       | Latest added books               |
| GET    | `/api/books/stats`        | Library statistics               |

---

## 📑 API Documentation

The Swagger UI is available at:  
📄 [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

Swagger is powered by [`darkaonline/l5-swagger`](https://github.com/DarkaOnLine/L5-Swagger).

---

## 🚀 Setup

```bash
git clone https://github.com/mcleroi01/kiala-library.git
cd kiala-library

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan serve
