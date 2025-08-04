-- Hünkar Baklava Veritabanı Yapısı
-- MySQL 8.0+ uyumlu

CREATE DATABASE IF NOT EXISTS hunkar_baklava CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hunkar_baklava;

-- Admin kullanıcıları tablosu
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'editor') DEFAULT 'editor',
    is_active BOOLEAN DEFAULT TRUE,
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Ürün kategorileri tablosu
CREATE TABLE product_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_tr VARCHAR(100) NOT NULL,
    name_en VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Ürünler tablosu
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name_tr VARCHAR(200) NOT NULL,
    name_en VARCHAR(200) NOT NULL,
    description_tr TEXT,
    description_en TEXT,
    image_path VARCHAR(255),
    price DECIMAL(10,2),
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES product_categories(id) ON DELETE CASCADE
);

-- Blog kategorileri tablosu
CREATE TABLE blog_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_tr VARCHAR(100) NOT NULL,
    name_en VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blog yazıları tablosu
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    title_tr VARCHAR(200) NOT NULL,
    title_en VARCHAR(200) NOT NULL,
    content_tr LONGTEXT,
    content_en LONGTEXT,
    excerpt_tr TEXT,
    excerpt_en TEXT,
    image_path VARCHAR(255),
    slug VARCHAR(200) UNIQUE NOT NULL,
    author_id INT NOT NULL,
    status ENUM('draft', 'published') DEFAULT 'draft',
    featured_image VARCHAR(255),
    meta_description_tr VARCHAR(300),
    meta_description_en VARCHAR(300),
    view_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    published_at DATETIME,
    FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE SET NULL,
    FOREIGN KEY (author_id) REFERENCES admin_users(id) ON DELETE CASCADE
);

-- Hakkımızda sayfası içeriği
CREATE TABLE about_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_name VARCHAR(100) NOT NULL,
    title_tr VARCHAR(200),
    title_en VARCHAR(200),
    content_tr LONGTEXT,
    content_en LONGTEXT,
    image_path VARCHAR(255),
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Müşteri yorumları tablosu
CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    comment_tr TEXT NOT NULL,
    comment_en TEXT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    is_approved BOOLEAN DEFAULT FALSE,
    is_featured BOOLEAN DEFAULT FALSE,
    customer_email VARCHAR(100),
    customer_phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- İletişim bilgileri tablosu
CREATE TABLE contact_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50) NOT NULL, -- address, phone, email, social_media
    value_tr TEXT NOT NULL,
    value_en TEXT NOT NULL,
    icon VARCHAR(50),
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Site ayarları tablosu
CREATE TABLE site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    value_tr TEXT,
    value_en TEXT,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Varsayılan veriler

-- Admin kullanıcısı (şifre: admin123)
INSERT INTO admin_users (username, password, email, full_name, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@hunkarbaklava.com', 'Site Yöneticisi', 'admin');

-- Ürün kategorileri
INSERT INTO product_categories (name_tr, name_en, slug, sort_order) VALUES 
('Baklava Çeşitleri', 'Baklava Varieties', 'baklava-cesitleri', 1),
('Tatlı Çeşitleri', 'Dessert Varieties', 'tatli-cesitleri', 2),
('Börek Çeşitleri', 'Pastry Varieties', 'borek-cesitleri', 3),
('Pasta Çeşitleri', 'Cake Varieties', 'pasta-cesitleri', 4);

-- Blog kategorileri
INSERT INTO blog_categories (name_tr, name_en, slug) VALUES 
('Baklava Tarihi', 'Baklava History', 'baklava-tarihi'),
('Tarifler', 'Recipes', 'tarifler'),
('Haberler', 'News', 'haberler');

-- Hakkımızda içeriği
INSERT INTO about_content (section_name, title_tr, title_en, content_tr, content_en, sort_order) VALUES 
('main', 'Hakkımızda', 'About Us', 'Hünkar Baklava, 30 yılı aşkın süredir geleneksel tariflerle ve en kaliteli malzemelerle baklava üretmektedir. Misyonumuz, Türk mutfağının bu eşsiz lezzetini tüm dünyaya en taze ve doğal haliyle sunmaktır.', 'Hunkar Baklava has been producing baklava with traditional recipes and the highest quality ingredients for over 30 years. Our mission is to serve this unique taste of Turkish cuisine to the whole world in its freshest and most natural form.', 1),
('vision', 'Vizyonumuz', 'Our Vision', 'Vizyonumuz, baklava denince akla gelen ilk marka olmak ve lezzet yolculuğumuzu nesilden nesile aktarmaktır.', 'Our vision is to be the first brand that comes to mind when baklava is mentioned and to pass on our taste journey from generation to generation.', 2);

-- İletişim bilgileri
INSERT INTO contact_info (type, value_tr, value_en, icon, sort_order) VALUES 
('address', 'Baklavacılar Cad. No:1, Gaziantep', 'Baklavacilar St. No:1, Gaziantep', 'map-marker', 1),
('phone', '0 555 555 55 55', '0 555 555 55 55', 'phone', 2),
('email', 'info@hunkarbaklava.com', 'info@hunkarbaklava.com', 'envelope', 3);

-- Site ayarları
INSERT INTO site_settings (setting_key, value_tr, value_en, description) VALUES 
('site_title', 'Hünkar Baklava', 'Hunkar Baklava', 'Site başlığı'),
('site_description', 'En taze ve geleneksel baklavalar', 'Fresh and traditional baklavas', 'Site açıklaması'),
('hero_title', 'En Taze ve Geleneksel Baklavalar', 'Fresh and Traditional Baklavas', 'Ana sayfa hero başlığı'),
('hero_subtitle', 'Usta ellerden size özel tatlar', 'Special flavors from expert hands', 'Ana sayfa hero alt başlığı');

-- Örnek müşteri yorumları
INSERT INTO testimonials (customer_name, comment_tr, comment_en, rating, is_approved, is_featured) VALUES 
('Ahmet Yılmaz', 'Hayatımda yediğim en taze baklava!', 'The freshest baklava I have ever eaten!', 5, TRUE, TRUE),
('Ayşe Demir', 'Siparişim çok hızlı ve özenli geldi, teşekkürler!', 'My order arrived very quickly and carefully, thank you!', 5, TRUE, TRUE),
('Mehmet Kaya', 'Gerçekten geleneksel bir lezzet, herkese tavsiye ederim.', 'A truly traditional taste, I recommend it to everyone.', 5, TRUE, TRUE); 