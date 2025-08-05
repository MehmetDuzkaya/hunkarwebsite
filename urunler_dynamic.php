<?php
require_once 'admin/config/database.php';

// Ürün kategorilerini getir
$stmt = $pdo->query("SELECT * FROM product_categories ORDER BY display_order");
$categories = $stmt->fetchAll();

// Her kategori için ürünleri getir
$products_by_category = [];
foreach ($categories as $category) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? AND is_active = 1 ORDER BY display_order");
    $stmt->execute([$category['id']]);
    $products_by_category[$category['id']] = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <title data-key="productsPageTitle">Ürünlerimiz - Hünkar Baklava</title>
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
                       <h1 data-key="products">Ürünlerimiz</h1>
                 <p data-key="subtext">Geleneksel lezzetler, modern sunum</p>
    </div>
  </section>

  <!-- Ürün Kategorileri -->
  <?php foreach ($categories as $category): ?>
    <section class="categories">
      <div class="container">
        <h2 class="section-title"><?php echo htmlspecialchars($category['name_tr']); ?></h2>
        <div class="category-slider">
          <?php if (isset($products_by_category[$category['id']]) && !empty($products_by_category[$category['id']])): ?>
            <?php foreach ($products_by_category[$category['id']] as $product): ?>
              <div class="category-card">
                <?php if ($product['image_path']): ?>
                  <img src="uploads/<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name_tr']); ?>">
                <?php else: ?>
                  <img src="assets/img/classic.jpg" alt="<?php echo htmlspecialchars($product['name_tr']); ?>">
                <?php endif; ?>
                <h3><?php echo htmlspecialchars($product['name_tr']); ?></h3>
                <?php if ($product['description_tr']): ?>
                  <p><?php echo htmlspecialchars(substr($product['description_tr'], 0, 100)) . '...'; ?></p>
                <?php endif; ?>
                <?php if ($product['price']): ?>
                  <div class="price"><?php echo number_format($product['price'], 2); ?> ₺</div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <!-- Varsayılan ürünler -->
            <?php if ($category['name_tr'] === 'Baklava Çeşitleri'): ?>
              <div class="category-card">
                <img src="assets/img/classic.jpg" alt="Klasik Baklava">
                <h3>Klasik Baklava</h3>
                <p>Geleneksel tarifimizle hazırlanan klasik baklava</p>
                <div class="price">150.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/pistachio.jpg" alt="Fıstıklı Baklava">
                <h3>Fıstıklı Baklava</h3>
                <p>Antep fıstığı ile zenginleştirilmiş özel tarif</p>
                <div class="price">180.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/walnut.jpg" alt="Cevizli Baklava">
                <h3>Cevizli Baklava</h3>
                <p>Taze ceviz içi ile hazırlanan lezzetli baklava</p>
                <div class="price">160.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/honey.jpg" alt="Bal Baklava">
                <h3>Bal Baklava</h3>
                <p>Doğal bal ile tatlandırılmış özel baklava</p>
                <div class="price">170.00 ₺</div>
              </div>
            <?php elseif ($category['name_tr'] === 'Tatlı Çeşitleri'): ?>
              <div class="category-card">
                <img src="assets/img/kunefe.jpg" alt="Künefe">
                <h3>Künefe</h3>
                <p>Geleneksel künefe tarifimiz</p>
                <div class="price">120.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/sutlac.jpg" alt="Sütlaç">
                <h3>Sütlaç</h3>
                <p>Fırında pişirilmiş geleneksel sütlaç</p>
                <div class="price">80.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/kazandibi.jpg" alt="Kazandibi">
                <h3>Kazandibi</h3>
                <p>Özel tarifimizle hazırlanan kazandibi</p>
                <div class="price">90.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/ayva.jpg" alt="Ayva Tatlısı">
                <h3>Ayva Tatlısı</h3>
                <p>Mevsiminde taze ayva ile hazırlanan tatlı</p>
                <div class="price">100.00 ₺</div>
              </div>
            <?php elseif ($category['name_tr'] === 'Börek Çeşitleri'): ?>
              <div class="category-card">
                <img src="assets/img/su-boregi.jpg" alt="Su Böreği">
                <h3>Su Böreği</h3>
                <p>Geleneksel su böreği tarifimiz</p>
                <div class="price">60.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/kol-boregi.jpg" alt="Kol Böreği">
                <h3>Kol Böreği</h3>
                <p>Peynirli kol böreği</p>
                <div class="price">50.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/sigara-boregi.jpg" alt="Sigara Böreği">
                <h3>Sigara Böreği</h3>
                <p>Peynirli sigara böreği</p>
                <div class="price">40.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/tepsi-boregi.jpg" alt="Tepsi Böreği">
                <h3>Tepsi Böreği</h3>
                <p>Geleneksel tepsi böreği</p>
                <div class="price">70.00 ₺</div>
              </div>
            <?php elseif ($category['name_tr'] === 'Pasta Çeşitleri'): ?>
              <div class="category-card">
                <img src="assets/img/chocolate-cake.jpg" alt="Çikolatalı Pasta">
                <h3>Çikolatalı Pasta</h3>
                <p>Zengin çikolata ile hazırlanan pasta</p>
                <div class="price">200.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/fruit-cake.jpg" alt="Meyveli Pasta">
                <h3>Meyveli Pasta</h3>
                <p>Taze meyvelerle süslenmiş pasta</p>
                <div class="price">180.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/cheesecake.jpg" alt="Cheesecake">
                <h3>Cheesecake</h3>
                <p>Klasik New York cheesecake</p>
                <div class="price">220.00 ₺</div>
              </div>
              <div class="category-card">
                <img src="assets/img/tiramisu.jpg" alt="Tiramisu">
                <h3>Tiramisu</h3>
                <p>İtalyan usulü tiramisu</p>
                <div class="price">240.00 ₺</div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endforeach; ?>

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