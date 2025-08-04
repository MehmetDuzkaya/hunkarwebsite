<?php
require_once 'config/database.php';
require_once 'auth.php';
require_admin_login();
check_session_timeout();

// Define admin access constant
define('ADMIN_ACCESS', true);

// Set page title
$page_title = 'Dashboard';

// İstatistikleri al
$stats = [];

// Toplam ürün sayısı
$stmt = $pdo->query("SELECT COUNT(*) as total FROM products WHERE is_active = 1");
$stats['products'] = $stmt->fetch()['total'];

// Toplam blog yazısı
$stmt = $pdo->query("SELECT COUNT(*) as total FROM blog_posts WHERE status = 'published'");
$stats['posts'] = $stmt->fetch()['total'];

// Onay bekleyen yorumlar
$stmt = $pdo->query("SELECT COUNT(*) as total FROM testimonials WHERE is_approved = 0");
$stats['pending_reviews'] = $stmt->fetch()['total'];

// Son eklenen ürünler
$stmt = $pdo->query("SELECT p.*, pc.name_tr as category_name FROM products p 
                     JOIN product_categories pc ON p.category_id = pc.id 
                     WHERE p.is_active = 1 
                     ORDER BY p.created_at DESC LIMIT 5");
$recent_products = $stmt->fetchAll();

// Son blog yazıları
$stmt = $pdo->query("SELECT * FROM blog_posts 
                     WHERE status = 'published' 
                     ORDER BY created_at DESC LIMIT 5");
$recent_posts = $stmt->fetchAll();

// Son yorumlar
$stmt = $pdo->query("SELECT * FROM testimonials 
                     ORDER BY created_at DESC LIMIT 5");
$recent_reviews = $stmt->fetchAll();

// Include unified header
include 'includes/header.php';
?>

<style>
        .welcome-section {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(85,107,47,0.1);
        }

        .welcome-title {
            font-family: 'Merriweather', serif;
            color: var(--dark-brown);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            color: var(--pistachio-green);
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(85,107,47,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: var(--pistachio-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-brown);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--pistachio-green);
            font-weight: 600;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-btn {
            background: var(--pistachio-green);
            color: var(--white);
            text-decoration: none;
            padding: 1rem;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .action-btn:hover {
            background: var(--light-green);
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }

        .content-section {
            background: var(--white);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(85,107,47,0.1);
        }

        .section-title {
            font-family: 'Merriweather', serif;
            color: var(--dark-brown);
            font-size: 1.3rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .item-list {
            list-style: none;
        }

        .item-list li {
            padding: 0.8rem 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-list li:last-child {
            border-bottom: none;
        }

        .item-title {
            font-weight: 600;
            color: var(--dark-brown);
        }

        .item-meta {
            font-size: 0.9rem;
            color: #666;
        }

        .view-all {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: var(--pistachio-green);
            text-decoration: none;
            font-weight: 600;
        }

        .view-all:hover {
            text-decoration: underline;
        }
    </style>

    <div class="welcome-section">
        <h1 class="welcome-title">Admin Paneli</h1>
        <p class="welcome-subtitle">Hünkar Baklava web sitesini yönetin</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-number"><?php echo $stats['products']; ?></div>
            <div class="stat-label">Aktif Ürün</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-number"><?php echo $stats['posts']; ?></div>
            <div class="stat-label">Blog Yazısı</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-comments"></i>
            </div>
            <div class="stat-number"><?php echo $stats['pending_reviews']; ?></div>
            <div class="stat-label">Onay Bekleyen Yorum</div>
        </div>
    </div>

    <div class="quick-actions">
        <a href="products.php" class="action-btn">
            <i class="fas fa-plus"></i> Yeni Ürün Ekle
        </a>
        <a href="blog.php" class="action-btn">
            <i class="fas fa-edit"></i> Yeni Blog Yazısı
        </a>
        <a href="testimonials.php" class="action-btn">
            <i class="fas fa-star"></i> Yorumları Yönet
        </a>
        <a href="about.php" class="action-btn">
            <i class="fas fa-info-circle"></i> Hakkımızda Düzenle
        </a>
    </div>

    <div class="content-grid">
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-box"></i> Son Eklenen Ürünler
            </h2>
            <ul class="item-list">
                <?php foreach ($recent_products as $product): ?>
                <li>
                    <div>
                        <div class="item-title"><?php echo htmlspecialchars($product['name_tr']); ?></div>
                        <div class="item-meta"><?php echo htmlspecialchars($product['category_name']); ?></div>
                    </div>
                    <a href="products.php?edit=<?php echo $product['id']; ?>" style="color: var(--pistachio-green);">
                        <i class="fas fa-edit"></i>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href="products.php" class="view-all">Tüm Ürünleri Görüntüle</a>
        </div>

        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-newspaper"></i> Son Blog Yazıları
            </h2>
            <ul class="item-list">
                <?php foreach ($recent_posts as $post): ?>
                <li>
                    <div>
                        <div class="item-title"><?php echo htmlspecialchars($post['title_tr']); ?></div>
                        <div class="item-meta"><?php echo format_date($post['created_at']); ?></div>
                    </div>
                    <a href="blog.php?edit=<?php echo $post['id']; ?>" style="color: var(--pistachio-green);">
                        <i class="fas fa-edit"></i>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href="blog.php" class="view-all">Tüm Yazıları Görüntüle</a>
        </div>

        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-comments"></i> Son Yorumlar
            </h2>
            <ul class="item-list">
                <?php foreach ($recent_reviews as $review): ?>
                <li>
                    <div>
                        <div class="item-title"><?php echo htmlspecialchars($review['customer_name']); ?></div>
                        <div class="item-meta">
                            <?php echo substr(htmlspecialchars($review['comment_tr']), 0, 50) . '...'; ?>
                        </div>
                    </div>
                    <div style="color: #FFD700;">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?php echo $i <= $review['rating'] ? '' : '-o'; ?>"></i>
                        <?php endfor; ?>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href="testimonials.php" class="view-all">Tüm Yorumları Görüntüle</a>
        </div>
    </div>

<?php include 'includes/footer.php'; ?> 