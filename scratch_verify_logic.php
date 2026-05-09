<?php
function test_admit_logic($admit_card_val, $file_exists_on_disk) {
    // Mock student array
    $student = ['admit_card' => $admit_card_val];
    
    // Mock file_exists
    // We can't easily mock file_exists without a library, but we can simulate the logic
    $admit_file = !empty($student['admit_card']) ? $student['admit_card'] : '';
    $has_admit = !empty($admit_file) && $admit_file != '#' && $file_exists_on_disk;
    
    echo "Value in DB: '" . $admit_card_val . "' | File exists on disk: " . ($file_exists_on_disk ? "YES" : "NO") . "\n";
    echo "Result: " . ($has_admit ? "ENABLED (DOWNLOAD SLIP)" : "DISABLED (ADMIT CARD PENDING)") . "\n";
    echo "--------------------------------------------------\n";
}

echo "Testing Admit Card Logic Simulation:\n\n";

test_admit_logic('', false);         // Case 1: New student (empty DB)
test_admit_logic('#', false);        // Case 2: Placeholder in DB
test_admit_logic('test.pdf', false); // Case 3: Filename in DB but file missing on disk (New student case if default is set)
test_admit_logic('admit_2_1778054077.pdf', true); // Case 4: Real file uploaded and exists
