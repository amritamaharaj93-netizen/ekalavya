<?php
require_once __DIR__ . '/../config/database.php';

$stmt = $pdo->prepare("SELECT id, content_json FROM scholarship_tabs WHERE tab_slug = ?");
$stmt->execute(['emrs']);
$row = $stmt->fetch();

if ($row) {
    $content = json_decode($row['content_json'], true);
    foreach ($content as &$block) {
        $html = $block['content'];
        
        // Apply the same cleaning logic
        $html = strip_tags($html, '<p><ul><li><strong><b><i><em><br>');
        $html = preg_replace('/<(p|ul|li|strong|b|i|em|br)[^>]*>/i', '<$1>', $html);
        while (preg_replace('/<(strong|b|i|em|p|li|ul)>\s*<\/\1>/i', '', $html) !== $html) {
            $html = preg_replace('/<(strong|b|i|em|p|li|ul)>\s*<\/\1>/i', '', $html);
        }
        $html = preg_replace('/<p>\s*<\/p>/i', '', $html);
        
        $block['content'] = trim($html);
    }
    
    $updated_json = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $update_stmt = $pdo->prepare("UPDATE scholarship_tabs SET content_json = ? WHERE id = ?");
    $update_stmt->execute([$updated_json, $row['id']]);
    echo "EMRS content cleaned successfully!";
}
?>
