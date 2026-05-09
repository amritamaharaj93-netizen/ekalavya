<?php
require_once '../config/database.php';

$content = [
    [
        "title" => "Academic Excellence",
        "icon" => "fas fa-graduation-cap",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Direct admission for students with 90%+ in Board Exams.</li>
            <li><i class="fas fa-check-circle text-primary me-2"></i> Merit-based fee waivers for ICSE, CBSE, and State Board toppers.</li>
        </ul>'
    ],
    [
        "title" => "Competitive Benchmark",
        "icon" => "fas fa-medal",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Special scholarships for NEET and JEE Main/Advanced qualifiers.</li>
            <li><i class="fas fa-check-circle text-primary me-2"></i> Recognition for NTSE, KVPY, and National Olympiad rankers.</li>
        </ul>'
    ],
    [
        "title" => "Scholarship Slabs",
        "icon" => "fas fa-chart-line",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Tiered scholarship structure based on percentile/score.</li>
            <li><i class="fas fa-check-circle text-primary me-2"></i> Combined benefits for multi-disciplinary achievers.</li>
        </ul>'
    ],
    [
        "title" => "How to Avail?",
        "icon" => "fas fa-clipboard-check",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Register online and upload your marksheets/scorecards.</li>
            <li><i class="fas fa-check-circle text-primary me-2"></i> Fast-track verification and certificate issuance within 48 hours.</li>
        </ul>'
    ]
];

$content_json = json_encode($content);

$stmt = $pdo->prepare("UPDATE scholarship_tabs SET 
    subtitle = 'Merit-Based Scholarship Program',
    description = 'The Ekalavya Merit Reward Scholarship (EMRS) recognizes outstanding academic performers. Secure your seat in our premium batches based on your past achievements in school or competitive exams.',
    content_json = :content_json,
    layout_type = 'list'
    WHERE tab_slug = 'emrs'");

if ($stmt->execute(['content_json' => $content_json])) {
    echo "EMRS content restored and formatted with bullet points.";
} else {
    echo "Error updating EMRS content.";
}
?>
