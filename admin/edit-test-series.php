<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $pdo->prepare("SELECT * FROM test_series WHERE id = ?");
$stmt->execute([$id]);
$test = $stmt->fetch();

if (!$test) { die("Test series not found."); }

$success_msg = "";
$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $category = $_POST['category'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $slug = $_POST['slug'];
    $header_title = $_POST['header_title'];
    $header_subtitle = $_POST['header_subtitle'];
    $badge_label = $_POST['badge_label'];
    $lifecycle_title = $_POST['lifecycle_title'];
    $lifecycle_desc = $_POST['lifecycle_desc'];
    $class_label = $_POST['class_label'];
    $duration_label = $_POST['duration_label'];
    $subjects = $_POST['subjects'];
    $reward_title = $_POST['reward_title'];
    $reward_desc = $_POST['reward_desc'];
    $show_reward_banner = isset($_POST['show_reward_banner']) ? 1 : 0;
    $show_stars_banner = isset($_POST['show_stars_banner']) ? 1 : 0;
    
    // Complex fields handled via details_json
    $details = [
        'offerings' => array_filter(explode("\n", str_replace("\r", "", $_POST['offerings']))),
        'about_cards' => json_decode($_POST['about_cards_json'], true),
        'card1' => [
            'badge' => $_POST['card1_badge'],
            'title' => $_POST['card1_title'],
            'sub' => $_POST['card1_sub'],
            'bg' => $_POST['card1_bg']
        ],
        'card2' => [
            'badge' => $_POST['card2_badge'],
            'title' => $_POST['card2_title'],
            'sub' => $_POST['card2_sub'],
            'bg' => $_POST['card2_bg']
        ],
        'reward_bg' => $_POST['reward_bg'] ?? '',
        'reward_icon' => $_POST['reward_icon'] ?? '',
        'note' => [
            'title' => $_POST['note_title'],
            'desc' => $_POST['note_desc']
        ]
    ];
    $details_json = json_encode($details);

    try {
        $stmt = $pdo->prepare("UPDATE test_series SET 
            title=?, slug=?, category=?, type=?, price=?, 
            header_title=?, header_subtitle=?, badge_label=?, 
            lifecycle_title=?, lifecycle_desc=?, class_label=?, duration_label=?, 
            subjects=?, reward_title=?, reward_desc=?, 
            show_reward_banner=?, show_stars_banner=?, details_json=? 
            WHERE id=?");
        $stmt->execute([
            $title, $slug, $category, $type, $price, 
            $header_title, $header_subtitle, $badge_label, 
            $lifecycle_title, $lifecycle_desc, $class_label, $duration_label, 
            $subjects, $reward_title, $reward_desc, 
            $show_reward_banner, $show_stars_banner, $details_json, $id
        ]);
        $success_msg = "Test series details updated successfully!";
        // Refresh
        $stmt = $pdo->prepare("SELECT * FROM test_series WHERE id = ?");
        $stmt->execute([$id]);
        $test = $stmt->fetch();
    } catch (PDOException $e) { $error_msg = "Error: " . $e->getMessage(); }
}

$details = json_decode($test['details_json'] ?? '[]', true);
$offerings_text = implode("\n", $details['offerings'] ?? []);
$about_cards = $details['about_cards'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Test Series | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
    <style>
        .repeater-item { background: #f8fafc; border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid #e2e8f0; position: relative; }
        .remove-btn { position: absolute; top: 10px; right: 10px; color: #ef4444; cursor: pointer; }
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
                <h4>EDIT: <?php echo htmlspecialchars($test['title']); ?></h4>
                <a href="manage-test-series.php" class="btn btn-outline-secondary rounded-pill">
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

                <form method="POST" id="testEditForm">
                    <input type="hidden" name="about_cards_json" id="about_cards_json">
                    
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Core Info</h5>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Title</label>
                                    <input type="text" class="form-control premium-input border" name="title" value="<?php echo htmlspecialchars($test['title']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Slug</label>
                                    <input type="text" class="form-control premium-input border" name="slug" value="<?php echo htmlspecialchars($test['slug']); ?>" required>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Category</label>
                                        <select class="form-select premium-input border" name="category">
                                            <option value="NEET" <?php echo $test['category']=='NEET'?'selected':''; ?>>NEET</option>
                                            <option value="IIT-JEE" <?php echo $test['category']=='IIT-JEE'?'selected':''; ?>>IIT-JEE</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Type</label>
                                        <input type="text" class="form-control premium-input border" name="type" value="<?php echo htmlspecialchars($test['type']); ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Price (₹)</label>
                                    <input type="text" class="form-control premium-input border" name="price" value="<?php echo htmlspecialchars($test['price']); ?>">
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-white" style="background: #009E60;">
                                <h5 class="fw-bold mb-4 text-white">Header Branding</h5>
                                <div class="mb-3">
                                    <label class="small fw-bold text-white-50 text-uppercase mb-2">Header Title</label>
                                    <input type="text" class="form-control bg-white bg-opacity-10 border-0 text-white" name="header_title" value="<?php echo htmlspecialchars($test['header_title'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-white-50 text-uppercase mb-2">Header Subtitle</label>
                                    <input type="text" class="form-control bg-white bg-opacity-10 border-0 text-white" name="header_subtitle" value="<?php echo htmlspecialchars($test['header_subtitle'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-white-50 text-uppercase mb-2">Badge Label</label>
                                    <input type="text" class="form-control bg-white bg-opacity-10 border-0 text-white" name="badge_label" value="<?php echo htmlspecialchars($test['badge_label'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Academic Details</h5>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Lifecycle Title</label>
                                    <input type="text" class="form-control premium-input border" name="lifecycle_title" value="<?php echo htmlspecialchars($test['lifecycle_title'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Lifecycle Description</label>
                                    <textarea class="form-control premium-input border" name="lifecycle_desc" rows="3"><?php echo htmlspecialchars($test['lifecycle_desc'] ?? ''); ?></textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Class Label</label>
                                        <input type="text" class="form-control premium-input border" name="class_label" value="<?php echo htmlspecialchars($test['class_label'] ?? ''); ?>">
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Duration</label>
                                        <input type="text" class="form-control premium-input border" name="duration_label" value="<?php echo htmlspecialchars($test['duration_label'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Subjects</label>
                                    <input type="text" class="form-control premium-input border" name="subjects" value="<?php echo htmlspecialchars($test['subjects'] ?? ''); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Course Offerings (One per line)</h5>
                                <textarea class="form-control premium-input border" name="offerings" rows="5" placeholder="e.g. 15+ computer-based tests..."><?php echo $offerings_text; ?></textarea>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold mb-0">About Cards</h5>
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill" onclick="addAboutCard()">+ ADD CARD</button>
                                </div>
                                <div id="about_cards_container"></div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                                        <h6 class="fw-bold mb-3">Feature Card 1</h6>
                                        <input type="text" class="form-control form-control-sm mb-2" name="card1_badge" placeholder="Badge" value="<?php echo htmlspecialchars($details['card1']['badge'] ?? ''); ?>">
                                        <input type="text" class="form-control form-control-sm mb-2" name="card1_title" placeholder="Title" value="<?php echo htmlspecialchars($details['card1']['title'] ?? ''); ?>">
                                        <input type="text" class="form-control form-control-sm mb-2" name="card1_sub" placeholder="Sub-text" value="<?php echo htmlspecialchars($details['card1']['sub'] ?? ''); ?>">
                                        <input type="text" class="form-control form-control-sm" name="card1_bg" placeholder="BG CSS (Gradient/Color)" value="<?php echo htmlspecialchars($details['card1']['bg'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                                        <h6 class="fw-bold mb-3">Feature Card 2</h6>
                                        <input type="text" class="form-control form-control-sm mb-2" name="card2_badge" placeholder="Badge" value="<?php echo htmlspecialchars($details['card2']['badge'] ?? ''); ?>">
                                        <input type="text" class="form-control form-control-sm mb-2" name="card2_title" placeholder="Title" value="<?php echo htmlspecialchars($details['card2']['title'] ?? ''); ?>">
                                        <input type="text" class="form-control form-control-sm mb-2" name="card2_sub" placeholder="Sub-text" value="<?php echo htmlspecialchars($details['card2']['sub'] ?? ''); ?>">
                                        <input type="text" class="form-control form-control-sm" name="card2_bg" placeholder="BG CSS (Gradient/Color)" value="<?php echo htmlspecialchars($details['card2']['bg'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Reward & Toppers Banners</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch p-3 bg-light rounded-3">
                                            <input class="form-check-input ms-0 me-2" type="checkbox" name="show_reward_banner" <?php echo ($test['show_reward_banner']??0)?'checked':''; ?>>
                                            <label class="form-check-label fw-bold small text-uppercase">Show Reward Banner</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch p-3 bg-light rounded-3">
                                            <input class="form-check-input ms-0 me-2" type="checkbox" name="show_stars_banner" <?php echo ($test['show_stars_banner']??0)?'checked':''; ?>>
                                            <label class="form-check-label fw-bold small text-uppercase">Show Toppers Stars</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Reward Title</label>
                                    <input type="text" class="form-control premium-input border" name="reward_title" value="<?php echo htmlspecialchars($test['reward_title'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Reward Description (Simple Editor)</label>
                                    <textarea class="form-control premium-input border" id="reward_desc" name="reward_desc" rows="3"><?php echo htmlspecialchars($test['reward_desc'] ?? ''); ?></textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Reward Banner BG (CSS or Picker)</label>
                                        <div class="input-group">
                                            <input type="text" id="reward_bg_input" class="form-control premium-input border" name="reward_bg" placeholder="e.g. #f7941d or linear-gradient(...)" value="<?php echo htmlspecialchars($details['reward_bg'] ?? ''); ?>">
                                            <input type="color" class="form-control form-control-color border" style="width: 60px; height: 50px;" oninput="document.getElementById('reward_bg_input').value = this.value" value="<?php echo (strpos($details['reward_bg']??'', '#') === 0 && strlen($details['reward_bg']??'') == 7) ? $details['reward_bg'] : '#f7941d'; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Reward Banner Icon</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border"><i id="reward_icon_preview" class="<?php echo htmlspecialchars($details['reward_icon'] ?? 'fas fa-coins'); ?>"></i></span>
                                            <select class="form-select premium-input border" name="reward_icon" onchange="document.getElementById('reward_icon_preview').className = this.value">
                                                <option value="<?php echo htmlspecialchars($details['reward_icon'] ?? 'fas fa-coins'); ?>">Current: <?php echo htmlspecialchars($details['reward_icon'] ?? 'fas fa-coins'); ?></option>
                                                <optgroup label="Popular">
                                                    <option value="fas fa-coins">Coins</option>
                                                    <option value="fas fa-trophy">Trophy</option>
                                                    <option value="fas fa-medal">Medal</option>
                                                    <option value="fas fa-gift">Gift</option>
                                                    <option value="fas fa-star">Star</option>
                                                    <option value="fas fa-hand-holding-dollar">Scholarship</option>
                                                    <option value="fas fa-robot">Robot/AI</option>
                                                    <option value="fas fa-users-rectangle">Batch</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Bottom Info Note</h5>
                                <input type="text" class="form-control form-control-sm mb-2" name="note_title" placeholder="Note Title" value="<?php echo htmlspecialchars($details['note']['title'] ?? ''); ?>">
                                <textarea class="form-control form-control-sm" name="note_desc" rows="2" placeholder="Note Description"><?php echo htmlspecialchars($details['note']['desc'] ?? ''); ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-premium w-100 py-3 rounded-4 shadow-lg">
                                <i class="fas fa-save me-2"></i> SAVE TEST SERIES CHANGES
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let aboutCards = <?php echo json_encode($about_cards); ?>;

        const iconLibrary = {
            "Academic": [
                { icon: "fas fa-book", label: "Book/Material" },
                { icon: "fas fa-vial", label: "Chemistry/Lab" },
                { icon: "fas fa-atom", label: "Physics/Science" },
                { icon: "fas fa-square-root-alt", label: "Math" },
                { icon: "fas fa-dna", label: "Biology" },
                { icon: "fas fa-microscope", label: "Research" }
            ],
            "Features": [
                { icon: "fas fa-laptop-code", label: "Online/Mock Test" },
                { icon: "fas fa-clock", label: "Duration/Timing" },
                { icon: "fas fa-calendar-check", label: "Schedule" },
                { icon: "fas fa-chalkboard-teacher", label: "Expert Faculty" },
                { icon: "fas fa-user-tie", label: "Mentorship" },
                { icon: "fas fa-file-invoice", label: "Reports" }
            ],
            "Badges": [
                { icon: "fas fa-star", label: "Highlight" },
                { icon: "fas fa-trophy", label: "Success" },
                { icon: "fas fa-award", label: "Achievement" },
                { icon: "fas fa-check-circle", label: "Verified" },
                { icon: "fas fa-shield-alt", label: "Secure" },
                { icon: "fas fa-rocket", label: "Boost" }
            ]
        };

        function renderAboutCards() {
            const container = document.getElementById('about_cards_container');
            container.innerHTML = '';
            aboutCards.forEach((card, index) => {
                let iconOptions = '';
                for (const category in iconLibrary) {
                    iconOptions += `<optgroup label="${category}">`;
                    iconLibrary[category].forEach(item => {
                        iconOptions += `<option value="${item.icon}" ${card.icon === item.icon ? 'selected' : ''}>${item.label}</option>`;
                    });
                    iconOptions += `</optgroup>`;
                }

                container.innerHTML += `
                    <div class="repeater-item shadow-sm">
                        <span class="remove-btn" onclick="removeAboutCard(${index})"><i class="fas fa-times"></i></span>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="extra-small fw-bold text-muted text-uppercase mb-1">Card Title</label>
                                <input type="text" class="form-control border-0 bg-white small fw-bold mb-2" placeholder="e.g. Smart Revision Tools" value="${card.title}" oninput="suggestIcon(${index}, this.value)" onchange="updateAboutCard(${index}, 'title', this.value)">
                                
                                <label class="extra-small fw-bold text-muted text-uppercase mb-1">Select Icon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text border-0 bg-white"><i id="preview_icon_${index}" class="${card.icon || 'fas fa-check-circle'}"></i></span>
                                    <select class="form-select border-0 bg-white small" onchange="updateAboutCard(${index}, 'icon', this.value)">
                                        <option value="">-- Choose Icon --</option>
                                        ${iconOptions}
                                        <option value="CUSTOM" ${!Object.values(iconLibrary).flat().some(i => i.icon === card.icon) ? 'selected' : ''}>Custom Code...</option>
                                    </select>
                                </div>
                                <input type="text" id="custom_icon_${index}" class="form-control border-0 bg-white small ${Object.values(iconLibrary).flat().some(i => i.icon === card.icon) ? 'd-none' : ''}" placeholder="fas fa-..." value="${card.icon}" onchange="updateAboutCard(${index}, 'icon', this.value)">
                            </div>
                            <div class="col-12">
                                <label class="extra-small fw-bold text-muted text-uppercase mb-1">Feature Points (One per line)</label>
                                <textarea class="form-control border-0 bg-white small" rows="3" placeholder="e.g. Detailed Analysis&#10;Topic-wise breakdown" onchange="updateAboutCard(${index}, 'points_text', this.value)">${(card.points || []).join('\n')}</textarea>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function suggestIcon(index, title) {
            const val = title.toLowerCase();
            let icon = "";
            
            if (val.includes('test') || val.includes('mock') || val.includes('computer')) icon = "fas fa-laptop-code";
            else if (val.includes('report') || val.includes('analysis') || val.includes('result')) icon = "fas fa-file-invoice";
            else if (val.includes('teacher') || val.includes('faculty') || val.includes('expert')) icon = "fas fa-chalkboard-teacher";
            else if (val.includes('mentor') || val.includes('guide') || val.includes('counsel')) icon = "fas fa-user-tie";
            else if (val.includes('time') || val.includes('duration') || val.includes('schedule')) icon = "fas fa-clock";
            else if (val.includes('book') || val.includes('material') || val.includes('note')) icon = "fas fa-book";
            else if (val.includes('physic')) icon = "fas fa-atom";
            else if (val.includes('chem')) icon = "fas fa-vial";
            else if (val.includes('math')) icon = "fas fa-square-root-alt";
            else if (val.includes('bio')) icon = "fas fa-dna";
            else if (val.includes('success') || val.includes('win') || val.includes('topper')) icon = "fas fa-trophy";
            else if (val.includes('award') || val.includes('medal')) icon = "fas fa-award";

            if (icon) {
                updateAboutCard(index, 'icon', icon);
                renderAboutCards();
            }
        }

        function addAboutCard() {
            aboutCards.push({ title: '', icon: 'fas fa-check-circle', points: [] });
            renderAboutCards();
        }

        function removeAboutCard(index) {
            aboutCards.splice(index, 1);
            renderAboutCards();
        }

        function updateAboutCard(index, field, value) {
            if (value === 'CUSTOM') {
                document.getElementById(`custom_icon_${index}`).classList.remove('d-none');
                return;
            }
            
            if (field === 'icon') {
                const customInput = document.getElementById(`custom_icon_${index}`);
                if (customInput && !customInput.classList.contains('d-none')) {
                    if (!Object.values(iconLibrary).flat().some(i => i.icon === value)) {
                        // Keep visible if custom
                    } else {
                        customInput.classList.add('d-none');
                    }
                }
                const preview = document.getElementById(`preview_icon_${index}`);
                if (preview) preview.className = value;
            }

            if(field === 'points_text') {
                aboutCards[index].points = value.split('\n').filter(p => p.trim() !== '');
            } else {
                aboutCards[index][field] = value;
            }
        }

        document.getElementById('testEditForm').addEventListener('submit', function() {
            document.getElementById('about_cards_json').value = JSON.stringify(aboutCards);
        });

        renderAboutCards();

        // Initialize Jodit for Reward Description
        const editor = new Jodit('#reward_desc', {
            buttons: 'bold,italic,underline,strikethrough,|,ul,ol,|,font,fontsize,brush,paragraph,|,link,unlink,|,align,undo,redo,|,source',
            height: 200,
            placeholder: 'Type reward description here...'
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
