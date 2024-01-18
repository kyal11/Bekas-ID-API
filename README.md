## Summary
RestAPI untuk website bekas.id

## Dependency
1. [Laravel 10.x](https://laravel.com/docs/10.x) : Backend dari proyek ini dibangun menggunakan Laravel, sebuah framework PHP yang sering dikenal karena sintaks dan fiturnya yang elegan. Laravel juga mengikuti pola arsitektur MVC (Model-View-Controller).

2. [MySQL](https://www.mysql.com/) : Sistem manajemen basis data yang digunakan adalah MySQL. Kalian harus pastikan bahwa MySQL sudah diinstal dan dikonfigurasi dengan kredensial yang dibutuhkan yang disebutkan di dalam file `.env`.

3. [Postman API](https://www.postman.com/) : Postman digunakan untuk menguji dan mendokumentasikan API. Kalian dapat mengimpor Postman Collection yang disediakan (sudah saya upload linknya) untuk menguji endpoint API dari proyek ini.

4. [XAMPP](https://www.apachefriends.org/index.html) : XAMPP adalah paket solusi stack server web lintas platform yang mencakup server HTTP Apache, database MySQL, dan penerjemah untuk skrip yang ditulis dalam bahasa PHP.


## Model
<img src="https://github.com/kyal11/Bekas-ID-API/blob/main/doc/Model_Design.png" width="600" />

## Documentary
[Documentary with Postman](https://documenter.getpostman.com/view/29947879/2s9Ykt6fFU)

## Installing
1. Clone repository
```
$ git clone https://github.com/kyal11/Bekas-ID-API.git
```
2. Install Depedency
```
composer install
npm install
```
3. Create Database Mysql
```
Config your database name in .env
```
4. Migration Model
```
php artisan migrate:fresh --seed
```
5. Run RestAPI in port 8000
```
php artisan serve 
```
   
