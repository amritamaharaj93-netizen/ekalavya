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
        }
        body {
            margin: 0;
            padding: 0;
            background: #1a1f2c;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .viewer-header {
            background: rgba(10, 31, 68, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: #fff;
            z-index: 100;
        }
        .back-btn {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            color: var(--primary-color);
            transform: translateX(-5px);
        }
        .doc-title {
            font-weight: 900;
            font-size: 1.1rem;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            flex-grow: 1;
            text-align: center;
        }
        .viewer-main {
            flex-grow: 1;
            background: #2d3436;
            position: relative;
        }
        .pdf-frame {
            width: 100%;
            height: 100%;
            border: none;
        }
        .download-pill {
            background: var(--primary-color);
            color: #fff;
            border-radius: 100px;
            padding: 8px 20px;
            font-weight: 800;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(247, 148, 29, 0.3);
        }
        .download-pill:hover {
            background: #e65100;
            color: #fff;
            transform: translateY(-2px);
        }
        .error-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body>

    <header class="viewer-header">
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i> EXIT VIEWER
        </a>
        <h1 class="doc-title"><?php echo htmlspecialchars($title); ?></h1>
        <div class="header-actions">
            <?php if ($file_exists): ?>
                <a href="<?php echo BASE_URL . $file_path; ?>" download class="download-pill">
                    <i class="fas fa-cloud-download-alt me-2"></i> DOWNLOAD PDF
                </a>
            <?php endif; ?>
        </div>
    </header>

    <main class="viewer-main">
        <?php if ($file_exists): ?>
            <iframe src="<?php echo BASE_URL . $file_path; ?>#toolbar=0" class="pdf-frame"></iframe>
        <?php else: ?>
            <div class="error-overlay">
                <i class="fas fa-file-circle-xmark mb-4" style="font-size: 5rem; color: #ff7675;"></i>
                <h2 class="fw-black">VAULT ITEM NOT FOUND</h2>
                <p class="opacity-50">The requested resource has been moved or restricted.</p>
                <a href="<?php echo BASE_URL; ?>study-material" class="btn btn-primary rounded-pill px-5 py-3 mt-4 fw-bold">BACK TO VAULT</a>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>
