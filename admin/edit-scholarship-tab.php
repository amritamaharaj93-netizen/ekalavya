<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$tab = null;
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM scholarship_tabs WHERE id = ?");
    $stmt->execute([$id]);
    $tab = $stmt->fetch();
}

$success_msg = "";
$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tab_slug = $_POST['tab_slug'] ?? '';
    $tab_name = $_POST['tab_name'] ?? '';
    $tab_label = $_POST['tab_label'] ?? '';
    $tab_icon = $_POST['tab_icon'] ?? 'fas fa-star';
    $tab_theme = $_POST['tab_theme'] ?? 'orange';
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $description = $_POST['description'] ?? '';
    $display_order = intval($_POST['display_order'] ?? 0);
    $content_json = $_POST['content_json'] ?? '[]';
    $layout_type = $_POST['layout_type'] ?? 'list';

    // AUTO-FIX LOGIC: Clean all content blocks before saving
    $blocks = json_decode($content_json, true);
    if (is_array($blocks)) {
        foreach ($blocks as &$block) {
            $html = $block['content'] ?? '';
            
            // 1. Flatten Tables
            if (strpos($html, '<table') !== false) {
                $html = flattenTablesToParagraphs($html);
            }

            // 2. Strip all tags except basic text ones
            $html = strip_tags($html, '<p><ul><li><strong><b><i><em><br>');

            // 3. Remove all attributes (classes, styles, etc.)
            $html = preg_replace('/<(p|ul|li|strong|b|i|em|br)[^>]*>/i', '<$1>', $html);
            
            // 4. Remove empty nested tags (like <b><b></b></b>) recursively
            while (preg_replace('/<(strong|b|i|em|p|li|ul)>\s*<\/\1>/i', '', $html) !== $html) {
                $html = preg_replace('/<(strong|b|i|em|p|li|ul)>\s*<\/\1>/i', '', $html);
            }

            // 5. Clean up whitespace and empty tags (including &nbsp; and <br>)
            $html = preg_replace('/<p>(\s|&nbsp;|<br>)*<\/p>/i', '', $html);
            $html = preg_replace('/<li>(\s|&nbsp;|<br>)*<\/li>/i', '', $html);
            $html = preg_replace('/(<li>\s*)+/i', '<li>', $html);
            $html = preg_replace('/(<\/li>\s*)+/i', '</li>', $html);
            
            // 6. If the entire content is just whitespace/breaks, clear it
            $plain_text = strip_tags($html);
            $plain_text = str_replace('&nbsp;', '', $plain_text);
            if (trim($plain_text) === '') {
                $html = '';
            }
            
            $block['content'] = trim($html);
        }
        $content_json = json_encode($blocks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    try {
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE scholarship_tabs SET 
                tab_slug=?, tab_name=?, tab_label=?, tab_icon=?, tab_theme=?, 
                title=?, subtitle=?, description=?, display_order=?, content_json=?, layout_type=? 
                WHERE id=?");
            $stmt->execute([
                $tab_slug, $tab_name, $tab_label, $tab_icon, $tab_theme,
                $title, $subtitle, $description, $display_order, $content_json, $layout_type, $id
            ]);
            $success_msg = "Tab updated successfully (Content Auto-Fixed)!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO scholarship_tabs 
                (tab_slug, tab_name, tab_label, tab_icon, tab_theme, title, subtitle, description, display_order, content_json, layout_type) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $tab_slug, $tab_name, $tab_label, $tab_icon, $tab_theme,
                $title, $subtitle, $description, $display_order, $content_json, $layout_type
            ]);
            $id = $pdo->lastInsertId();
            $success_msg = "Tab created successfully (Content Auto-Fixed)!";
        }
        // Refresh data
        $stmt = $pdo->prepare("SELECT * FROM scholarship_tabs WHERE id = ?");
        $stmt->execute([$id]);
        $tab = $stmt->fetch();
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

