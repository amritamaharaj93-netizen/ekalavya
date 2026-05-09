<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "eklavya_academy");

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // 1. Delete all current Foundation courses
    $pdo->prepare("DELETE FROM courses WHERE category = 'Foundation'")->execute();
    echo "Deleted old Foundation courses.\n";

    // 2. Add the 6 new Foundation courses
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
            'title' => 'Class 7th School Excellence Program',
            'category' => 'Foundation',
            'duration' => '1 Year Classroom Program',
            'target_year' => '2026-27 Session',
            'description' => 'Ideal for students focused on school curriculum while building a strong foundation for competitive exams of their choice, supported by a structured year-long preparation plan. Subjects: MATH, SOCIAL SCIENCE, ENGLISH, PHYSICS, CHEMISTRY & BIOLOGY.',
            'admission_eligibility' => 'Direct Admission / Scholarship Test',
            'fees' => 18000,
            'fee_includes' => 'Class-7TH study material, Uniform for classroom, Necessary Stationary, FAQ section'
        ],
        [
            'title' => 'Class 8th School Excellence Program',
            'category' => 'Foundation',
            'duration' => '1 Year Classroom Program',
            'target_year' => '2026-27 Session',
            'description' => 'Ideal for students focused on school curriculum while building a strong foundation for competitive exams of their choice, supported by a structured year-long preparation plan. Subjects: MATH, SOCIAL SCIENCE, ENGLISH, PHYSICS, CHEMISTRY & BIOLOGY.',
            'admission_eligibility' => 'Direct Admission / Scholarship Test',
            'fees' => 19000,
            'fee_includes' => 'Class-8TH study material, Uniform for classroom, Necessary Stationary, FAQ section'
        ],
        [
            'title' => 'Class 9th School Excellence Program',
            'category' => 'Foundation',
            'duration' => '1 Year Classroom Program',
            'target_year' => '2026-27 Session',
            'description' => 'Ideal for students focused on school curriculum while building a strong foundation for competitive exams of their choice, supported by a structured year-long preparation plan. Subjects: MATH, SOCIAL SCIENCE, ENGLISH, PHYSICS, CHEMISTRY & BIOLOGY.',
            'admission_eligibility' => 'Direct Admission / Scholarship Test',
            'fees' => 20000,
            'fee_includes' => 'Class-9TH study material, Uniform for classroom, Necessary Stationary, FAQ section'
        ],
        [
            'title' => 'Class 10th School Excellence Program',
            'category' => 'Foundation',
            'duration' => '1 Year Classroom Program',
            'target_year' => '2026-27 Session',
            'description' => 'Ideal for students focused on school curriculum while building a strong foundation for competitive exams of their choice, supported by a structured year-long preparation plan. Subjects: MATH, SOCIAL SCIENCE, ENGLISH, PHYSICS, CHEMISTRY & BIOLOGY.',
            'admission_eligibility' => 'Direct Admission / Scholarship Test',
            'fees' => 22000,
            'fee_includes' => 'Class-10TH study material, Uniform for classroom, Necessary Stationary, FAQ section'
        ],
        [
            'title' => 'Class 11th School Support (Science)',
            'category' => 'Foundation',
            'duration' => '1 Year Classroom Program',
            'target_year' => '2026-27 Session',
            'description' => 'This Class 11 Science course (PCM/PCB) is designed to help students build a strong foundation in Physics, Chemistry, and Maths/Biology, ensuring better performance in school and future Board exams.',
            'admission_eligibility' => 'Direct Admission / Scholarship Test',
            'fees' => 24000,
            'fee_includes' => 'Class-11 study material, Uniform for classroom, Necessary Stationary, FAQ section'
        ],
        [
            'title' => 'Class 12th School Support (Science)',
            'category' => 'Foundation',
            'duration' => '1 Year Classroom Program',
            'target_year' => '2026-27 Session',
            'description' => 'This Class 12 Science course (PCM/PCB) is designed to help students build a strong foundation in Physics, Chemistry, and Maths/Biology, ensuring better performance in school and future Board exams.',
            'admission_eligibility' => 'Direct Admission / Scholarship Test',
            'fees' => 27000,
            'fee_includes' => 'Class-12 study material, Uniform for classroom, Necessary Stationary, FAQ section'
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
