<?php
require_once 'config/database.php';
require_once 'auth.php';
require_admin_login();

$message = '';

// Form işlemleri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $message = 'Güvenlik hatası!';
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'approve') {
            $id = (int)$_POST['id'];
            try {
                $stmt = $pdo->prepare("UPDATE testimonials SET is_approved = 1 WHERE id = ?");
                $stmt->execute([$id]);
                $message = 'Yorum onaylandı!';
            } catch (PDOException $e) {
                $message = 'Hata: ' . $e->getMessage();
            }
        } elseif ($action === 'delete') {
            $id = (int)$_POST['id'];
            try {
                $stmt = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
                $stmt->execute([$id]);
                $message = 'Yorum silindi!';
            } catch (PDOException $e) {
                $message = 'Hata: ' . $e->getMessage();
            }
        } elseif ($action === 'feature') {
            $id = (int)$_POST['id'];
            $featured = (int)$_POST['featured'];
            try {
                $stmt = $pdo->prepare("UPDATE testimonials SET is_featured = ? WHERE id = ?");
                $stmt->execute([$featured, $id]);
                $message = $featured ? 'Yorum öne çıkarıldı!' : 'Yorum öne çıkarma kaldırıldı!';
            } catch (PDOException $e) {
                $message = 'Hata: ' . $e->getMessage();
            }
        } elseif ($action === 'add') {
            $customer_name = clean_input($_POST['customer_name']);
            $customer_email = clean_input($_POST['customer_email']);
            $customer_phone = clean_input($_POST['customer_phone']);
            $comment_tr = clean_input($_POST['comment_tr']);
            $comment_en = clean_input($_POST['comment_en']);
            $rating = (int)$_POST['rating'];
            $is_approved = isset($_POST['is_approved']) ? 1 : 0;
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            
            if (empty($customer_name) || empty($comment_tr) || $rating < 1 || $rating > 5) {
                $message = 'Lütfen gerekli alanları doldurun!';
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO testimonials (customer_name, customer_email, customer_phone, comment_tr, comment_en, rating, is_approved, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$customer_name, $customer_email, $customer_phone, $comment_tr, $comment_en, $rating, $is_approved, $is_featured]);
                    $message = 'Yorum başarıyla eklendi!';
                } catch (PDOException $e) {
                    $message = 'Hata: ' . $e->getMessage();
                }
            }
        }
    }
}

// Yorumları getir
$stmt = $pdo->query("SELECT * FROM testimonials ORDER BY created_at DESC");
$testimonials = $stmt->fetchAll();

// Admin panel için gerekli değişkenler
define('ADMIN_ACCESS', true);
$page_title = 'Yorum Yönetimi';
?>

<?php include 'includes/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Yorum Yönetimi</h1>
</div>

<?php if ($message): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<!-- Yorum Ekleme Formu -->
<div class="card">
    <h2><i class="fas fa-plus"></i> Yeni Yorum Ekle</h2>
    <form method="POST" class="testimonial-form">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        
        <div class="form-row">
            <div class="form-group">
                <label for="customer_name">Müşteri Adı *</label>
                <input type="text" id="customer_name" name="customer_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="customer_email">E-posta</label>
                <input type="email" id="customer_email" name="customer_email" class="form-control">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="customer_phone">Telefon</label>
                <input type="tel" id="customer_phone" name="customer_phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="rating">Puan *</label>
                <select id="rating" name="rating" class="form-control" required>
                    <option value="5">5 Yıldız</option>
                    <option value="4">4 Yıldız</option>
                    <option value="3">3 Yıldız</option>
                    <option value="2">2 Yıldız</option>
                    <option value="1">1 Yıldız</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="comment_tr">Yorum (Türkçe) *</label>
            <textarea id="comment_tr" name="comment_tr" class="form-control" required rows="4"></textarea>
        </div>
        
        <div class="form-group">
            <label for="comment_en">Yorum (İngilizce)</label>
            <textarea id="comment_en" name="comment_en" class="form-control" rows="4"></textarea>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_approved" value="1" checked> Onaylı
            </label>
            <label style="margin-left: 20px;">
                <input type="checkbox" name="is_featured" value="1"> Öne Çıkan
            </label>
        </div>
        
        <button type="submit" class="btn">
            <i class="fas fa-save"></i> Yorum Ekle
        </button>
    </form>
