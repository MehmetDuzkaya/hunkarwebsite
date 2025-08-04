<?php
// Ensure this file is included, not accessed directly
if (!defined('ADMIN_ACCESS')) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Admin Panel - Hünkar Baklava</title>
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
            background: var(--wheat);
            color: var(--dark-brown);
        }

        .admin-header {
            background: var(--white);
            padding: 1rem 2rem;
            box-shadow: var(--shadow-soft);
            border-bottom: 3px solid var(--pistachio-green);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--pistachio-green);
            text-decoration: none;
        }

        .logo span {
            color: var(--dark-brown);
        }

        .nav-section {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
        }

        .nav-link {
            color: var(--dark-brown);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background: var(--pistachio-green);
            color: var(--white);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark-brown);
        }

        .logout-btn {
            background: var(--pistachio-green);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: var(--light-green);
        }

        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: var(--dark-brown);
            font-size: 2rem;
        }

        .btn {
            background: var(--pistachio-green);
            color: var(--white);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn:hover {
            background: var(--light-green);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--pistachio-green);
            border: 2px solid var(--pistachio-green);
        }

        .btn-secondary:hover {
            background: var(--pistachio-green);
            color: var(--white);
        }

        .btn-danger {
            background: #dc3545;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .card {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(85,107,47,0.1);
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

        .grid {
            display: grid;
            gap: 2rem;
        }

        .grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-4 {
            grid-template-columns: repeat(4, 1fr);
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

        /* Responsive Design for Admin Panel */
        @media (max-width: 1024px) {
            .admin-container {
                padding: 1.5rem;
            }
            
            .grid-4 {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 1rem;
            }
            
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-section {
                flex-direction: column;
                gap: 1rem;
                width: 100%;
            }
            
            .nav-links {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .user-info {
                justify-content: center;
            }
            
            .admin-container {
                padding: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .grid-3, .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .card {
                padding: 1.5rem;
            }
            
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .admin-header {
                padding: 0.8rem;
            }
            
            .logo {
                font-size: 1.2rem;
            }
            
            .nav-links {
                flex-direction: column;
                width: 100%;
            }
            
            .nav-link {
                text-align: center;
                padding: 0.8rem;
            }
            
            .admin-container {
                padding: 0.8rem;
            }
            
            .page-title {
                font-size: 1.3rem;
            }
            
            .grid-3, .grid-4 {
                grid-template-columns: 1fr;
            }
            
            .card {
                padding: 1rem;
            }
            
            .btn {
                padding: 0.6rem 1rem;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="header-content">
            <a href="index.php" class="logo">
                Hünkar <span>Baklava</span>
            </a>
            
            <div class="nav-section">
                <nav class="nav-links">
                    <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="products.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : ''; ?>">
                        <i class="fas fa-box"></i> Ürünler
                    </a>
                    <a href="blog.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">
                        <i class="fas fa-blog"></i> Blog
                    </a>
                    <a href="testimonials.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'testimonials.php' ? 'active' : ''; ?>">
                        <i class="fas fa-comments"></i> Yorumlar
                    </a>
                    <a href="about.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">
                        <i class="fas fa-info-circle"></i> Hakkımızda
                    </a>
                </nav>
                
                <div class="user-info">
                    <span class="user-name">Admin</span>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Çıkış
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <main class="admin-container"> 