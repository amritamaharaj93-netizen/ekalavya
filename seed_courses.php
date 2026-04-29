<?php
/**
 * Eklavya Academy - Course Seeding Script
 * Run this file once to populate your database with sample institutional courses.
 */

require_once 'config/database.php';

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text);
}

$sample_courses = [
    // NEET Division
    [
        'title' => 'SEED (NEET Batch for Class IX)',
        'category' => 'NEET',
        'duration' => '4 Year Program',
        'description' => 'A foundational course for NEET aspirants starting early in Class 9, focusing on medical biology and core sciences.',
        'target_year' => '2030',
        'fees' => 45000
    ],
    [
        'title' => 'ANKUR (NEET Batch for Class X)',
        'category' => 'NEET',
        'duration' => '3 Year Program',
        'description' => 'Comprehensive preparation for medical entrances starting from Class 10.',
        'target_year' => '2029',
        'fees' => 55000
    ],
    [
        'title' => 'NURTURE (NEET Batch for Class XI)',
        'category' => 'NEET',
        'duration' => '2 Year Program',
        'description' => 'Our flagship 2-year classroom program for NEET excellence, covering Physics, Chemistry, and Biology (Zoology/Botany).',
        'target_year' => '2028',
        'fees' => 95000
    ],
    [
        'title' => 'EMERGE (NEET Batch for Class XII)',
        'category' => 'NEET',
        'duration' => '1 Year Program',
        'description' => 'Rigorous 1-year training for Class 12 students aiming for NEET with exhaustive revision of Class 11.',
        'target_year' => '2027',
        'fees' => 85000
    ],
    [
        'title' => 'IMPULSE (NEET Dropper Batch)',
        'category' => 'NEET',
        'duration' => '1 Year Program',
        'description' => 'Specialized batch for Class 12 pass students with full focus on rank improvement in NEET.',
        'target_year' => '2026',
        'fees' => 110000
    ],

    // IIT-JEE Division
    [
        'title' => 'SEED (IIT-JEE Batch for Class IX)',
        'category' => 'IIT-JEE',
        'duration' => '4 Year Program',
        'description' => 'Laying the foundation for Engineering excellence through advanced mathematics and science modules.',
        'target_year' => '2030',
        'fees' => 50000
    ],
    [
        'title' => 'NURTURE (IIT-JEE Batch for Class XI)',
        'category' => 'IIT-JEE',
        'duration' => '2 Year Program',
        'description' => 'Premier preparation program for JEE Main & Advanced covering depth of Physics, Chemistry, and Mathematics.',
        'target_year' => '2028',
        'fees' => 105000
    ],

    // Foundation Division
    [
        'title' => 'School Excellence Program (Class VIII)',
        'category' => 'Foundation',
        'duration' => '1 Year',
        'description' => 'Building core clarity for Junior Scientific Olympiads and NTSE preparation.',
        'target_year' => '2028',
        'fees' => 25000
    ]
];

echo "<h3>Eklavya Database Seeder</h3>";
echo "<hr>";

try {
    $stmt = $pdo->prepare("INSERT INTO courses (title, slug, category, duration, description, target_year, fees) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $count = 0;
    foreach ($sample_courses as $c) {
        $slug = slugify($c['title']);
        
        // Check if exists
        $check = $pdo->prepare("SELECT id FROM courses WHERE slug = ?");
        $check->execute([$slug]);
        if ($check->rowCount() == 0) {
            $stmt->execute([
                $c['title'], $slug, $c['category'], $c['duration'], $c['description'], $c['target_year'], $c['fees']
            ]);
            echo "Inserted: <b>" . $c['title'] . "</b><br>";
            $count++;
        } else {
            echo "Skipped (Exists): " . $c['title'] . "<br>";
        }
    }
    
    echo "<hr>";
    echo "<b>Process complete! $count new courses added.</b><br>";
    echo "<p>Go back to <a href='courses.php'>Course Catalog</a> to see results.</p>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
