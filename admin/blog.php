<?php
require_once 'config/database.php';
require_once 'auth.php';
require_admin_login();

// Define admin access constant
define('ADMIN_ACCESS', true);

// Set page title
$page_title = 'Blog Yönetimi';

$message = '';
$error = '';

// Blog yazısı ekleme/düzenleme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add' || $_POST['action'] == 'edit') {
            $title_tr = clean_input($_POST['title_tr']);
            $title_en = clean_input($_POST['title_en']);
            $content_tr = clean_input($_POST['content_tr']);
            $content_en = clean_input($_POST['content_en']);
            $excerpt_tr = clean_input($_POST['excerpt_tr']);
            $excerpt_en = clean_input($_POST['excerpt_en']);
            $category_id = (int)$_POST['category_id'];
            $status = $_POST['status'];
            
            // Resim yükleme
            $image_path = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_path = upload_file($_FILES['image'], 'blog');
                if (!$image_path) {
                    $error = 'Resim yüklenirken hata oluştu.';
                }
            }
            
            if (empty($error)) {
                if ($_POST['action'] == 'add') {
                    $stmt = $pdo->prepare("INSERT INTO blog_posts (title_tr, title_en, content_tr, content_en, excerpt_tr, excerpt_en, category_id, image_path, status, slug_tr, slug_en) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $slug_tr = create_slug($title_tr);
                    $slug_en = create_slug($title_en);
                    $stmt->execute([$title_tr, $title_en, $content_tr, $content_en, $excerpt_tr, $excerpt_en, $category_id, $image_path, $status, $slug_tr, $slug_en]);
                    $message = 'Blog yazısı başarıyla eklendi.';
                } else {
                    $id = (int)$_POST['id'];
                    $sql = "UPDATE blog_posts SET title_tr = ?, title_en = ?, content_tr = ?, content_en = ?, excerpt_tr = ?, excerpt_en = ?, category_id = ?, status = ?, slug_tr = ?, slug_en = ?";
                    $params = [$title_tr, $title_en, $content_tr, $content_en, $excerpt_tr, $excerpt_en, $category_id, $status, create_slug($title_tr), create_slug($title_en)];
                    
                    if ($image_path) {
                        $sql .= ", image_path = ?";
                        $params[] = $image_path;
                    }
                    
                    $sql .= " WHERE id = ?";
                    $params[] = $id;
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($params);
                    $message = 'Blog yazısı başarıyla güncellendi.';
                }
            }
        } elseif ($_POST['action'] == 'delete') {
            $id = (int)$_POST['id'];
            $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
            $stmt->execute([$id]);
            $message = 'Blog yazısı başarıyla silindi.';
        }
    }
}

// Düzenlenecek blog yazısı
$edit_post = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->execute([$id]);
    $edit_post = $stmt->fetch();
}

// Blog kategorilerini getir
$stmt = $pdo->query("SELECT * FROM blog_categories WHERE is_active = 1 ORDER BY name_tr");
$categories = $stmt->fetchAll();

// Blog yazılarını getir
$stmt = $pdo->query("SELECT bp.*, bc.name_tr as category_name FROM blog_posts bp LEFT JOIN blog_categories bc ON bp.category_id = bc.id ORDER BY bp.created_at DESC");
$posts = $stmt->fetchAll();

// Include unified header
include 'includes/header.php';
?>

