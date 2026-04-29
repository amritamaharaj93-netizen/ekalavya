<?php
$dir = 'c:/xampp/htdocs/ek';
$files = [
    'about.php',
    'contact.php',
    'course-detail.php',
    'index.php',
    'scholarship.php',
    'study-material.php',
    'test-series.php',
    'test-series-detail.php',
    'includes/footer.php',
    'includes/header.php',
    'admin/dashboard.php',
    'admin/manage-courses.php',
    'admin/manage-scholarships.php',
    'admin/manage-students.php',
    'admin/manage-study-material.php',
    'admin/manage-test-series.php'
];

foreach ($files as $file) {
    $path = "$dir/$file";
    if (file_exists($path)) {
        $content = file_get_contents($path);
        
        // 1. Spelling: Eklavya -> Ekalavya
        $content = str_ireplace('Eklavya', 'Ekalavya', $content);
        
        // 2. Email: info.ekalavya@gmail.com -> info.ekalavyaeducation@gmail.com
        $content = str_replace('info.ekalavya@gmail.com', 'info.ekalavyaeducation@gmail.com', $content);
        
        // 3. Category: Foundation -> School Prep (Class 7th-12th)
        $content = str_replace('Foundation', 'School Prep (Class 7th-12th)', $content);
        
        file_put_contents($path, $content);
        echo "Updated: $file\n";
    }
}
?>