function flattenTablesToParagraphs($html) {
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $tables = $dom->getElementsByTagName('table');
    for ($i = $tables->length - 1; $i >= 0; $i--) {
        $table = $tables->item($i);
        $rows = $table->getElementsByTagName('tr');
        $fragment = $dom->createDocumentFragment();
        foreach ($rows as $row) {
            $cells = $row->getElementsByTagName('td');
            if ($cells->length == 0) $cells = $row->getElementsByTagName('th');
            $text = "";
            foreach ($cells as $cell) {
                $text .= trim($cell->nodeValue) . " ";
            }
            if (!empty(trim($text))) {
                $p = $dom->createElement('p', htmlspecialchars(trim($text)));
                $fragment->appendChild($p);
            }
        }
        $table->parentNode->replaceChild($fragment, $table);
    }
    return $dom->saveHTML();
}

$content_data = json_decode($tab['content_json'] ?? '[]', true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Scholarship Tab | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
    <style>
        .repeater-item { background: #f8fafc; border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid #e2e8f0; position: relative; }
        .remove-btn { position: absolute; top: 10px; right: 10px; color: #ef4444; cursor: pointer; z-index: 10; }
        .template-btn { font-size: 0.7rem; padding: 2px 8px; margin-top: 5px; }
        .jodit-container { border-radius: 12px !important; border: 1px solid #e2e8f0 !important; overflow: hidden; }
    </style>
    <!-- Jodit Editor -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.24.2/jodit.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.24.2/jodit.min.js"></script>
</head>
<body>
    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4><?php echo $id > 0 ? 'EDIT PATHWAY: ' . htmlspecialchars($tab['tab_name']) : 'NEW SCHOLARSHIP PATHWAY'; ?></h4>
                <a href="manage-scholarship-tabs.php" class="btn btn-outline-secondary rounded-pill">
                    <i class="fas fa-arrow-left me-2"></i> BACK
                </a>
            </header>
            
            <div class="p-4">
                <?php if($success_msg): ?>
                    <div class="alert alert-success rounded-4 border-0 mb-4"><?php echo $success_msg; ?></div>
                <?php endif; ?>
                <?php if($error_msg): ?>
                    <div class="alert alert-danger rounded-4 border-0 mb-4"><?php echo $error_msg; ?></div>
                <?php endif; ?>

                <form method="POST" id="tabForm">
                    <input type="hidden" name="content_json" id="content_json">
                    
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Tab Configuration</h5>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Tab Slug (Unique ID)</label>
                                    <input type="text" class="form-control premium-input border" name="tab_slug" value="<?php echo htmlspecialchars($tab['tab_slug'] ?? ''); ?>" required placeholder="e.g. esat">
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Tab Name</label>
                                        <input type="text" class="form-control premium-input border" name="tab_name" value="<?php echo htmlspecialchars($tab['tab_name'] ?? ''); ?>" required placeholder="e.g. ESAT">
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Tab Label</label>
                                        <input type="text" class="form-control premium-input border" name="tab_label" value="<?php echo htmlspecialchars($tab['tab_label'] ?? ''); ?>" placeholder="e.g. Scholarship Test">
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Icon (FA Class)</label>
                                        <select class="form-select premium-input border icon-picker" name="tab_icon">
                                            <option value="<?php echo htmlspecialchars($tab['tab_icon'] ?? 'fas fa-star'); ?>" selected>Current: <?php echo htmlspecialchars($tab['tab_icon'] ?? 'fas fa-star'); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Theme</label>
                                        <select class="form-select premium-input border" name="tab_theme">
                                            <option value="orange" <?php echo ($tab['tab_theme']??'') == 'orange' ? 'selected' : ''; ?>>Orange</option>
                                            <option value="blue" <?php echo ($tab['tab_theme']??'') == 'blue' ? 'selected' : ''; ?>>Blue</option>
                                            <option value="green" <?php echo ($tab['tab_theme']??'') == 'green' ? 'selected' : ''; ?>>Green</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Display Order</label>
                                        <input type="number" class="form-control premium-input border" name="display_order" value="<?php echo intval($tab['display_order'] ?? 0); ?>">
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Layout Type</label>
                                        <select class="form-select premium-input border" name="layout_type">
                                            <option value="list" <?php echo ($tab['layout_type']??'') == 'list' ? 'selected' : ''; ?>>Feature List</option>
                                            <option value="accordion" <?php echo ($tab['layout_type']??'') == 'accordion' ? 'selected' : ''; ?>>Accordion</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Main Content</h5>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Main Title (HTML OK)</label>
                                    <input type="text" class="form-control premium-input border" name="title" value="<?php echo htmlspecialchars($tab['title'] ?? ''); ?>" placeholder="e.g. ESAT <span class='text-primary'>2026</span>">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Subtitle</label>
                                    <input type="text" class="form-control premium-input border" name="subtitle" value="<?php echo htmlspecialchars($tab['subtitle'] ?? ''); ?>">
                                </div>
                                <div class="mb-0">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Main Description</label>
                                    <textarea class="form-control premium-input border" name="description" rows="3"><?php echo htmlspecialchars($tab['description'] ?? ''); ?></textarea>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold mb-0">Content Blocks (Accordions/Features)</h5>
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill" onclick="addBlock()">+ ADD BLOCK</button>
                                </div>
                                <div id="blocks_container"></div>
                            </div>

                            <button type="submit" class="btn btn-premium w-100 py-3 rounded-4 shadow-lg">
                                <i class="fas fa-save me-2"></i> SAVE SCHOLARSHIP TAB CHANGES
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let blocks = <?php echo json_encode($content_data); ?>;

        const iconOptions = {
            "Academic": {
                "Book/Material": "fas fa-book",
                "Chemistry/Lab": "fas fa-flask",
                "Physics/Science": "fas fa-atom",
                "Math": "fas fa-calculator",
                "Biology": "fas fa-dna",
                "Research": "fas fa-microscope",
                "Robot/AI": "fas fa-robot",
                "Syllabus": "fas fa-list-check"
            },
            "Features": {
                "Online/Mock Test": "fas fa-laptop-code",
                "Duration/Timing": "fas fa-clock",
                "Schedule": "fas fa-calendar-alt",
                "Batch/Class": "fas fa-users-rectangle",
                "Expert Faculty": "fas fa-user-tie",
                "Mentorship": "fas fa-user-graduate",
                "Reports": "fas fa-chart-bar",
                "Results": "fas fa-square-poll-vertical"
            },
            "Badges": {
                "Highlight": "fas fa-star",
                "Success": "fas fa-check-circle",
                "Achievement": "fas fa-trophy",
                "Verified": "fas fa-shield-alt",
                "Secure": "fas fa-lock",
                "Medal": "fas fa-medal"
            },
            "Education": {
                "Admission": "fas fa-id-card",
                "Scholarship": "fas fa-hand-holding-dollar",
                "Fees/Payment": "fas fa-money-bill-wave",
                "Career": "fas fa-briefcase",
                "Building": "fas fa-school",
                "Graduation": "fas fa-graduation-cap"
            },
            "General": {
                "Info": "fas fa-info-circle",
                "Question": "fas fa-question-circle",
                "Edit": "fas fa-edit",
                "Lightbulb": "fas fa-lightbulb"
            }
        };

        function getIconPickerHtml(currentValue, onchange) {
            let html = `<select class="form-select border-0 bg-white small" onchange="${onchange}">`;
            html += `<option value="${currentValue}">Current Icon</option>`;
            for (const category in iconOptions) {
                html += `<optgroup label="${category}">`;
                for (const name in iconOptions[category]) {
                    const val = iconOptions[category][name];
                    html += `<option value="${val}" ${val === currentValue ? 'selected' : ''}>${name}</option>`;
                }
                html += `</optgroup>`;
            }
            html += `</select>`;
            return html;
        }

        const editors = {};

        function initEditor(id) {
            if (editors[id]) return;
            editors[id] = new Jodit('#' + id, {
                height: 350,
                theme: 'default',
                toolbarButtonSize: 'middle',
                buttons: 'undo,redo,|,bold,italic,underline,strikethrough,|,font,fontsize,brush,paragraph,|,align,ul,ol,|,link,table,image,video,|,hr,eraser,copyformat,|,fullsize,selectall,print,source',
                iframe: true,
                iframeStyle: `
                    @import url("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css");
                    @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css");
                    @import url("../assets/css/style.css");
                    body { font-family: Montserrat, sans-serif; font-size: 14px; padding: 20px; background: #fff; }
                    ul { list-style: none !important; padding-left: 0 !important; }
                    ul li, p { 
                        position: relative; 
                        padding-left: 35px !important; 
                        margin-bottom: 12px !important; 
                        display: block !important; 
                        line-height: 1.6;
                        font-weight: 500;
                        color: #444;
                    }
                    ul li::before, p::before { 
                        content: "\f058"; 
                        font-family: "Font Awesome 6 Free"; 
                        font-weight: 900; 
                        position: absolute; 
                        left: 0; 
                        top: 2px; 
                        color: #f7941d !important; 
                        font-size: 1.1rem; 
                    }
                    li:empty::before, p:empty::before, li:has(> br:only-child)::before, p:has(> br:only-child)::before { display: none !important; }
                    
                    /* Visual guide for rows/cols to help admin remove them */
                    .row, .table, .glass-pill-premium { border: 2px solid #ff4444 !important; margin: 10px 0 !important; padding: 10px !important; position: relative !important; background: rgba(255,0,0,0.05) !important; }
                    .row::after, .table::after, .glass-pill-premium::after { content: "INVALID DESIGN (CLICK CLEAN BUTTON)"; position: absolute; top: -10px; right: 10px; font-size: 10px; color: #fff; background: #ff4444; padding: 2px 5px; border-radius: 4px; }
                `,
                extraButtons: [
                    {
                        name: 'cleanGrid',
                        iconURL: 'https://cdn-icons-png.flaticon.com/512/1159/1159641.png',
                        tooltip: 'ULTRA-FIX: Convert All Designs to Simple Bullets',
                        exec: function (editor) {
                            let html = editor.value;
                            
                            // Create a temporary element to process HTML
                            const temp = document.createElement('div');
                            temp.innerHTML = html;

                            // 1. Flatten Tables into paragraphs
                            const tables = temp.querySelectorAll('table');
                            tables.forEach(table => {
                                const rows = table.querySelectorAll('tr');
                                rows.forEach(row => {
                                    const cells = row.querySelectorAll('td, th');
                                    let text = "";
                                    cells.forEach(cell => { text += cell.innerText.trim() + " "; });
                                    if(text.trim()) {
                                        const p = document.createElement('p');
                                        p.innerText = text.trim();
                                        table.parentNode.insertBefore(p, table);
                                    }
                                });
                                table.remove();
                            });

                            // 2. Extract text from ALL divs and badges and convert to paragraphs
                            const complex = temp.querySelectorAll('div, span, section, article, badge');
                            complex.forEach(el => {
                                if (el.innerText.trim() && el.children.length === 0) {
                                    const p = document.createElement('p');
                                    p.innerText = el.innerText.trim();
                                    el.parentNode.insertBefore(p, el);
                                }
                            });
                            
                            // 3. Final HTML String processing
                            let cleanHtml = temp.innerHTML;
                            
                            // Strip all remaining tags except basic ones
                            cleanHtml = cleanHtml.replace(/<(?!\/?(p|ul|li|strong|b|i|em|br)\b)[^>]+>/gi, '');
                            
                            // Remove all attributes (classes, styles, etc.)
                            cleanHtml = cleanHtml.replace(/<([a-z1-6]+)\s+[^>]+>/gi, '<$1>');
                            
                            // Remove empty tags and consolidate
                            cleanHtml = cleanHtml.replace(/<p>\s*<\/p>/gi, '');
                            cleanHtml = cleanHtml.replace(/(<p>\s*)+/gi, '<p>');
                            
                            editor.value = cleanHtml.trim();
                        }
                    }
                ],
                events: {
                    change: function (newValue) {
                        const index = id.split('_')[1];
                        updateBlock(index, 'content', newValue);
                    }
                }
            });
        }

        function renderBlocks() {
            const container = document.getElementById('blocks_container');
            // Clean up existing editors
            Object.keys(editors).forEach(id => {
                editors[id].destruct();
                delete editors[id];
            });
            container.innerHTML = '';
            
            blocks.forEach((block, index) => {
                const id = 'content_' + index;
                container.innerHTML += `
                    <div class="repeater-item shadow-sm">
                        <span class="remove-btn" onclick="removeBlock(${index})"><i class="fas fa-times"></i></span>
                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="extra-small fw-bold text-muted text-uppercase mb-1">Block Title</label>
                                <input type="text" class="form-control border-0 bg-white small fw-bold" placeholder="Block Title" value="${block.title || ''}" onchange="updateBlock(${index}, 'title', this.value)">
                            </div>
                            <div class="col-md-5">
                                <label class="extra-small fw-bold text-muted text-uppercase mb-1">Icon (Visual Picker)</label>
                                ${getIconPickerHtml(block.icon || 'fas fa-star', `updateBlock(${index}, 'icon', this.value)`)}
                            </div>
                            <div class="col-12">
                                <label class="extra-small fw-bold text-muted text-uppercase mb-1">Visual Content Editor</label>
                                <textarea id="${id}" class="editor-area form-control border-0 bg-white small" rows="6">${block.content || ''}</textarea>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Initialize editors and tab icon picker
            setTimeout(() => {
                blocks.forEach((_, index) => initEditor('content_' + index));
                
                // Also update the main tab icon picker if not already populated
                const tabPicker = document.querySelector('select[name="tab_icon"]');
                if (tabPicker && tabPicker.options.length <= 1) {
                    const currentVal = tabPicker.value;
                    let optionsHtml = `<option value="${currentVal}">Current Icon</option>`;
                    for (const category in iconOptions) {
                        optionsHtml += `<optgroup label="${category}">`;
                        for (const name in iconOptions[category]) {
                            const val = iconOptions[category][name];
                            optionsHtml += `<option value="${val}" ${val === currentVal ? 'selected' : ''}>${name}</option>`;
                        }
                        optionsHtml += `</optgroup>`;
                    }
                    tabPicker.innerHTML = optionsHtml;
                }
            }, 100);
        }

        function addBlock() {
            blocks.push({ title: '', icon: 'fas fa-info-circle', content: '' });
            renderBlocks();
        }

        function removeBlock(index) {
            const id = 'content_' + index;
            if (editors[id]) {
                editors[id].destruct();
                delete editors[id];
            }
            blocks.splice(index, 1);
            renderBlocks();
        }

        function updateBlock(index, field, value) {
            if (blocks[index]) {
                blocks[index][field] = value;
            }
        }

        document.getElementById('tabForm').addEventListener('submit', function() {
            // Ensure all editor content is synced back to blocks array
            blocks.forEach((block, index) => {
                const id = 'content_' + index;
                if (editors[id]) {
                    block.content = editors[id].value;
                }
            });
            document.getElementById('content_json').value = JSON.stringify(blocks);
        });

        renderBlocks();
    </script>
</body>
</html>