<style>
        .blog-form {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(85,107,47,0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark-brown);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid rgba(85,107,47,0.2);
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--pistachio-green);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .post-card {
            background: var(--white);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(85,107,47,0.1);
            transition: transform 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        .post-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .post-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-brown);
            margin-bottom: 0.5rem;
        }

        .post-category {
            color: var(--pistachio-green);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .post-excerpt {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .post-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .status-published {
            background: rgba(40, 167, 69, 0.1);
            color: #155724;
        }

        .status-draft {
            background: rgba(255, 193, 7, 0.1);
            color: #856404;
        }

        .post-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-small {
            padding: 0.4rem 0.8rem;
            font-size: 12px;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #155724;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.1);
            color: #721c24;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }
    </style>

    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="page-header">
        <h1 class="page-title">Blog Yönetimi</h1>
        <button onclick="toggleForm()" class="btn">
            <i class="fas fa-plus"></i> Yeni Blog Yazısı
        </button>
    </div>

    <div class="blog-form" id="blogForm" style="display: <?php echo $edit_post ? 'block' : 'none'; ?>;">
        <h2><?php echo $edit_post ? 'Blog Yazısını Düzenle' : 'Yeni Blog Yazısı Ekle'; ?></h2>
        
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo $edit_post ? 'edit' : 'add'; ?>">
            <?php if ($edit_post): ?>
                <input type="hidden" name="id" value="<?php echo $edit_post['id']; ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title_tr">Başlık (TR)</label>
                    <input type="text" id="title_tr" name="title_tr" class="form-control" 
                           value="<?php echo $edit_post ? htmlspecialchars($edit_post['title_tr']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="title_en">Başlık (EN)</label>
                    <input type="text" id="title_en" name="title_en" class="form-control" 
                           value="<?php echo $edit_post ? htmlspecialchars($edit_post['title_en']) : ''; ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">Kategori Seçin</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" 
                                    <?php echo ($edit_post && $edit_post['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name_tr']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="status">Durum</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="draft" <?php echo ($edit_post && $edit_post['status'] == 'draft') ? 'selected' : ''; ?>>Taslak</option>
                        <option value="published" <?php echo ($edit_post && $edit_post['status'] == 'published') ? 'selected' : ''; ?>>Yayınla</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="excerpt_tr">Özet (TR)</label>
                <textarea id="excerpt_tr" name="excerpt_tr" class="form-control" rows="3" required><?php echo $edit_post ? htmlspecialchars($edit_post['excerpt_tr']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="excerpt_en">Özet (EN)</label>
                <textarea id="excerpt_en" name="excerpt_en" class="form-control" rows="3" required><?php echo $edit_post ? htmlspecialchars($edit_post['excerpt_en']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="content_tr">İçerik (TR)</label>
                <textarea id="content_tr" name="content_tr" class="form-control" rows="8" required><?php echo $edit_post ? htmlspecialchars($edit_post['content_tr']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="content_en">İçerik (EN)</label>
                <textarea id="content_en" name="content_en" class="form-control" rows="8" required><?php echo $edit_post ? htmlspecialchars($edit_post['content_en']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Blog Resmi</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                <?php if ($edit_post && $edit_post['image_path']): ?>
                    <small>Mevcut resim: <?php echo htmlspecialchars($edit_post['image_path']); ?></small>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> <?php echo $edit_post ? 'Güncelle' : 'Ekle'; ?>
                </button>
                <?php if ($edit_post): ?>
                    <a href="blog.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i> İptal
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="posts-grid">
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <?php if ($post['image_path']): ?>
                    <img src="<?php echo UPLOAD_URL . $post['image_path']; ?>" alt="<?php echo htmlspecialchars($post['title_tr']); ?>" class="post-image">
                <?php else: ?>
                    <div class="post-image" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 3rem; color: #ccc;"></i>
                    </div>
                <?php endif; ?>
                
                <div class="post-title"><?php echo htmlspecialchars($post['title_tr']); ?></div>
                <div class="post-category"><?php echo htmlspecialchars($post['category_name'] ?? 'Kategorisiz'); ?></div>
                <div class="post-excerpt"><?php echo htmlspecialchars(substr($post['excerpt_tr'], 0, 100)) . '...'; ?></div>
                
                <div class="post-status <?php echo $post['status'] == 'published' ? 'status-published' : 'status-draft'; ?>">
                    <?php echo $post['status'] == 'published' ? 'Yayında' : 'Taslak'; ?>
                </div>
                
                <div class="post-actions">
                    <a href="?edit=<?php echo $post['id']; ?>" class="btn btn-secondary btn-small">
                        <i class="fas fa-edit"></i> Düzenle
                    </a>
                    <form method="POST" style="display: inline;" onsubmit="return confirm('Bu blog yazısını silmek istediğinizden emin misiniz?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-small">
                            <i class="fas fa-trash"></i> Sil
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function toggleForm() {
            const form = document.getElementById('blogForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>

<?php include 'includes/footer.php'; ?> 