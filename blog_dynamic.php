<?php
require_once 'admin/config/database.php';

// Blog yazılarını getir
$stmt = $pdo->query("SELECT bp.*, bc.name_tr as category_name FROM blog_posts bp LEFT JOIN blog_categories bc ON bp.category_id = bc.id WHERE bp.status = 'published' ORDER BY bp.published_at DESC");
$posts = $stmt->fetchAll();

// Blog kategorilerini getir
$stmt = $pdo->query("SELECT * FROM blog_categories WHERE is_active = 1 ORDER BY name_tr");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                 <title data-key="blogPageTitle">Blog - Hünkar Baklava</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .blog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .blog-header {
            text-align: center;
            margin-bottom: 50px;
        }
        .blog-header h1 {
            color: var(--pistachio-green);
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }
        .blog-post {
            background: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .blog-post:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }
        .blog-post img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .blog-post-content {
            padding: 20px;
        }
        .blog-post h3 {
            color: var(--pistachio-green);
            margin-bottom: 10px;
            font-size: 1.3em;
        }
        .blog-post-meta {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 15px;
        }
        .blog-post-excerpt {
            color: #333;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .blog-categories {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        .category-btn {
            background: var(--pistachio-green);
            color: white;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .category-btn:hover {
            background: var(--light-green);
        }
        .category-btn.active {
            background: var(--light-green);
        }
        .no-posts {
            text-align: center;
            color: #666;
            font-size: 1.2em;
            margin: 50px 0;
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

    <div class="blog-container">
        <div class="blog-header">
            <h1><i class="fas fa-newspaper"></i> Blog</h1>
            <p>Baklava dünyasından en güncel haberler ve tarifler</p>
        </div>

        <div class="blog-categories">
            <a href="blog_dynamic.php" class="category-btn active">Tümü</a>
            <?php foreach ($categories as $category): ?>
                <a href="blog_dynamic.php?category=<?php echo $category['id']; ?>" class="category-btn">
                    <?php echo htmlspecialchars($category['name_tr']); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if (empty($posts)): ?>
            <div class="no-posts">
                <i class="fas fa-newspaper" style="font-size: 3em; color: #ddd; margin-bottom: 20px;"></i>
                <p>Henüz blog yazısı bulunmuyor.</p>
            </div>
        <?php else: ?>
            <div class="blog-grid">
                <?php foreach ($posts as $post): ?>
                    <article class="blog-post">
                        <?php if ($post['image_path']): ?>
                            <img src="uploads/<?php echo htmlspecialchars($post['image_path']); ?>" alt="<?php echo htmlspecialchars($post['title_tr']); ?>">
                        <?php else: ?>
                            <img src="assets/img/blog-default.jpg" alt="Blog Resmi">
                        <?php endif; ?>
                        
                        <div class="blog-post-content">
                            <h3><?php echo htmlspecialchars($post['title_tr']); ?></h3>
                            <div class="blog-post-meta">
                                <i class="fas fa-folder"></i> <?php echo htmlspecialchars($post['category_name']); ?> |
                                <i class="fas fa-calendar"></i> <?php echo format_date($post['published_at']); ?>
                            </div>
                            <div class="blog-post-excerpt">
                                <?php echo htmlspecialchars($post['excerpt_tr'] ?: substr($post['content_tr'], 0, 150) . '...'); ?>
                            </div>
                            <a href="blog_post.php?id=<?php echo $post['id']; ?>" class="btn-more">
                                Devamını Oku
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
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