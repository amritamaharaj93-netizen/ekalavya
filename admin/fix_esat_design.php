<?php
require_once '../config/database.php';

$content = [
    [
        "title" => "BASIC DETAILS",
        "icon" => "fas fa-info-circle",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> ESAT 2026 is conducted across multiple phases for students moving to Classes VII, VIII, IX, X, XI, and XII.</li>
            <li><i class="fas fa-check-circle text-primary me-2"></i> The test assesses fundamental understanding of core subjects and logical reasoning.</li>
        </ul>'
    ],
    [
        "title" => "TEST DETAILS",
        "icon" => "fas fa-calendar-alt",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-clock text-primary me-2"></i> Duration: 90 Minutes</li>
            <li class="mb-2"><i class="fas fa-list-ol text-primary me-2"></i> Format: MCQ based Pattern</li>
            <li><i class="fas fa-map-marker-alt text-primary me-2"></i> Mode: Offline (at Ekalavya Centers)</li>
        </ul>'
    ],
    [
        "title" => "TEST SYLLABUS",
        "icon" => "fas fa-book-open",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-atom text-primary me-2"></i> Class-appropriate Physics, Chemistry, Mathematics/Biology.</li>
            <li><i class="fas fa-brain text-primary me-2"></i> Mental Ability and Logical Reasoning.</li>
        </ul>'
    ],
    [
        "title" => "BENEFITS OF ESAT",
        "icon" => "fas fa-gift",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Up to 100% Scholarship on Tuition Fees.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> National Benchmarking against thousands of students.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Detailed Performance Analysis (AI-driven reports).</li>
            <li><i class="fas fa-check-circle text-primary me-2"></i> Priority Admission for upcoming 2026-27 Batches.</li>
        </ul>'
    ],
    [
        "title" => "TEST PROCESS",
        "icon" => "fas fa-tasks",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-edit text-primary me-2"></i> <strong>Register Online:</strong> Fill the registration form on the right.</li>
            <li class="mb-2"><i class="fas fa-id-card text-primary me-2"></i> <strong>Admit Card:</strong> Receive details via Email/WhatsApp.</li>
            <li class="mb-2"><i class="fas fa-school text-primary me-2"></i> <strong>Exam Day:</strong> Appear at the designated Ekalavya Center.</li>
            <li><i class="fas fa-poll text-primary me-2"></i> <strong>Results:</strong> Declared within 7 days of the test.</li>
        </ul>'
    ],
    [
        "title" => "FAQ & SCHOLARSHIP SLABS",
        "icon" => "fas fa-question-circle",
        "content" => '<ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fas fa-star text-primary me-2"></i> 90% – 100% Score: <strong>100% SCHOLARSHIP</strong></li>
            <li class="mb-2"><i class="fas fa-star text-primary me-2"></i> 80% – 89% Score: <strong>75% SCHOLARSHIP</strong></li>
            <li class="mb-2"><i class="fas fa-star text-primary me-2"></i> 70% – 79% Score: <strong>50% SCHOLARSHIP</strong></li>
            <li class="mb-2"><i class="fas fa-star text-primary me-2"></i> 60% – 69% Score: <strong>30% SCHOLARSHIP</strong></li>
            <li><i class="fas fa-star text-primary me-2"></i> 50% – 59% Score: <strong>20% SCHOLARSHIP</strong></li>
        </ul>'
    ]
];

$json = json_encode($content);
$stmt = $pdo->prepare("UPDATE scholarship_tabs SET content_json = ? WHERE tab_slug = 'esat'");
$stmt->execute([$json]);
echo "ESAT Content Updated Successfully";
?>
