<?php
$log_path = 'C:\Users\91870\.gemini\antigravity\brain\2554ded4-4391-4aa8-9eca-99fb723b16e7\.system_generated\logs\overview.txt';
$f = fopen($log_path, 'r');
while ($line = fgets($f)) {
    if (strpos($line, 'EMRS Section') !== false) {
        $data = json_decode($line, true);
        if (($data['step_index'] ?? 1000) < 100) {
            echo "Found in Turn " . ($data['step_index'] ?? 'unknown') . "\n";
            $start = strpos($line, 'EMRS Section');
            echo substr($line, $start, 3000);
            break;
        }
    }
}
fclose($f);
?>
