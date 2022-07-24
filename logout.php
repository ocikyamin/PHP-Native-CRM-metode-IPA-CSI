<?php
session_start();
unset($_SESSION['pelanggan']);
echo "<script>window.location.replace('login.php');</script>";