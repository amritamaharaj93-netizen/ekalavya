<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "eklavya_academy");

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // 1. Delete all current NEET courses
    $pdo->prepare("DELETE FROM courses WHERE category = 'NEET'")->execute();
    echo "Deleted old NEET courses.\n";

    // 2. Add the 3 new NEET courses
    function slugify($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text);
    }

    $new_courses = [
        [
            'title' => 'NURTURE - Target 2028',
            'category' => 'NEET',
            'duration' => '2 Year Program',
            'target_year' => '2028',
            'description' => 'This course is designed to help students achieve success in NEET with confidence. It features interactive teaching methods that support both NEET and Board exam preparation, ensuring strong conceptual understanding and academic excellence.',
            'admission_eligibility' => 'DIRECT ADMISSION',
            'fees' => 54000,
            'fee_includes' => 'Class-11 study material, Uniform for classroom, Necessary Stationary, FAQ section'
        ],
        [
            'title' => 'Emerge - Target 2029',
            'category' => 'NEET',
            'duration' => '1 Year Program',
            'target_year' => '2029',
            'description' => 'This one-year program is designed to strengthen the fundamentals of Class XII throughout the academic year, while the later phase includes a focused revision of Class XI concepts. With comprehensive classroom teaching, personalized attention, and a well-structured test series, the program equips students with a strong competitive edge',
            'admission_eligibility' => 'Through Ekalavya Admission Test',
            'fees' => 54000,
            'fee_includes' => 'Class-11 study material, Uniform for classroom, Necessary Stationary, FAQ section'
        ],
        [
            'title' => 'Impulse - Target 2029',
            'category' => 'NEET',
            'duration' => '1 Year Program',
            'target_year' => '2029',
            'description' => 'The classroom course is designed for comprehensive NEET preparation. The main feature of the course is that all subjects are taught from a basic to an advanced level by highly experienced faculties.',
            'admission_eligibility' => 'Through Ekalavya Admission Test / NEET SCORE',
            'fees' => 54000,
            'fee_includes' => 'Class-11 study material, Uniform for classroom, Necessary Stationary, FAQ section'
        ]
    ];

    $stmt = $pdo->prepare("INSERT INTO courses (title, slug, category, duration, target_year, description, admission_eligibility, fees, fee_includes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($new_courses as $c) {
        $slug = slugify($c['title']);
        $stmt->execute([
            $c['title'],
            $slug,
            $c['category'],
            $c['duration'],
            $c['target_year'],
            $c['description'],
            $c['admission_eligibility'],
            $c['fees'],
            $c['fee_includes']
        ]);
        echo "Added course: {$c['title']}\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
