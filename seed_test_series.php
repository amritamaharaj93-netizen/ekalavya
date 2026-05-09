<?php
/**
 * Eklavya Academy - Test Series Seeding Script
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

$sample_tests = [
    [
        'title' => 'NEET Full Length Major Test Series',
        'category' => 'NEET-UG Full Length',
        'price' => '₹4,999',
        'description' => 'A comprehensive set of 20 full-length mock tests mapped to the latest NTA pattern with detailed AI-driven analytics.',
        'link' => 'https://onlinetest.eklavya.in'
    ],
    [
        'title' => 'JEE Main - All India AITS (Full Syllabus)',
        'category' => 'IIT-JEE Full Length',
        'price' => '₹5,999',
        'description' => 'National level benchmarking series for JEE Main with predicted AIR and percentile mapping.',
        'link' => 'https://onlinetest.eklavya.in'
    ],
    [
        'title' => 'Physics Chapterwise Revision Test (Class 11)',
        'category' => 'Revision',
        'price' => 'Free',
        'description' => 'Targeted revision tests for core physics topics including Mechanics and Thermodynamics.',
        'link' => 'https://onlinetest.eklavya.in'
    ],
    [
        'title' => 'NEET Rank Booster (Unit Tests)',
        'category' => 'NEET Unit Test',
        'price' => '₹2,500',
        'description' => 'Unit-wise testing for Biology masterclass and Chemistry conceptual deep-dives.',
        'link' => 'https://onlinetest.eklavya.in'
    ]
];

echo "<h3>Eklavya Test Series Seeder</h3>";
echo "<hr>";

try {
    $stmt = $pdo->prepare("INSERT INTO test_series (title, slug, category, price, description, link) VALUES (?, ?, ?, ?, ?, ?)");
    
    $count = 0;
    foreach ($sample_tests as $t) {
        $slug = slugify($t['title']);
        
        // Check if exists
        $check = $pdo->prepare("SELECT id FROM test_series WHERE slug = ?");
        $check->execute([$slug]);
        if ($check->rowCount() == 0) {
            $stmt->execute([
                $t['title'], $slug, $t['category'], $t['price'], $t['description'], $t['link']
            ]);
            echo "Deployed: <b>" . $t['title'] . "</b><br>";
            $count++;
        } else {
            echo "Skipped (Exists): " . $t['title'] . "<br>";
        }
    }
    
    echo "<hr>";
    echo "<b>Process complete! $count test series added.</b><br>";
    echo "<p>Go back to <a href='test-series.php'>Test Portal</a> to see results.</p>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
