<?php
require_once 'admin/config/database.php';

// Hakkımızda içeriklerini getir
$stmt = $pdo->query("SELECT * FROM about_content WHERE is_active = 1 ORDER BY sort_order ASC");
$about_sections = $stmt->fetchAll();

// İçerikleri section_name'e göre düzenle
$sections = [];
foreach ($about_sections as $section) {
    $sections[$section['section_name']] = $section;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                 <title data-key="aboutPageTitle">Hakkımızda - Hünkar Baklava</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .about-header {
            text-align: center;
            margin-bottom: 50px;
        }
        .about-header h1 {
            color: var(--pistachio-green);
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .about-section {
            background: white;
            border-radius: var(--radius-lg);
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-soft);
        }
        .about-section h2 {
            color: var(--pistachio-green);
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
        }
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }
        .about-text {
            line-height: 1.8;
            color: #333;
            font-size: 1.1em;
        }
        .about-image {
            text-align: center;
        }
        .about-image img {
            max-width: 100%;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-soft);
        }
        .about-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin: 50px 0;
        }
        .stat-item {
            text-align: center;
            padding: 30px;
            background: var(--pistachio-green);
            color: white;
            border-radius: var(--radius-lg);
        }
        .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .stat-label {
            font-size: 1.1em;
        }
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        .back-link a {
            color: var(--pistachio-green);
            text-decoration: none;
            font-weight: bold;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .about-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
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

    <div class="about-container">
        <div class="about-header">
            <h1><i class="fas fa-info-circle"></i> Hakkımızda</h1>
            <p>30 yıllık lezzet yolculuğumuz</p>
        </div>

        <?php if (isset($sections['main'])): ?>
        <section class="about-section">
            <h2><?php echo htmlspecialchars($sections['main']['title_tr']); ?></h2>
            <div class="about-content">
                <div class="about-text">
                    <?php echo nl2br(htmlspecialchars($sections['main']['content_tr'])); ?>
                </div>
                <?php if ($sections['main']['image_path']): ?>
                <div class="about-image">
                    <img src="uploads/<?php echo htmlspecialchars($sections['main']['image_path']); ?>" alt="Hakkımızda">
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <div class="about-stats">
            <div class="stat-item">
                <div class="stat-number">30+</div>
                <div class="stat-label">Yıllık Deneyim</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Mutlu Müşteri</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Ürün Çeşidi</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Hizmet</div>
            </div>
        </div>

        <?php if (isset($sections['vision'])): ?>
        <section class="about-section">
            <h2><?php echo htmlspecialchars($sections['vision']['title_tr']); ?></h2>
            <div class="about-content">
                <?php if ($sections['vision']['image_path']): ?>
                <div class="about-image">
                    <img src="uploads/<?php echo htmlspecialchars($sections['vision']['image_path']); ?>" alt="Vizyonumuz">
                </div>
                <?php endif; ?>
                <div class="about-text">
                    <?php echo nl2br(htmlspecialchars($sections['vision']['content_tr'])); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (isset($sections['mission'])): ?>
        <section class="about-section">
            <h2><?php echo htmlspecialchars($sections['mission']['title_tr']); ?></h2>
            <div class="about-content">
                <div class="about-text">
                    <?php echo nl2br(htmlspecialchars($sections['mission']['content_tr'])); ?>
                </div>
                <?php if ($sections['mission']['image_path']): ?>
                <div class="about-image">
                    <img src="uploads/<?php echo htmlspecialchars($sections['mission']['image_path']); ?>" alt="Misyonumuz">
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <?php if (isset($sections['history'])): ?>
        <section class="about-section">
            <h2><?php echo htmlspecialchars($sections['history']['title_tr']); ?></h2>
            <div class="about-content">
                <?php if ($sections['history']['image_path']): ?>
                <div class="about-image">
                    <img src="uploads/<?php echo htmlspecialchars($sections['history']['image_path']); ?>" alt="Tarihçemiz">
                </div>
                <?php endif; ?>
                <div class="about-text">
                    <?php echo nl2br(htmlspecialchars($sections['history']['content_tr'])); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <div class="back-link">
            <a href="index.html"><i class="fas fa-arrow-left"></i> Ana Sayfaya Dön</a>
        </div>
    </div>

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
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html> 