</div>

<?php
// İstatistikler
$total_reviews = count($testimonials);
$approved_reviews = count(array_filter($testimonials, function($t) { return $t['is_approved']; }));
$pending_reviews = $total_reviews - $approved_reviews;
$featured_reviews = count(array_filter($testimonials, function($t) { return $t['is_featured']; }));
?>

<div class="grid grid-4">
    <div class="card">
        <div class="stat-number"><?php echo $total_reviews; ?></div>
        <div class="stat-label">Toplam Yorum</div>
    </div>
    <div class="card">
        <div class="stat-number"><?php echo $approved_reviews; ?></div>
        <div class="stat-label">Onaylanmış</div>
    </div>
    <div class="card">
        <div class="stat-number"><?php echo $pending_reviews; ?></div>
        <div class="stat-label">Onay Bekleyen</div>
    </div>
    <div class="card">
        <div class="stat-number"><?php echo $featured_reviews; ?></div>
        <div class="stat-label">Öne Çıkan</div>
    </div>
</div>

<div class="card">
    <h2>Tüm Müşteri Yorumları</h2>
    <?php if (empty($testimonials)): ?>
        <p>Henüz yorum bulunmuyor.</p>
    <?php else: ?>
        <div class="testimonials-grid">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div>
                            <div class="customer-name"><?php echo htmlspecialchars($testimonial['customer_name']); ?></div>
                            <div class="testimonial-meta">
                                <?php echo format_date($testimonial['created_at']); ?> | 
                                <?php echo htmlspecialchars($testimonial['customer_email']); ?>
                            </div>
                        </div>
                        <div>
                            <?php if ($testimonial['is_approved']): ?>
                                <span class="status-badge status-approved">Onaylı</span>
                            <?php else: ?>
                                <span class="status-badge status-pending">Onay Bekliyor</span>
                            <?php endif; ?>
                            <?php if ($testimonial['is_featured']): ?>
                                <span class="status-badge status-featured">Öne Çıkan</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?php echo $i <= $testimonial['rating'] ? '' : '-o'; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    
                    <div class="testimonial-content">
                        <strong>Türkçe:</strong><br>
                        <?php echo htmlspecialchars($testimonial['comment_tr']); ?>
                    </div>
                    
                    <?php if (!empty($testimonial['comment_en'])): ?>
                    <div class="testimonial-content">
                        <strong>İngilizce:</strong><br>
                        <?php echo htmlspecialchars($testimonial['comment_en']); ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="testimonial-actions">
                        <?php if (!$testimonial['is_approved']): ?>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="approve">
                                <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
                                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                                <button type="submit" class="btn btn-success">Onayla</button>
                            </form>
                        <?php endif; ?>
                        
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="feature">
                            <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
                            <input type="hidden" name="featured" value="<?php echo $testimonial['is_featured'] ? '0' : '1'; ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                            <button type="submit" class="btn <?php echo $testimonial['is_featured'] ? 'btn-warning' : 'btn'; ?>">
                                <?php echo $testimonial['is_featured'] ? 'Öne Çıkarmayı Kaldır' : 'Öne Çıkar'; ?>
                            </button>
                        </form>
                        
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bu yorumu silmek istediğinizden emin misiniz?')">Sil</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.testimonial-form {
    max-width: 800px;
}

.testimonials-grid {
    display: grid;
    gap: 1.5rem;
    margin-top: 1rem;
}

.testimonial-card {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.testimonial-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.customer-name {
    font-size: 1.1rem;
    font-weight: bold;
    color: var(--pistachio-green);
    margin-bottom: 0.25rem;
}

.testimonial-meta {
    color: #666;
    font-size: 0.9rem;
}

.rating {
    color: #FFD700;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.testimonial-content {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.testimonial-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.status-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: bold;
    margin-left: 0.5rem;
}

.status-approved {
    background: #4CAF50;
    color: white;
}

.status-pending {
    background: #ff9800;
    color: white;
}

.status-featured {
    background: #9C27B0;
    color: white;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: var(--pistachio-green);
    text-align: center;
}

.stat-label {
    color: #666;
    text-align: center;
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .testimonial-header {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .testimonial-actions {
        flex-direction: column;
    }
    
    .testimonial-actions .btn {
        width: 100%;
        text-align: center;
    }
}
</style>

<?php include 'includes/footer.php'; ?> 