# Challenge - Katalog Online

## Getting Started
Aplikasi Katalog Online yang dibuat menggunakan Laravel.

Sudah terdapat code untuk melakukan automated testing.

Untuk demo aplikasi silahkan kunjungi:
- Demo : http://catalog.alfrizp.design/

### Langkah Instalasi
1. Clone repo : `git clone https://github.com/alfrizp/challenge-catalog.git`
2. `$ cd challenge-catalog`
3. `$ composer install`
4. `$ cp .env.example .env`
5. `$ php artisan key:generate`
6. Buat database MySQL baru untuk aplikasi  
(dengan perintah: `$ mysqladmin -urootuser -p create challenge-catalog`)
7. Setting credentials database dan url di file `.env`
8. `$ php artisan migrate --seed`
9. `$ php artisan serve`

### Automated Testing
Projek ini dilengkapi dengan automated testing.

Untuk menjalankan automated testing menggunakan perintah `$ ./vendor/bin/phpunit`.

Code automated testing terletak didalam direktori `tests/`.
