<?php
// Veritabanı bağlantı ayarları
define('DB_HOST', 'localhost');
define('DB_NAME', 'hunkar_baklava');
define('DB_USER', 'root'); // Sunucunuzda değiştirin
define('DB_PASS', ''); // Sunucunuzda değiştirin
define('DB_CHARSET', 'utf8mb4');

// PDO bağlantısı
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// Site ayarları
define('SITE_URL', 'http://localhost/hunkarwebsite'); // Sunucunuzda değiştirin
define('ADMIN_URL', SITE_URL . '/admin');
define('UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'] . '/hunkarwebsite/uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');

// Session ayarları - auth.php dosyasında yönetiliyor

// Güvenlik fonksiyonları
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// CSRF token fonksiyonları auth.php dosyasında tanımlanmıştır

// Admin kontrol fonksiyonları auth.php dosyasında tanımlanmıştır

// Dosya yükleme fonksiyonu
function upload_file($file, $directory = 'images') {
    $upload_dir = UPLOAD_PATH . $directory . '/';
    
    // Dizin yoksa oluştur
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    if (!in_array($file_extension, $allowed_extensions)) {
        return false;
    }
    
    $file_name = uniqid() . '.' . $file_extension;
    $file_path = $upload_dir . $file_name;
    
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return $directory . '/' . $file_name;
    }
    
    return false;
}

// Tarih formatı
function format_date($date, $format = 'd.m.Y H:i') {
    return date($format, strtotime($date));
}

// Slug oluşturma
function create_slug($string) {
    $string = strtolower($string);
    $string = str_replace(['ç', 'ğ', 'ı', 'ö', 'ş', 'ü'], ['c', 'g', 'i', 'o', 's', 'u'], $string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}
?> 