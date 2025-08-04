<?php
require_once 'admin/config/database.php';

// Onaylanmış yorumları getir
$stmt = $pdo->query("SELECT * FROM testimonials WHERE is_approved = 1 AND is_featured = 1 ORDER BY created_at DESC LIMIT 3");
$featured_testimonials = $stmt->fetchAll();

// Son blog yazılarını getir
$stmt = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 3");
$recent_posts = $stmt->fetchAll();

// Hakkımızda kısa içeriği getir
$stmt = $pdo->query("SELECT * FROM about_content WHERE section_name = 'main' AND is_active = 1 LIMIT 1");
$about_main = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-key="pageTitle">Ana Sayfa - Hünkar Baklava</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <!-- Header -->
  <header class="site-header">
    <div class="container header-flex">
      <a href="index_dynamic.php" class="logo"><span>Hünkar</span> Baklava</a>
      <nav class="main-nav">
        <ul>
          <li><a href="index_dynamic.php" data-key="home">Ana Sayfa</a></li>
                     <li><a href="urunler_dynamic.php" data-key="products">Ürünler</a></li>
          <li><a href="hakkimizda_dynamic.php" data-key="about">Hakkımızda</a></li>
          <li><a href="blog_dynamic.php" data-key="blog">Blog</a></li>
                     <li><a href="iletisim_dynamic.php" data-key="contact">İletişim</a></li>
        </ul>
      </nav>
      <select id="lang-switcher">
        <option value="tr">TR</option>
        <option value="en">EN</option>
      </select>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container hero-content">
      <h1 data-key="welcome">En Taze ve Geleneksel Baklavalar</h1>
      <p data-key="subtext">Usta ellerden size özel tatlar</p>
             <a href="urunler_dynamic.php" class="btn-order" data-key="orderNow">Sipariş Ver</a>
    </div>
  </section>

  <!-- Ürün Kategorileri -->
  <section class="categories">
    <div class="container">
      <h2 class="section-title" data-key="baklavaTitle">Baklava Çeşitleri</h2>
      <div class="category-slider">
        <div class="category-card">
          <img src="assets/img/classic.jpg" alt="Klasik Baklava">
          <h3 data-key="classicBaklava">Klasik Baklava</h3>
        </div>
        <div class="category-card">
          <img src="assets/img/pistachio.jpg" alt="Fıstıklı Baklava">
          <h3 data-key="pistachioBaklava">Fıstıklı Baklava</h3>
        </div>
        <div class="category-card">
          <img src="assets/img/walnut.jpg" alt="Cevizli Baklava">
          <h3 data-key="walnutBaklava">Cevizli Baklava</h3>
        </div>
      </div>
    </div>
  </section>

  <!-- Hakkımızda Kısa Tanıtım -->
  <section class="about-short">
    <div class="container about-flex">
      <div class="about-text">
        <h2 data-key="about">Hakkımızda</h2>
        <p data-key="aboutText">
          <?php if ($about_main): ?>
            <?php echo htmlspecialchars(substr($about_main['content_tr'], 0, 200)) . '...'; ?>
          <?php else: ?>
            Gelenekten geleceğe uzanan lezzet yolculuğu. 30 yılı aşkın süredir en kaliteli malzemelerle baklava üretiyoruz.
          <?php endif; ?>
        </p>
        <a href="hakkimizda_dynamic.php" class="btn-more" data-key="readMore">Daha Fazla</a>
      </div>
      <div class="about-img">
        <?php if ($about_main && $about_main['image_path']): ?>
          <img src="uploads/<?php echo htmlspecialchars($about_main['image_path']); ?>" alt="Hakkımızda">
        <?php else: ?>
          <img src="assets/img/about.jpg" alt="Hakkımızda">
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Blog Öne Çıkanlar -->
  <section class="blog-featured">
    <div class="container">
      <h2 class="section-title" data-key="blogTitle">Blogdan Seçtiklerimiz</h2>
      <div class="blog-cards">
        <?php if (!empty($recent_posts)): ?>
          <?php foreach ($recent_posts as $post): ?>
            <div class="blog-card">
              <?php if ($post['image_path']): ?>
                <img src="uploads/<?php echo htmlspecialchars($post['image_path']); ?>" alt="<?php echo htmlspecialchars($post['title_tr']); ?>">
              <?php else: ?>
                <img src="assets/img/blog1.jpg" alt="Blog">
              <?php endif; ?>
              <h3><?php echo htmlspecialchars($post['title_tr']); ?></h3>
              <p><?php echo htmlspecialchars($post['excerpt_tr'] ?: substr($post['content_tr'], 0, 100) . '...'); ?></p>
              <a href="blog_dynamic.php" class="btn-more" data-key="readMore">Devamı</a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="blog-card">
            <img src="assets/img/blog1.jpg" alt="Blog 1">
            <h3 data-key="blog1Title">Baklavanın Tarihi</h3>
            <p data-key="blog1Desc">Baklavanın kökeni ve Osmanlı mutfağındaki yeri.</p>
            <a href="blog_dynamic.php" class="btn-more" data-key="readMore">Devamı</a>
          </div>
          <div class="blog-card">
            <img src="assets/img/blog2.jpg" alt="Blog 2">
            <h3 data-key="blog2Title">En İyi Malzeme Seçimi</h3>
            <p data-key="blog2Desc">Lezzetin sırrı kaliteli malzemede saklıdır.</p>
            <a href="blog_dynamic.php" class="btn-more" data-key="readMore">Devamı</a>
          </div>
          <div class="blog-card">
            <img src="assets/img/blog3.jpg" alt="Blog 3">
            <h3 data-key="blog3Title">Usta İpuçları</h3>
            <p data-key="blog3Desc">Evde baklava yapmanın püf noktaları.</p>
            <a href="blog_dynamic.php" class="btn-more" data-key="readMore">Devamı</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Müşteri Yorumları -->
  <section class="testimonials">
    <div class="container">
      <h2 class="section-title" data-key="testimonialsTitle">Müşteri Yorumları</h2>
      <div class="testimonial-cards">
        <?php if (!empty($featured_testimonials)): ?>
          <?php foreach ($featured_testimonials as $testimonial): ?>
            <div class="testimonial-card">
              <p><?php echo htmlspecialchars($testimonial['comment_tr']); ?></p>
              <div class="testimonial-info">
                <span class="testimonial-name"><?php echo htmlspecialchars($testimonial['customer_name']); ?></span>
                <span class="testimonial-stars">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php echo $i <= $testimonial['rating'] ? '★' : '☆'; ?>
                  <?php endfor; ?>
                </span>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="testimonial-card">
            <p data-key="testimonial1">"Hayatımda yediğim en taze baklava!"</p>
            <div class="testimonial-info">
              <span class="testimonial-name">Ayşe K.</span>
              <span class="testimonial-stars">★★★★★</span>
            </div>
          </div>
          <div class="testimonial-card">
            <p data-key="testimonial2">"Siparişim çok hızlı ve özenli geldi, teşekkürler!"</p>
            <div class="testimonial-info">
              <span class="testimonial-name">John D.</span>
              <span class="testimonial-stars">★★★★★</span>
            </div>
          </div>
          <div class="testimonial-card">
            <p data-key="testimonial3">"Gerçekten geleneksel bir lezzet, herkese tavsiye ederim."</p>
            <div class="testimonial-info">
              <span class="testimonial-name">Elif T.</span>
              <span class="testimonial-stars">★★★★★</span>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Harita ve İletişim -->
  <section class="contact-map">
    <div class="container contact-flex">
      <div class="contact-info">
        <h2 data-key="contact">İletişim</h2>
        <p data-key="address">Adres: Baklavacılar Cad. No:1, Gaziantep</p>
        <p data-key="phone">Telefon: 0 555 555 55 55</p>
        <p data-key="email">Email: info@hunkarbaklava.com</p>
      </div>
      <div class="map-embed">
        <iframe src="https://www.google.com/maps/d/embed?mid=1Qw8Qw8Qw8Qw8Qw8Qw8Qw8Qw8Qw8" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container footer-flex">
      <div class="footer-logo">Hünkar Baklava</div>
      <div class="footer-links">
        <a href="#" class="instagram" title="Instagram"></a>
        <a href="#" class="facebook" title="Facebook"></a>
        <a href="#" class="twitter" title="X (Twitter)"></a>
      </div>
      <div class="footer-contact">
        <span>info@hunkarbaklava.com</span>
        <span>0 555 555 55 55</span>
      </div>
      <div class="footer-map">
        <iframe src="https://www.google.com/maps/d/embed?mid=1Qw8Qw8Qw8Qw8Qw8Qw8Qw8Qw8Qw8" width="120" height="80" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </footer>

  <script src="assets/js/main.js"></script>
</body>
</html> 