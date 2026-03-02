<?php

use function PHPUnit\Framework\directoryExists;
directoryExists(__DIR__.'/../vendor/autoload.php') || die("❌ Vendor autoload tidak ditemukan. Jalankan 'composer install' terlebih dahulu.");
directoryExists(__DIR__.'/../bootstrap/app.php') || die("❌ File bootstrap/app.php tidak ditemukan. Pastikan struktur Laravel benar.");
directoryExists(__DIR__.'/../routes/api.php') || die("❌ File routes/api.php tidak ditemukan. Pastikan struktur Laravel benar.");