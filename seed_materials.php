<?php
/**
 * Eklavya Academy - Study Material Seeding Script
 */

require_once 'config/database.php';

function slugify($text) {
    if (empty($text)) return 'n-a';
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text);
}

$sample_materials = [
    [
        'title' => 'NEET Physics: Vectors & Kinematics Formula Sheet',
        'type' => 'PDF',
        'category' => 'NEET Physics',
        'file_path' => 'sample_physics_1.pdf'
    ],
    [
        'title' => 'NEET Rotational Dynamics - Advanced Notes',
        'type' => 'Notes',
        'category' => 'NEET Physics',
        'file_path' => 'sample_physics_2.pdf'
    ],
    [
        'title' => 'JEE Chemistry: Periodic Table Masterclass',
        'type' => 'PDF',
        'category' => 'JEE Chemistry',
        'file_path' => 'sample_chem.pdf'
    ],
    [
        'title' => 'JEE Organic Chemistry Reaction Mechanism Map',
        'type' => 'Notes',
        'category' => 'JEE Chemistry',
        'file_path' => 'sample_chem_2.pdf'
    ],
    [
        'title' => 'NEET Physics 10-Year Chapterwise PYQs',
        'type' => 'Assignment',
        'category' => 'NEET Physics',
        'file_path' => 'sample_neet_phy.pdf'
    ]
];

echo "<h3>Eklavya Material Seeder</h3>";
echo "<hr>";

try {
    $stmt = $pdo->prepare("INSERT INTO study_material (title, slug, type, category, file_path) VALUES (?, ?, ?, ?, ?)");
    
    $count = 0;
    foreach ($sample_materials as $m) {
        $slug = slugify($m['title']);
        
        // Check if exists
        $check = $pdo->prepare("SELECT id FROM study_material WHERE slug = ?");
        $check->execute([$slug]);
        if ($check->rowCount() == 0) {
            $stmt->execute([
                $m['title'], $slug, $m['type'], $m['category'], $m['file_path']
            ]);
            echo "Indexed: <b>" . $m['title'] . "</b><br>";
            $count++;
        } else {
            echo "Skipped (Exists): " . $m['title'] . "<br>";
        }
    }
    
    echo "<hr>";
    echo "<b>Process complete! $count materials added.</b><br>";
    echo "<p>Go back to <a href='study-material.php'>Knowledge Vault</a> to see results.</p>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
