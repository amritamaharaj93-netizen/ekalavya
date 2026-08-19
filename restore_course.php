<?php
require 'config/database.php';

$data = [
    'Class 8th Standard',
    'School Prep (Class 7th-12th)',
    '1 Year Program',
    "Class 8th: Comprehensive coverage of class 8th syllabus.\n1 year classroom Program:\n Ideal for students focused on school curriculum while building a strong foundation for competitive exams of their choice, supported by a structured year-long preparation plan.\n\nSubject Covered: \nMATH, SOCIAL SCIENCE, ENGLISH, PHYSICS, CHEMISTRY & Biology.",
    22000.00,
    '2030',
    'Direct Admission',
    "Class-8TH study material \nUniform for classroom \nNecessary Stationary",
    'English / Hindi',
    '2026-2027',
    'Up to 100%',
    '[]',
    '[]',
    '[]',
    60,
    50,
    0,
    10
];

$sql = "UPDATE courses SET 
    title = ?,
    category = ?,
    duration = ?,
    description = ?,
    fees = ?,
    target_year = ?,
    admission_eligibility = ?,
    fee_includes = ?,
    medium = ?,
    academic_session = ?,
    scholarship_note = ?,
    experience_json = ?,
    roadmap_json = ?,
    curriculum_json = ?,
    inst_1_pct = ?,
    inst_2_pct = ?,
    inst_3_pct = ?
    WHERE id = ?";

$stmt = $pdo->prepare($sql);
if ($stmt->execute($data)) {
    echo "Restored course 10 successfully.";
} else {
    echo "Failed to restore.";
}
