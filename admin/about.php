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
        
        if ($action === 'update') {
            $section_name = clean_input($_POST['section_name']);
            $title_tr = clean_input($_POST['title_tr']);
            $title_en = clean_input($_POST['title_en']);
            $content_tr = clean_input($_POST['content_tr']);
            $content_en = clean_input($_POST['content_en']);
            $sort_order = (int)$_POST['sort_order'];
            
            // Resim yükleme
            $image_path = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_path = upload_file($_FILES['image'], 'about');
            }
            
            try {
                // Mevcut kayıt var mı kontrol et
                $stmt = $pdo->prepare("SELECT id FROM about_content WHERE section_name = ?");
                $stmt->execute([$section_name]);
                $existing = $stmt->fetch();
                
                if ($existing) {
                    // Güncelle
                    $image_sql = $image_path ? ', image_path = ?' : '';
                    $params = [$title_tr, $title_en, $content_tr, $content_en, $sort_order, $existing['id']];
                    if ($image_path) {
                        $params = array_merge(array_slice($params, 0, -1), [$image_path], array_slice($params, -1));
                    }
                    
                    $stmt = $pdo->prepare("UPDATE about_content SET title_tr = ?, title_en = ?, content_tr = ?, content_en = ?, sort_order = ?" . $image_sql . " WHERE id = ?");
                    $stmt->execute($params);
                } else {
                    // Yeni kayıt ekle
                    $stmt = $pdo->prepare("INSERT INTO about_content (section_name, title_tr, title_en, content_tr, content_en, image_path, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$section_name, $title_tr, $title_en, $content_tr, $content_en, $image_path, $sort_order]);
                }
                
                $message = 'İçerik başarıyla güncellendi!';
            } catch (PDOException $e) {
                $message = 'Hata: ' . $e->getMessage();
            }
        }
    }
}

// Mevcut içerikleri getir
$stmt = $pdo->query("SELECT * FROM about_content ORDER BY sort_order ASC");
$about_sections = $stmt->fetchAll();

// İçerikleri section_name'e göre düzenle
$sections = [];
foreach ($about_sections as $section) {
    $sections[$section['section_name']] = $section;
}

// Admin panel için gerekli değişkenler
define('ADMIN_ACCESS', true);
$page_title = 'Hakkımızda Düzenle';
?>

<?php include 'includes/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Hakkımızda Düzenle</h1>
</div>

<?php if ($message): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<div class="section-tabs">
    <button class="tab active" onclick="showTab('main')">Ana İçerik</button>
    <button class="tab" onclick="showTab('vision')">Vizyon</button>
    <button class="tab" onclick="showTab('mission')">Misyon</button>
    <button class="tab" onclick="showTab('history')">Tarihçe</button>
</div>

<div id="main" class="tab-content active">
    <div class="card">
        <h2>Ana İçerik</h2>
        <form method="POST" enctype="multipart/form-data" class="about-form">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="section_name" value="main">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title_tr_main">Başlık (Türkçe)</label>
                    <input type="text" id="title_tr_main" name="title_tr" class="form-control"
                           value="<?php echo isset($sections['main']) ? htmlspecialchars($sections['main']['title_tr']) : 'Hakkımızda'; ?>">
                </div>
                <div class="form-group">
                    <label for="title_en_main">Başlık (İngilizce)</label>
                    <input type="text" id="title_en_main" name="title_en" class="form-control"
                           value="<?php echo isset($sections['main']) ? htmlspecialchars($sections['main']['title_en']) : 'About Us'; ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order_main">Sıralama</label>
                    <input type="number" id="sort_order_main" name="sort_order" class="form-control"
                           value="<?php echo isset($sections['main']) ? $sections['main']['sort_order'] : '1'; ?>">
                </div>
                <div class="form-group">
                    <label for="image_main">Resim</label>
                    <input type="file" id="image_main" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            
            <div class="form-group">
                <label for="content_tr_main">İçerik (Türkçe)</label>
                <textarea id="content_tr_main" name="content_tr" class="form-control" rows="6"><?php echo isset($sections['main']) ? htmlspecialchars($sections['main']['content_tr']) : 'Hünkar Baklava, 30 yılı aşkın süredir geleneksel tariflerle ve en kaliteli malzemelerle baklava üretmektedir. Misyonumuz, Türk mutfağının bu eşsiz lezzetini tüm dünyaya en taze ve doğal haliyle sunmaktır.'; ?></textarea>
            </div>
            <div class="form-group">
                <label for="content_en_main">İçerik (İngilizce)</label>
                <textarea id="content_en_main" name="content_en" class="form-control" rows="6"><?php echo isset($sections['main']) ? htmlspecialchars($sections['main']['content_en']) : 'Hunkar Baklava has been producing baklava with traditional recipes and the highest quality ingredients for over 30 years. Our mission is to serve this unique taste of Turkish cuisine to the whole world in its freshest and most natural form.'; ?></textarea>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Güncelle
            </button>
        </form>
    </div>
