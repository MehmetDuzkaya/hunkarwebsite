<?php
require_once 'config/database.php';
require_once 'auth.php';
require_admin_login();

// Define admin access constant
define('ADMIN_ACCESS', true);

// Set page title
$page_title = 'Ürün Yönetimi';

$message = '';
$error = '';

// Ürün ekleme/düzenleme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add' || $_POST['action'] == 'edit') {
            $name_tr = clean_input($_POST['name_tr']);
            $name_en = clean_input($_POST['name_en']);
            $description_tr = clean_input($_POST['description_tr']);
            $description_en = clean_input($_POST['description_en']);
            $category_id = (int)$_POST['category_id'];
            $price = (float)$_POST['price'];
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            $sort_order = (int)$_POST['sort_order'];
            
            // Resim yükleme
            $image_path = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_path = upload_file($_FILES['image'], 'products');
                if (!$image_path) {
                    $error = 'Resim yüklenirken hata oluştu.';
                }
            }
            
            if (empty($error)) {
                if ($_POST['action'] == 'add') {
                    $stmt = $pdo->prepare("INSERT INTO products (name_tr, name_en, description_tr, description_en, category_id, price, image_path, is_featured, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$name_tr, $name_en, $description_tr, $description_en, $category_id, $price, $image_path, $is_featured, $is_active, $sort_order]);
                    $message = 'Ürün başarıyla eklendi.';
                } else {
                    $id = (int)$_POST['id'];
                    $sql = "UPDATE products SET name_tr = ?, name_en = ?, description_tr = ?, description_en = ?, category_id = ?, price = ?, is_featured = ?, is_active = ?, sort_order = ?";
                    $params = [$name_tr, $name_en, $description_tr, $description_en, $category_id, $price, $is_featured, $is_active, $sort_order];
                    
                    if ($image_path) {
                        $sql .= ", image_path = ?";
                        $params[] = $image_path;
                    }
                    
                    $sql .= " WHERE id = ?";
                    $params[] = $id;
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($params);
                    $message = 'Ürün başarıyla güncellendi.';
                }
            }
        } elseif ($_POST['action'] == 'delete') {
            $id = (int)$_POST['id'];
            $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $message = 'Ürün başarıyla silindi.';
        }
    }
}

// Kategorileri al
$stmt = $pdo->query("SELECT * FROM product_categories WHERE is_active = 1 ORDER BY sort_order, name_tr");
$categories = $stmt->fetchAll();

// Ürünleri al
$stmt = $pdo->query("SELECT p.*, pc.name_tr as category_name FROM products p 
                     JOIN product_categories pc ON p.category_id = pc.id 
                     ORDER BY p.sort_order, p.name_tr");
$products = $stmt->fetchAll();

// Düzenlenecek ürün
$edit_product = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $edit_product = $stmt->fetch();
}

// Include unified header
include 'includes/header.php';
?>

<style>
        .product-form {
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

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: var(--white);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(85,107,47,0.1);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-brown);
            margin-bottom: 0.5rem;
        }

        .product-category {
            color: var(--pistachio-green);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-brown);
            margin-bottom: 0.5rem;
        }

        .product-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .status-active {
            background: rgba(40, 167, 69, 0.1);
            color: #155724;
        }

        .status-inactive {
            background: rgba(220, 53, 69, 0.1);
            color: #721c24;
        }

        .product-actions {
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
        <h1 class="page-title">Ürün Yönetimi</h1>
        <button onclick="toggleForm()" class="btn">
            <i class="fas fa-plus"></i> Yeni Ürün Ekle
        </button>
    </div>

    <div class="product-form" id="productForm" style="display: <?php echo $edit_product ? 'block' : 'none'; ?>;">
        <h2><?php echo $edit_product ? 'Ürün Düzenle' : 'Yeni Ürün Ekle'; ?></h2>
        
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo $edit_product ? 'edit' : 'add'; ?>">
            <?php if ($edit_product): ?>
                <input type="hidden" name="id" value="<?php echo $edit_product['id']; ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="name_tr">Ürün Adı (TR)</label>
                    <input type="text" id="name_tr" name="name_tr" class="form-control" 
                           value="<?php echo $edit_product ? htmlspecialchars($edit_product['name_tr']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="name_en">Ürün Adı (EN)</label>
                    <input type="text" id="name_en" name="name_en" class="form-control" 
                           value="<?php echo $edit_product ? htmlspecialchars($edit_product['name_en']) : ''; ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">Kategori Seçin</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" 
                                    <?php echo ($edit_product && $edit_product['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name_tr']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="price">Fiyat (TL)</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" 
                           value="<?php echo $edit_product ? $edit_product['price'] : ''; ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description_tr">Açıklama (TR)</label>
                <textarea id="description_tr" name="description_tr" class="form-control" rows="4" required><?php echo $edit_product ? htmlspecialchars($edit_product['description_tr']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="description_en">Açıklama (EN)</label>
                <textarea id="description_en" name="description_en" class="form-control" rows="4" required><?php echo $edit_product ? htmlspecialchars($edit_product['description_en']) : ''; ?></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="image">Ürün Resmi</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    <?php if ($edit_product && $edit_product['image_path']): ?>
                        <small>Mevcut resim: <?php echo htmlspecialchars($edit_product['image_path']); ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="sort_order">Sıralama</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control" 
                           value="<?php echo $edit_product ? $edit_product['sort_order'] : '0'; ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_featured" name="is_featured" 
                               <?php echo ($edit_product && $edit_product['is_featured']) ? 'checked' : ''; ?>>
                        <label for="is_featured">Öne Çıkan Ürün</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_active" name="is_active" 
                               <?php echo ($edit_product && $edit_product['is_active']) ? 'checked' : ''; ?>>
                        <label for="is_active">Aktif</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> <?php echo $edit_product ? 'Güncelle' : 'Ekle'; ?>
                </button>
                <?php if ($edit_product): ?>
                    <a href="products.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i> İptal
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <?php if ($product['image_path']): ?>
                    <img src="<?php echo UPLOAD_URL . $product['image_path']; ?>" alt="<?php echo htmlspecialchars($product['name_tr']); ?>" class="product-image">
                <?php else: ?>
                    <div class="product-image" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 3rem; color: #ccc;"></i>
                    </div>
                <?php endif; ?>
                
                <div class="product-title"><?php echo htmlspecialchars($product['name_tr']); ?></div>
                <div class="product-category"><?php echo htmlspecialchars($product['category_name']); ?></div>
                <div class="product-price"><?php echo number_format($product['price'], 2); ?> TL</div>
                
                <div class="product-status <?php echo $product['is_active'] ? 'status-active' : 'status-inactive'; ?>">
                    <?php echo $product['is_active'] ? 'Aktif' : 'Pasif'; ?>
                    <?php if ($product['is_featured']): ?>
                        | Öne Çıkan
                    <?php endif; ?>
                </div>
                
                <div class="product-actions">
                    <a href="?edit=<?php echo $product['id']; ?>" class="btn btn-secondary btn-small">
                        <i class="fas fa-edit"></i> Düzenle
                    </a>
                    <form method="POST" style="display: inline;" onsubmit="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
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
            const form = document.getElementById('productForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>

<?php include 'includes/footer.php'; ?> 