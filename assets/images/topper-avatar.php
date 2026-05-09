<?php
/**
 * topper-placeholder.php
 * Generates a dynamic avatar PNG image on the fly for toppers
 * Usage: <img src="topper-avatar.php?name=Arjun+Sharma&color=E65100">
 */
$name = $_GET['name'] ?? 'Student';
$color = ltrim($_GET['color'] ?? 'E65100', '#');

// Create a 200x200 image
$size = 200;
$img = imagecreatetruecolor($size, $size);

// Parse hex color
$r = hexdec(substr($color, 0, 2));
$g = hexdec(substr($color, 2, 2));
$b = hexdec(substr($color, 4, 2));

$bg = imagecolorallocate($img, $r, $g, $b);
$white = imagecolorallocate($img, 255, 255, 255);

// Draw circle background
imagefilledellipse($img, $size/2, $size/2, $size, $size, $bg);

// Get initials
$parts = explode(' ', trim($name));
$initials = strtoupper(substr($parts[0], 0, 1));
if (isset($parts[1])) $initials .= strtoupper(substr($parts[1], 0, 1));

// Draw initials (use built-in font)
$font_size = 5;
$text_width = imagefontwidth($font_size) * strlen($initials);
$text_height = imagefontheight($font_size);
$x = ($size - $text_width) / 2;
$y = ($size - $text_height) / 2;

// Scale up with multiple draws for bigger text
for ($scale = 0; $scale < 5; $scale++) {
    imagestring($img, $font_size, $x + $scale, $y + $scale, $initials, $white);
    imagestring($img, $font_size, $x - $scale, $y - $scale, $initials, $white);
}
imagestring($img, $font_size, $x, $y, $initials, $white);

// Output
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
