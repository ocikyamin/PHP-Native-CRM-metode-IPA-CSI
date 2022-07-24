<?php
error_reporting(0);
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$seg = explode('/', $path);
if ($seg[3] == 'shop.php') {
    $title = 'Shop';
} elseif ($seg[3] == 'about.php') {
    $title = 'About';
} elseif ($seg[3] == 'contact.php') {
    $title = 'Contact';
} elseif ($seg[3] == 'cart.php') {
    $title = 'Keranjang Belanja';
} elseif ($seg[3] == 'profile.php') {
    $title = 'Profile';
} elseif ($seg[3] == 'start.php') {
    $title = 'Kusioner';
} elseif ($seg[3] == 'history.php') {
    $title = 'Riwayat Transaksi';
} elseif ($seg[3] == 'register.php') {
    $title = 'Register';
} elseif ($seg[3] == 'login.php') {
    $title = 'Login User';
} elseif ($seg[3] == 'invoice.php') {
    $title = 'Invoice';
} elseif ($seg[3] == 'product-detail.php') {
    $title = 'Detail Produk';
} elseif ($seg[3] == 'payment-confirm.php') {
    $title = 'Konfirmasi Pembayaran';
} elseif ($seg[3] == '') {
    $title = 'Home | Usiusi Interior Bukittinggi';
}