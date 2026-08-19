<?php
$files = glob('assets/images/*banner*.{jpg,png,jpeg,webp}', GLOB_BRACE);
foreach($files as $f) {
    $s = getimagesize($f);
    echo basename($f) . ': ' . $s[0] . 'x' . $s[1] . ' (Ratio: ' . round($s[0]/$s[1], 2) . ')' . PHP_EOL;
}