</div>

<div id="vision" class="tab-content">
    <div class="card">
        <h2>Vizyon</h2>
        <form method="POST" enctype="multipart/form-data" class="about-form">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="section_name" value="vision">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title_tr_vision">Başlık (Türkçe)</label>
                    <input type="text" id="title_tr_vision" name="title_tr" class="form-control"
                           value="<?php echo isset($sections['vision']) ? htmlspecialchars($sections['vision']['title_tr']) : 'Vizyonumuz'; ?>">
                </div>
                <div class="form-group">
                    <label for="title_en_vision">Başlık (İngilizce)</label>
                    <input type="text" id="title_en_vision" name="title_en" class="form-control"
                           value="<?php echo isset($sections['vision']) ? htmlspecialchars($sections['vision']['title_en']) : 'Our Vision'; ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order_vision">Sıralama</label>
                    <input type="number" id="sort_order_vision" name="sort_order" class="form-control"
                           value="<?php echo isset($sections['vision']) ? $sections['vision']['sort_order'] : '2'; ?>">
                </div>
                <div class="form-group">
                    <label for="image_vision">Resim</label>
                    <input type="file" id="image_vision" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            
            <div class="form-group">
                <label for="content_tr_vision">İçerik (Türkçe)</label>
                <textarea id="content_tr_vision" name="content_tr" class="form-control" rows="6"><?php echo isset($sections['vision']) ? htmlspecialchars($sections['vision']['content_tr']) : 'Vizyonumuz, baklava denince akla gelen ilk marka olmak ve lezzet yolculuğumuzu nesilden nesile aktarmaktır.'; ?></textarea>
            </div>
            <div class="form-group">
                <label for="content_en_vision">İçerik (İngilizce)</label>
                <textarea id="content_en_vision" name="content_en" class="form-control" rows="6"><?php echo isset($sections['vision']) ? htmlspecialchars($sections['vision']['content_en']) : 'Our vision is to be the first brand that comes to mind when baklava is mentioned and to pass on our taste journey from generation to generation.'; ?></textarea>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Güncelle
            </button>
        </form>
    </div>
</div>

<div id="mission" class="tab-content">
    <div class="card">
        <h2>Misyon</h2>
        <form method="POST" enctype="multipart/form-data" class="about-form">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="section_name" value="mission">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title_tr_mission">Başlık (Türkçe)</label>
                    <input type="text" id="title_tr_mission" name="title_tr" class="form-control"
                           value="<?php echo isset($sections['mission']) ? htmlspecialchars($sections['mission']['title_tr']) : 'Misyonumuz'; ?>">
                </div>
                <div class="form-group">
                    <label for="title_en_mission">Başlık (İngilizce)</label>
                    <input type="text" id="title_en_mission" name="title_en" class="form-control"
                           value="<?php echo isset($sections['mission']) ? htmlspecialchars($sections['mission']['title_en']) : 'Our Mission'; ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order_mission">Sıralama</label>
                    <input type="number" id="sort_order_mission" name="sort_order" class="form-control"
                           value="<?php echo isset($sections['mission']) ? $sections['mission']['sort_order'] : '3'; ?>">
                </div>
                <div class="form-group">
                    <label for="image_mission">Resim</label>
                    <input type="file" id="image_mission" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            
            <div class="form-group">
                <label for="content_tr_mission">İçerik (Türkçe)</label>
                <textarea id="content_tr_mission" name="content_tr" class="form-control" rows="6"><?php echo isset($sections['mission']) ? htmlspecialchars($sections['mission']['content_tr']) : 'Misyonumuz, geleneksel Türk mutfağının en değerli lezzetlerinden biri olan baklavayı, en kaliteli malzemeler ve usta ellerle hazırlayarak müşterilerimize sunmaktır.'; ?></textarea>
            </div>
            <div class="form-group">
                <label for="content_en_mission">İçerik (İngilizce)</label>
                <textarea id="content_en_mission" name="content_en" class="form-control" rows="6"><?php echo isset($sections['mission']) ? htmlspecialchars($sections['mission']['content_en']) : 'Our mission is to serve baklava, one of the most valuable tastes of traditional Turkish cuisine, to our customers by preparing it with the highest quality ingredients and expert hands.'; ?></textarea>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Güncelle
            </button>
        </form>
    </div>
