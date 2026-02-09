# Laravel 11 - Admin Products & Cart API

This project is built as part of a technical assignment.
It includes **Admin Authentication**, **Product Management (CRUD)**, **Customer Authentication (Sanctum)**, **Cart Module**, **Checkout Logic**. 

## Features Implemented


### 1. Admin Panel (Basic Web)
- Admin login (session-based)
- Product CRUD:
    -Create product
    -View product list (DataTables)
    -Edit product
    -Delete product
- Logout

### 2. Authentication (Customer - Sanctum)
- Register
- Login
- Logout
- Token-based authentication using Laravel Sanctum

### 3. Cart Module
- Add product to cart
- Merge duplicate products automatically
- View cart with total
- Update cart item quantity
- Remove cart item

### 4. Checkout
- Deducts stock only if sufficient
- Uses database transactions
- Does **NOT clear cart** on failure

### 5. Best Practices Used
- Form Request validation
- Eloquent relationships & eager loading
- Database constraints
- Clean API JSON responses

## Requirement
- Laravel 11
- MySQL
- Laravel Sanctum
- REST APIs

## Project Setup (Step by Step)

### 1 Clone the Repository
git clone <repository-url>
cd product_cart

### 2 Install Dependencies
composer install

### 3 Environment Setup
- Copy .env.example to .env
- Update database details in .env:
    DB_DATABASE=product_cart
    DB_USERNAME=root
    DB_PASSWORD=
- Generate app key:
    php artisan key:generate

### 4 Install Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

### 5 Run Migrations & Seeders
php artisan migrate --seed

This will:
Create all required tables
Create admin user
Create sample products

Admin Credentials (Seeder)
Admin user is created via database seeder.
Email: admin@admin.com
Password: admin@2026

### 6 Run the Application
php artisan serve

Base URL:

http://127.0.0.1:8000



