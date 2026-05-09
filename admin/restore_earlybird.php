<?php
require_once __DIR__ . '/../config/database.php';

$content = [
    [
        "title" => "Early Bird Benefits",
        "icon" => "fas fa-child",
        "content" => "<p>Secure up to 25% waiver on tuition fees.</p><p>Applicable for early registration in the 2026 academic session.</p>"
    ],
    [
        "title" => "School Rankers Reward",
        "icon" => "fas fa-trophy",
        "content" => "<p>Special recognition and scholarships for top performers.</p><p>For students ranked in the top 3 of their respective classes.</p>"
    ],
    [
        "title" => "NTSE/Olympiad Prep",
        "icon" => "fas fa-book",
        "content" => "<p>Integrated preparation modules for NTSE.</p><p>Science/Math Olympiads included in the package.</p>"
    ]
];

$json = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$stmt = $pdo->prepare("UPDATE scholarship_tabs SET content_json = ? WHERE tab_slug = ?");
$stmt->execute([$json, 'school']);

echo "Early Bird content restored successfully!";
?>