</div>

<div id="history" class="tab-content">
    <div class="card">
        <h2>Tarihçe</h2>
        <form method="POST" enctype="multipart/form-data" class="about-form">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="section_name" value="history">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title_tr_history">Başlık (Türkçe)</label>
                    <input type="text" id="title_tr_history" name="title_tr" class="form-control"
                           value="<?php echo isset($sections['history']) ? htmlspecialchars($sections['history']['title_tr']) : 'Tarihçemiz'; ?>">
                </div>
                <div class="form-group">
                    <label for="title_en_history">Başlık (İngilizce)</label>
                    <input type="text" id="title_en_history" name="title_en" class="form-control"
                           value="<?php echo isset($sections['history']) ? htmlspecialchars($sections['history']['title_en']) : 'Our History'; ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order_history">Sıralama</label>
                    <input type="number" id="sort_order_history" name="sort_order" class="form-control"
                           value="<?php echo isset($sections['history']) ? $sections['history']['sort_order'] : '4'; ?>">
                </div>
                <div class="form-group">
                    <label for="image_history">Resim</label>
                    <input type="file" id="image_history" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            
            <div class="form-group">
                <label for="content_tr_history">İçerik (Türkçe)</label>
                <textarea id="content_tr_history" name="content_tr" class="form-control" rows="6"><?php echo isset($sections['history']) ? htmlspecialchars($sections['history']['content_tr']) : '1990 yılında Gaziantep\'te küçük bir baklava dükkanı olarak başladığımız yolculuğumuz, bugün Türkiye\'nin önde gelen baklava üreticilerinden biri olarak devam etmektedir.'; ?></textarea>
            </div>
            <div class="form-group">
                <label for="content_en_history">İçerik (İngilizce)</label>
                <textarea id="content_en_history" name="content_en" class="form-control" rows="6"><?php echo isset($sections['history']) ? htmlspecialchars($sections['history']['content_en']) : 'Our journey, which started as a small baklava shop in Gaziantep in 1990, continues today as one of Turkey\'s leading baklava producers.'; ?></textarea>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Güncelle
            </button>
        </form>
    </div>
</div>

<style>
.section-tabs {
    display: flex;
    margin-bottom: 2rem;
    border-bottom: 2px solid #e0e0e0;
    background: white;
    border-radius: 12px 12px 0 0;
    overflow: hidden;
}

.tab {
    padding: 1rem 1.5rem;
    cursor: pointer;
    border: none;
    background: none;
    font-size: 1rem;
    font-weight: 500;
    color: #666;
    transition: all 0.3s ease;
    flex: 1;
    text-align: center;
}

.tab:hover {
    background: rgba(85, 107, 47, 0.1);
    color: var(--pistachio-green);
}

.tab.active {
    background: var(--pistachio-green);
    color: white;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.about-form {
    max-width: 800px;
}

.about-form .form-group {
    margin-bottom: 1.5rem;
}

.about-form textarea {
    resize: vertical;
    min-height: 120px;
}

@media (max-width: 768px) {
    .section-tabs {
        flex-direction: column;
    }
    
    .tab {
        border-radius: 0;
    }
    
    .about-form .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function showTab(tabName) {
    // Tüm tab içeriklerini gizle
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => content.classList.remove('active'));
    
    // Tüm tab butonlarını pasif yap
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => tab.classList.remove('active'));
    
    // Seçilen tabı aktif yap
    document.getElementById(tabName).classList.add('active');
    event.target.classList.add('active');
}
</script>

<?php include 'includes/footer.php'; ?> 