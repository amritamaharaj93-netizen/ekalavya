<?php 
include_once 'config/database.php'; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$file = isset($_GET['file']) ? $_GET['file'] : '';
$title = isset($_GET['title']) ? $_GET['title'] : 'Academic Module';

// Security check: Ensure file is in the uploads/materials directory
$file_path = 'uploads/materials/' . basename($file);
$full_path = __DIR__ . '/' . $file_path;

$file_exists = !empty($file) && file_exists($full_path);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> | Ekalavya Vault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #f7941d;
            --dark-blue: #0a1f44;
            --premium-bg: #0f172a;
        }
        body {
            margin: 0;
            padding: 0;
            background: var(--premium-bg);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
        }
        .viewer-header {
            background: rgba(10, 31, 68, 0.8);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 12px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: #fff;
            z-index: 1000;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }
        .back-btn {
            color: #fff;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.75rem;
            letter-spacing: 1.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: rgba(255,255,255,0.05);
            padding: 8px 18px;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .back-btn:hover {
            background: var(--primary-color);
            color: #fff;
            transform: translateX(-5px);
            border-color: var(--primary-color);
        }
        .doc-title-wrap {
            flex-grow: 1;
            text-align: center;
            padding: 0 20px;
        }
        .doc-title {
            font-weight: 900;
            font-size: 0.95rem;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 500px;
            margin: 0 auto;
        }
        .doc-subtitle {
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary-color);
            font-weight: 700;
            margin-top: 2px;
        }
        .viewer-main {
            flex-grow: 1;
            background: #1e293b;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pdf-frame {
            width: 100%;
            height: 100%;
            border: none;
            background: #fff;
        }
        .header-actions {
            display: flex;
            gap: 12px;
        }
        .action-pill {
            background: rgba(255,255,255,0.05);
            color: #fff;
            border-radius: 100px;
            padding: 8px 18px;
            font-weight: 700;
            font-size: 0.7rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.5px;
        }
        .action-pill:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
            transform: translateY(-2px);
        }
        .download-pill {
            background: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(247, 148, 29, 0.3);
        }
        .download-pill:hover {
            background: #e68512;
            border-color: #e68512;
            box-shadow: 0 6px 20px rgba(247, 148, 29, 0.4);
        }
        .error-overlay {
            text-align: center;
            color: #fff;
            max-width: 400px;
            padding: 40px;
            background: rgba(255,255,255,0.03);
            border-radius: 30px;
            border: 1px solid rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
        }
        .error-icon {
            font-size: 4rem;
            background: linear-gradient(45deg, #ff7675, #d63031);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .doc-title-wrap { display: none; }
            .viewer-header { padding: 10px 15px; }
            .back-btn span { display: none; }
            .back-btn { padding: 8px 12px; }
        }
    </style>
</head>
<body>

    <header class="viewer-header">
        <a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : BASE_URL . 'study-material'; ?>" class="back-btn">
            <i class="fas fa-arrow-left"></i> <span>CLOSE VIEWER</span>
        </a>
        
        <div class="doc-title-wrap">
            <h1 class="doc-title"><?php echo htmlspecialchars($title); ?></h1>
            <div class="doc-subtitle">Ekalavya Institutional Repository</div>
        </div>

        <div class="header-actions">
            <?php if ($file_exists): ?>
                <a href="<?php echo BASE_URL . $file_path; ?>" download class="action-pill download-pill">
                    <i class="fas fa-cloud-download-alt"></i> <span>DOWNLOAD</span>
                </a>
            <?php endif; ?>
            <a href="https://wa.me/919934244522" target="_blank" class="action-pill">
                <i class="fab fa-whatsapp"></i> <span>HELP</span>
            </a>
        </div>
    </header>

    <main class="viewer-main">
        <?php if ($file_exists): ?>
            <iframe src="<?php echo BASE_URL . $file_path; ?>#toolbar=0&navpanes=0&scrollbar=0" class="pdf-frame"></iframe>
        <?php else: ?>
            <div class="error-overlay">
                <i class="fas fa-file-circle-xmark error-icon"></i>
                <h2 class="fw-black mb-3">VAULT ITEM NOT FOUND</h2>
                <p class="opacity-50 small mb-4">The requested module has been moved or is currently undergoing academic revision.</p>
                <a href="<?php echo BASE_URL; ?>study-material" class="btn btn-warning rounded-pill px-4 py-2 fw-bold small">RETURN TO VAULT</a>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>
