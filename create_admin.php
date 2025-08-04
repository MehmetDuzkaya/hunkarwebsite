<?php
// Geçici admin oluşturma scripti
// Bu dosyayı çalıştırdıktan sonra silin!

// Veritabanı bağlantısı
$host = 'localhost';
$dbname = 'hunkar_baklava';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mevcut admin kullanıcısını sil
    $stmt = $pdo->prepare("DELETE FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    
    // Yeni admin kullanıcısı oluştur
    $admin_password = 'admin123';
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO admin_users (username, password, email, full_name, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute(['admin', $hashed_password, 'admin@hunkarbaklava.com', 'Site Yöneticisi', 'admin']);
    
    echo "Admin kullanıcısı başarıyla oluşturuldu!<br>";
    echo "Kullanıcı Adı: admin<br>";
    echo "Şifre: admin123<br>";
    echo "Hash: " . $hashed_password . "<br>";
    echo "<br>Bu dosyayı şimdi silebilirsiniz!";
    
} catch(PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?> 