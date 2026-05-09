<?php
require_once 'config/database.php';

$items = [
    [
        'title' => 'NCERT Complete Solutions & Roadmap',
        'slug' => 'ncert-complete-solutions-roadmap',
        'type' => 'Notes',
        'category' => 'Chemistry',
        'file_path' => 'institutional_ncert_roadmap.pdf'
    ],
    [
        'title' => 'HC Verma Concepts & Solutions',
        'slug' => 'hc-verma-concepts-solutions',
        'type' => 'PDF',
        'category' => 'Physics',
        'file_path' => 'hcv_concepts_vol1_vol2.pdf'
    ]
];

foreach ($items as $item) {
    // Check if exists
    $stmt = $pdo->prepare("SELECT id FROM study_material WHERE slug = ?");
    $stmt->execute([$item['slug']]);
    $existing = $stmt->fetch();
    
    if (!$existing) {
        $stmt = $pdo->prepare("INSERT INTO study_material (title, slug, type, category, file_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$item['title'], $item['slug'], $item['type'], $item['category'], $item['file_path']]);
        echo "Created: " . $item['title'] . "\n";
    } else {
        echo "Exists: " . $item['title'] . "\n";
    }
}
