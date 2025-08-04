# Hünkar Baklava - Admin Panel Kurulum Kılavuzu

## 🚀 Kurulum Adımları

### 1. Veritabanı Kurulumu
1. MySQL veritabanınızda `database.sql` dosyasını çalıştırın
2. Veritabanı bağlantı ayarlarını `admin/config/database.php` dosyasında güncelleyin

### 2. Sunucu Gereksinimleri
- PHP 7.4 veya üzeri
- MySQL 5.7 veya üzeri
- Apache/Nginx web sunucusu
- GD kütüphanesi (resim işleme için)

### 3. Dosya İzinleri
```bash
chmod 755 uploads/
chmod 755 uploads/images/
chmod 755 uploads/products/
chmod 755 uploads/blog/
```

### 4. Admin Giriş Bilgileri
- **URL:** `http://yourdomain.com/hunkarwebsite/admin`
- **Kullanıcı Adı:** `admin`
- **Şifre:** `admin123`

## 📁 Dosya Yapısı

```
hunkarwebsite/
├── admin/
│   ├── config/
│   │   └── database.php
│   ├── index.php (Dashboard)
│   ├── login.php
│   ├── logout.php
│   ├── products.php
│   ├── blog.php
│   ├── testimonials.php
│   └── about.php
├── uploads/
│   ├── images/
│   ├── products/
│   └── blog/
├── assets/
│   ├── css/
│   ├── js/
│   └── img/
├── lang/
│   ├── tr.json
│   └── en.json
├── database.sql
└── README.md
```

## 🔧 Özellikler

### Admin Panel Özellikleri
- ✅ Güvenli giriş sistemi
- ✅ Ürün yönetimi (CRUD)
- ✅ Blog yazısı yönetimi
- ✅ Müşteri yorumları yönetimi
- ✅ Hakkımızda sayfası düzenleme
- ✅ Resim yükleme sistemi
- ✅ Çok dilli içerik desteği
- ✅ Responsive tasarım

### Veritabanı Tabloları
- `admin_users` - Admin kullanıcıları
- `product_categories` - Ürün kategorileri
- `products` - Ürünler
- `blog_categories` - Blog kategorileri
- `blog_posts` - Blog yazıları
- `about_content` - Hakkımızda içeriği
- `testimonials` - Müşteri yorumları
- `contact_info` - İletişim bilgileri
- `site_settings` - Site ayarları

## 🛠️ Güvenlik Özellikleri

- CSRF token koruması
- SQL injection koruması (PDO prepared statements)
- XSS koruması (htmlspecialchars)
- Dosya yükleme güvenliği
- Session yönetimi
- Şifre hashleme (password_hash)

## 📱 Responsive Tasarım

Admin paneli tüm cihazlarda çalışır:
- Desktop (1200px+)
- Tablet (768px - 1199px)
- Mobile (320px - 767px)

## 🔄 Güncelleme

### Yeni Admin Kullanıcısı Ekleme
```sql
INSERT INTO admin_users (username, password, email, full_name, role) 
VALUES ('yeni_kullanici', '$2y$10$...', 'email@domain.com', 'Ad Soyad', 'editor');
```

### Şifre Değiştirme
```sql
UPDATE admin_users 
SET password = '$2y$10$yeni_hash' 
WHERE username = 'admin';
```

## 🐛 Sorun Giderme

### Yaygın Sorunlar

1. **Veritabanı Bağlantı Hatası**
   - `admin/config/database.php` dosyasındaki ayarları kontrol edin
   - MySQL servisinin çalıştığından emin olun

2. **Resim Yükleme Hatası**
   - `uploads/` dizininin yazma izinlerini kontrol edin
   - PHP GD kütüphanesinin yüklü olduğundan emin olun

3. **Session Hatası**
   - PHP session ayarlarını kontrol edin
   - Sunucu zaman dilimini kontrol edin

## 📞 Destek

Herhangi bir sorun yaşarsanız:
1. Hata mesajlarını kontrol edin
2. PHP error loglarını inceleyin
3. Veritabanı bağlantısını test edin

## 🔒 Güvenlik Notları

- Admin şifresini değiştirmeyi unutmayın
- Düzenli olarak yedek alın
- Sunucu güvenlik güncellemelerini takip edin
- SSL sertifikası kullanın (production'da)

## 📈 Performans

- Resimleri optimize edin
- Veritabanı indekslerini kontrol edin
- CDN kullanmayı düşünün
- Caching mekanizmaları ekleyin 