<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "eklavya_academy");

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Clear existing test series
    $pdo->exec("DELETE FROM test_series");
    echo "Cleared old test series data.\n";

    // 2. Add new series
    function slugify($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text);
    }

    $new_series = [
        [
            'title' => 'NEET Enthusiast Test Series (Class 11)',
            'category' => 'NEET Class 11th',
            'price' => '4,500',
            'description' => 'Designed for Class 11 students to build a strong foundation for NEET-UG. This series follows a systematic testing pattern covering the entire Class 11 syllabus with national-level benchmarking.',
            'features' => "Unit Tests & Part Tests\nFull Syllabus Coverage\nAll India Open Test Series (AIOTS)\nDetailed Performance Analytics\nVideo Solutions for Complex Questions",
            'link' => 'https://allen.in/neet/enthusiast-online-plus-dlp-test-series'
        ],
        [
            'title' => 'NEET Enthusiast Test Series (Class 12)',
            'category' => 'NEET Class 12th',
            'price' => '5,500',
            'description' => 'A comprehensive testing program for Class 12 students. Includes intensive Class 12 testing along with strategic revision tests of Class 11 concepts to ensure peak performance in NEET.',
            'features' => "Integrated Class 11 & 12 Syllabus\nMajor Tests & Mock Exams\nNational Rank Forecasting\nTopic-wise Heatmaps\nError-Mapping Matrix",
            'link' => 'https://allen.in/neet/enthusiast-dlp-test-series'
        ],
        [
            'title' => 'NEET Leader Test Series (Dropper)',
            'category' => 'NEET Dropper',
            'price' => '6,500',
            'description' => 'Specifically engineered for 12th pass students. This series offers an accelerated testing lifecycle with a high frequency of full-length mock exams to build exam temperament and speed.',
            'features' => "Daily Practice Assessments\nWeekly Minor Tests\nMonthly National Mocks\nAdvanced Error Analysis\nPersonalized Doubt Support",
            'link' => 'https://allen.in/neet/leader-dlp-test-series'
        ],
        [
            'title' => 'JEE Nurture Test Series (Class 11)',
            'category' => 'JEE Class 11th',
            'price' => '4,800',
            'description' => 'The ideal starting point for JEE Main & Advanced aspirants in Class 11. Focuses on building fundamental problem-solving skills through a structured roadmap of unit-based assessments.',
            'features' => "JEE Main & Advanced Pattern\nTopic-wise Practice Modules\nPerformance Benchmarking\nConceptual Clarity Drills\nNational Level Ranking",
            'link' => 'https://allen.in/jee-main/nurture-dlp-test-series'
        ],
        [
            'title' => 'JEE Enthusiast Test Series (Class 12)',
            'category' => 'JEE Class 12th',
            'price' => '5,800',
            'description' => 'Advanced assessment ecosystem for Class 12 students. Focuses on speed, accuracy, and examination strategy through a series of full-syllabus replica tests and national-level competition.',
            'features' => "Full Syllabus Replica Tests\nPrecision Analytics Report\nStrategic Time Management Drills\nNational Rank Forecasting\nDetailed Video Solutions",
            'link' => 'https://allen.in/jee-main/enthusiast-dlp-test-series'
        ]
    ];

    $stmt = $pdo->prepare("INSERT INTO test_series (title, slug, category, price, description, features, link) VALUES (?, ?, ?, ?, ?, ?, ?)");

    foreach ($new_series as $s) {
        $slug = slugify($s['title']);
        $stmt->execute([
            $s['title'],
            $slug,
            $s['category'],
            $s['price'],
            $s['description'],
            $s['features'],
            $s['link']
        ]);
        echo "Added: {$s['title']}\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
