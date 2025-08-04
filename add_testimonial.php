<?php
require_once 'admin/config/database.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = clean_input($_POST['customer_name']);
    $customer_email = clean_input($_POST['customer_email']);
    $customer_phone = clean_input($_POST['customer_phone']);
    $comment_tr = clean_input($_POST['comment_tr']);
    $comment_en = clean_input($_POST['comment_en']);
    $rating = (int)$_POST['rating'];
    
    // Basit doğrulama
    if (empty($customer_name) || empty($comment_tr) || $rating < 1 || $rating > 5) {
        $error = 'Lütfen tüm alanları doldurun ve puan verin.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO testimonials (customer_name, customer_email, customer_phone, comment_tr, comment_en, rating, is_approved) VALUES (?, ?, ?, ?, ?, ?, 0)");
            $stmt->execute([$customer_name, $customer_email, $customer_phone, $comment_tr, $comment_en, $rating]);
            $message = 'Yorumunuz başarıyla gönderildi! Onaylandıktan sonra yayınlanacaktır.';
            
            // Formu temizle
            $customer_name = $customer_email = $customer_phone = $comment_tr = $comment_en = '';
            $rating = 5;
        } catch (PDOException $e) {
            $error = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yorum Ekle - Hünkar Baklava</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .testimonial-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: var(--dark-brown);
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
        }
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        .rating-stars {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .rating-stars input[type="radio"] {
            display: none;
        }
        .rating-stars label {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
        }
        .rating-stars input[type="radio"]:checked ~ label {
            color: #FFD700;
        }
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #FFD700;
        }
        .btn-submit {
            background: var(--pistachio-green);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        .btn-submit:hover {
            background: var(--light-green);
        }
        .message {
            padding: 15px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
        }
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: var(--pistachio-green);
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="testimonial-form">
        <h1 style="text-align: center; color: var(--pistachio-green); margin-bottom: 30px;">
            <i class="fas fa-star"></i> Yorum Ekle
        </h1>
        
        <?php if ($message): ?>
            <div class="message success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="customer_name">Adınız Soyadınız *</label>
                <input type="text" id="customer_name" name="customer_name" required 
                       value="<?php echo isset($customer_name) ? htmlspecialchars($customer_name) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="customer_email">E-posta Adresiniz</label>
                <input type="email" id="customer_email" name="customer_email" 
                       value="<?php echo isset($customer_email) ? htmlspecialchars($customer_email) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="customer_phone">Telefon Numaranız</label>
                <input type="tel" id="customer_phone" name="customer_phone" 
                       value="<?php echo isset($customer_phone) ? htmlspecialchars($customer_phone) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Puanınız *</label>
                <div class="rating-stars">
                    <input type="radio" name="rating" value="5" id="star5" <?php echo (!isset($rating) || $rating == 5) ? 'checked' : ''; ?>>
                    <label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" name="rating" value="4" id="star4" <?php echo (isset($rating) && $rating == 4) ? 'checked' : ''; ?>>
                    <label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" name="rating" value="3" id="star3" <?php echo (isset($rating) && $rating == 3) ? 'checked' : ''; ?>>
                    <label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" name="rating" value="2" id="star2" <?php echo (isset($rating) && $rating == 2) ? 'checked' : ''; ?>>
                    <label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" name="rating" value="1" id="star1" <?php echo (isset($rating) && $rating == 1) ? 'checked' : ''; ?>>
                    <label for="star1"><i class="fas fa-star"></i></label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="comment_tr">Yorumunuz (Türkçe) *</label>
                <textarea id="comment_tr" name="comment_tr" required placeholder="Deneyiminizi paylaşın..."><?php echo isset($comment_tr) ? htmlspecialchars($comment_tr) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="comment_en">Yorumunuz (İngilizce)</label>
                <textarea id="comment_en" name="comment_en" placeholder="Share your experience..."><?php echo isset($comment_en) ? htmlspecialchars($comment_en) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Yorumu Gönder
            </button>
        </form>
        
        <div class="back-link">
            <a href="index.html"><i class="fas fa-arrow-left"></i> Ana Sayfaya Dön</a>
        </div>
    </div>
</body>
</html> 