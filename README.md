<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Project details

Proyecto desarrollado con Laravel 9

- Detalles de prerequisitos, instalación, tutoriales y demás información en [https://styde.net/instalacion-de-laravel-9/](https://styde.net/instalacion-de-laravel-9/)

## Execution secuence

- git clone https://github.com/rkrdns/p2p-store.git
- cd p2p-store
- composer install
- crear base de datos
- copiar archivo .env.example a .env
- agregar datos para conexión con base de datos en archivo .env

        Datos de ejemplo:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=p2p-store
        DB_USERNAME=root
        DB_PASSWORD=

- php artisan key:generate
- php artisan optimize
- php artisan migrate
- php artisan serve, este comando correrá el programa en forma de desarrollo en http://127.0.0.1:8000

## Testing
- php artisan test
- php artisan test tests\Unit\StoreTest

## Envs
- P2P_BASE_URL="https://checkout-co.placetopay.dev"
- P2P_URL="${P2P_BASE_URL}/api/session"
- P2P_LOGIN='6dd490faf9cb87a9862245da41170ff2'
- P2P_SECRET_KEY='024h1IlD'