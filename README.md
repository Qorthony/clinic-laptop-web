# Clinic Laptop Web

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

## Cara Install
### 1. Clone project
` git clone https://github.com/Qorthony/Sistem-Informasi-Keuangan.git `
### 2. Composer Install
- buka terminal/cli pada direktori project
- kemudian ketik perintah : ` composer install `
### 3. Buat database
- buka phpmyadmin
- buat database baru
### 4. Setting ENV
- buka project pada text editor
- duplikasi file env
- rename file env menjadi .env
- buka file .env
- hapus tanda hashtag pada CI_ENVIRONMENT dan ganti nilai nya menjadi development
- hapus tanda hashtag mulai dari database.default.hostname hingga database.default.DBDriver
- setting nilai database, username, dan password sesuai yang ada di perangkatmu. jika tidak menggunakan password cukup kosongi bagian password
### 5. Migrate Database
- buka terminal/cli pada direktori project
- ketik perintah : ` php spark migrate` 
- ketik perintah : ` php spark db:seed UserSeeder`
### 6. Jalankan Program
- buka terminal/cli pada direktori project
- ketik perintah : ` php spark serve `
- buka browser, ketik localhost:8080