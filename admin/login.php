<?php
require_once 'config/database.php';
require_once 'auth.php';

// Zaten giriş yapmışsa dashboard'a yönlendir
redirect_if_logged_in();

// Session timeout mesajı
$timeout_message = '';
if (isset($_GET['timeout'])) {
    $timeout_message = 'Oturum süreniz doldu. Lütfen tekrar giriş yapın.';
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = clean_input($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = 'Kullanıcı adı ve şifre gereklidir.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ? AND is_active = 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Login başarılı
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_role'] = $user['role'];
            $_SESSION['admin_name'] = $user['full_name'];
            $_SESSION['last_activity'] = time();
            
            // Son giriş tarihini güncelle
            $stmt = $pdo->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
            $stmt->execute([$user['id']]);
            
            header('Location: index.php');
            exit();
        } else {
            $error = 'Geçersiz kullanıcı adı veya şifre.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi - Hünkar Baklava</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Merriweather:wght@700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pistachio-green: #556B2F;
            --light-green: #6B8E23;
            --dark-brown: #5A3E2B;
            --white: #FFFFFF;
            --wheat: #F8F9FA;
            --shadow-soft: 0 4px 24px rgba(85,107,47,0.15);
            --shadow-hover: 0 8px 32px rgba(85,107,47,0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: linear-gradient(135deg, var(--wheat) 0%, var(--light-green) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow-hover);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--pistachio-green);
            margin-bottom: 30px;
        }

        .logo span {
            color: var(--dark-brown);
        }

        h1 {
            font-family: 'Merriweather', serif;
            color: var(--dark-brown);
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark-brown);
            font-weight: 600;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pistachio-green);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: var(--white);
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--pistachio-green);
            box-shadow: 0 0 0 3px rgba(85,107,47,0.1);
        }

        .btn-login {
            width: 100%;
            background: var(--pistachio-green);
            color: var(--white);
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: var(--light-green);
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #fcc;
        }

        .back-link {
            margin-top: 20px;
            display: block;
            color: var(--pistachio-green);
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .demo-info {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }

        .demo-info strong {
            color: var(--dark-brown);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            Hünkar<span>Baklava</span>
        </div>
        
        <h1>Admin Girişi</h1>
        
        <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Kullanıcı Adı</label>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" required 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Şifre</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" required>
                </div>
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Giriş Yap
            </button>
        </form>
        
        <a href="../index.html" class="back-link">
            <i class="fas fa-arrow-left"></i> Ana Sayfaya Dön
        </a>
        
    </div>
</body>
</html> 