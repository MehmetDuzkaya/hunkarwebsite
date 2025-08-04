<?php
require_once 'config/database.php';

// Session'ı temizle
session_destroy();

// Login sayfasına yönlendir
header('Location: login.php');
exit();
?> 