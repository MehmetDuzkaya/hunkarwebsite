<?php
require_once 'admin/config/database.php';

// İletişim bilgilerini getir
$stmt = $pdo->query("SELECT * FROM contact_info WHERE is_active = 1 LIMIT 1");
$contact_info = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <title data-key="contactPageTitle">İletişim - Hünkar Baklava</title>
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
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container hero-content">
                       <h1 data-key="contact">İletişim</h1>
                 <p data-key="subtext">Bizimle iletişime geçin</p>
    </div>
  </section>

  <!-- İletişim Bilgileri -->
  <section class="contact-map">
    <div class="container contact-flex">
      <div class="contact-info">
        <h2>İletişim Bilgileri</h2>
        <?php if ($contact_info): ?>
          <p><strong>Adres:</strong> <?php echo isset($contact_info['address']) ? htmlspecialchars($contact_info['address']) : 'Adres bilgisi eklenmedi.'; ?></p>
          <p><strong>Telefon:</strong> <?php echo isset($contact_info['phone']) ? htmlspecialchars($contact_info['phone']) : 'Telefon bilgisi eklenmedi.'; ?></p>
          <p><strong>E-posta:</strong> <?php echo isset($contact_info['email']) ? htmlspecialchars($contact_info['email']) : 'E-posta bilgisi eklenmedi.'; ?></p>
          <?php if (isset($contact_info['working_hours'])): ?>
            <p><strong>Çalışma Saatleri:</strong> <?php echo htmlspecialchars($contact_info['working_hours']); ?></p>
          <?php endif; ?>
        <?php else: ?>
          <p><strong>Adres:</strong> Baklavacılar Cad. No:1, Gaziantep</p>
          <p><strong>Telefon:</strong> 0 555 555 55 55</p>
          <p><strong>E-posta:</strong> info@hunkarbaklava.com</p>
          <p><strong>Çalışma Saatleri:</strong> Hafta içi: 08:00-20:00, Hafta sonu: 09:00-18:00</p>
        <?php endif; ?>
        
        <div class="social-links" style="margin-top: 30px;">
          <h3>Sosyal Medya</h3>
          <div class="social-icons">
            <a href="#" class="instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" class="facebook" title="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="#" class="twitter" title="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
            <a href="#" class="whatsapp" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          </div>
        </div>
      </div>
      <div class="map-embed">
        <iframe src="https://www.google.com/maps/d/embed?mid=1Qw8Qw8Qw8Qw8Qw8Qw8Qw8Qw8Qw8" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </section>

  <!-- İletişim Formu -->
  <section class="contact-form" style="padding: 60px 0; background: #f9f9f9;">
    <div class="container">
                       <h2 style="text-align: center; margin-bottom: 40px;" data-key="contactFormTitle">Bize Ulaşın</h2>
      <div style="max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <form>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                                       <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;" data-key="contactFormName">Ad Soyad *</label>
                         <input type="text" id="name" name="name" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
                                   <div>
                         <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;" data-key="contactFormEmail">E-posta *</label>
                         <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                       </div>
          </div>
                               <div style="margin-bottom: 20px;">
                       <label for="phone" style="display: block; margin-bottom: 5px; font-weight: bold;" data-key="contactFormPhone">Telefon</label>
                       <input type="tel" id="phone" name="phone" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                     </div>
                               <div style="margin-bottom: 20px;">
                       <label for="subject" style="display: block; margin-bottom: 5px; font-weight: bold;" data-key="contactFormSubject">Konu *</label>
                       <select id="subject" name="subject" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                         <option value="" data-key="contactFormSubjectSelect">Konu seçin</option>
                         <option value="siparis" data-key="contactFormSubjectOrder">Sipariş</option>
                         <option value="bilgi" data-key="contactFormSubjectInfo">Bilgi Talebi</option>
                         <option value="oneri" data-key="contactFormSubjectSuggestion">Öneri/Şikayet</option>
                         <option value="diger" data-key="contactFormSubjectOther">Diğer</option>
                       </select>
                     </div>
                               <div style="margin-bottom: 20px;">
                       <label for="message" style="display: block; margin-bottom: 5px; font-weight: bold;" data-key="contactFormMessage">Mesajınız *</label>
                       <textarea id="message" name="message" required style="width: 100%; height: 120px; padding: 12px; border: 1px solid #ddd; border-radius: 8px; resize: vertical;"></textarea>
                     </div>
                               <button type="submit" style="width: 100%; padding: 15px; background: var(--pistachio-green); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s;">
                       <i class="fas fa-paper-plane"></i> <span data-key="contactFormSend">Mesaj Gönder</span>
                     </button>
        </form>
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