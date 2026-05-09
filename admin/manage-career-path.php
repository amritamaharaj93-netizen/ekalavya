<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// --- FEATURE LOGIC ---
if (isset($_POST['add_feature'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $icon = trim($_POST['icon']);

    if (!empty($title)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO career_features (title, description, icon) VALUES (?, ?, ?)");
            $stmt->execute([$title, $description, $icon]);
            $success_msg = "Feature added successfully!";
        } catch (PDOException $e) { $error_msg = $e->getMessage(); }
    }
}

if (isset($_POST['edit_feature'])) {
    $id = $_POST['feature_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $icon = trim($_POST['icon']);

    try {
        $stmt = $pdo->prepare("UPDATE career_features SET title=?, description=?, icon=? WHERE id=?");
        $stmt->execute([$title, $description, $icon, $id]);
        $success_msg = "Feature updated successfully!";
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

if (isset($_GET['delete_feature'])) {
    $id = intval($_GET['delete_feature']);
    $pdo->prepare("DELETE FROM career_features WHERE id = ?")->execute([$id]);
    header("Location: manage-career-path.php?deleted=1");
    exit();
}

// --- JOURNEY LOGIC ---
if (isset($_POST['add_journey'])) {
    $step = trim($_POST['step_number']);
    $title = trim($_POST['title']);
    $points = trim($_POST['points']); // Newline separated
    $points_array = array_filter(array_map('trim', explode("\n", $points)));
    $points_json = json_encode(array_values($points_array));

    if (!empty($title)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO career_journey (step_number, title, points_json) VALUES (?, ?, ?)");
            $stmt->execute([$step, $title, $points_json]);
            $success_msg = "Journey step added successfully!";
        } catch (PDOException $e) { $error_msg = $e->getMessage(); }
    }
}

if (isset($_POST['edit_journey'])) {
    $id = $_POST['journey_id'];
    $step = trim($_POST['step_number']);
    $title = trim($_POST['title']);
    $points = trim($_POST['points']);
    $points_array = array_filter(array_map('trim', explode("\n", $points)));
    $points_json = json_encode(array_values($points_array));

    try {
        $stmt = $pdo->prepare("UPDATE career_journey SET step_number=?, title=?, points_json=? WHERE id=?");
        $stmt->execute([$step, $title, $points_json, $id]);
        $success_msg = "Journey step updated successfully!";
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

if (isset($_GET['delete_journey'])) {
    $id = intval($_GET['delete_journey']);
    $pdo->prepare("DELETE FROM career_journey WHERE id = ?")->execute([$id]);
    header("Location: manage-career-path.php?deleted=1");
    exit();
}

// FETCH DATA
$features = $pdo->query("SELECT * FROM career_features ORDER BY created_at ASC")->fetchAll();
$journey = $pdo->query("SELECT * FROM career_journey ORDER BY step_number ASC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Career Path | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'career_path';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>CAREER PATH MANAGEMENT</h4>
            </header>
            
            <div class="p-3">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ? $success_msg : "Item deleted successfully!"; ?>
                    </div>
                <?php endif; ?>

                <!-- Features Section -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0"><i class="fas fa-star text-warning me-2"></i> WHY CAREER PATH? (Features)</h5>
                    <button class="btn btn-sm btn-premium" data-bs-toggle="modal" data-bs-target="#addFeatureModal"><i class="fas fa-plus me-1"></i> ADD FEATURE</button>
                </div>
                <div class="table-container mb-5">
                    <table class="table table-premium m-0">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($features as $f): ?>
                            <tr>
                                <td><div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="<?php echo $f['icon']; ?>"></i></div></td>
                                <td><b><?php echo htmlspecialchars($f['title']); ?></b></td>
                                <td><small class="text-muted"><?php echo htmlspecialchars($f['description']); ?></small></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal" data-bs-target="#editFeatureModal" 
                                        data-id="<?php echo $f['id']; ?>" data-title="<?php echo htmlspecialchars($f['title']); ?>" 
                                        data-desc="<?php echo htmlspecialchars($f['description']); ?>" data-icon="<?php echo htmlspecialchars($f['icon']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="?delete_feature=<?php echo $f['id']; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Delete feature?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Journey Section -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0"><i class="fas fa-map-signs text-primary me-2"></i> GUIDANCE JOURNEY (Steps)</h5>
                    <button class="btn btn-sm btn-premium" data-bs-toggle="modal" data-bs-target="#addJourneyModal"><i class="fas fa-plus me-1"></i> ADD STEP</button>
                </div>
                <div class="table-container">
                    <table class="table table-premium m-0">
                        <thead>
                            <tr>
                                <th>Step</th>
                                <th>Title</th>
                                <th>Points</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($journey as $j): ?>
                            <?php $pts = json_decode($j['points_json'], true); ?>
                            <tr>
                                <td><span class="badge bg-dark rounded-pill px-3"><?php echo htmlspecialchars($j['step_number']); ?></span></td>
                                <td><b><?php echo htmlspecialchars($j['title']); ?></b></td>
                                <td><small class="text-muted"><?php echo count($pts); ?> points listed</small></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal" data-bs-target="#editJourneyModal" 
                                        data-id="<?php echo $j['id']; ?>" data-step="<?php echo htmlspecialchars($j['step_number']); ?>" 
                                        data-title="<?php echo htmlspecialchars($j['title']); ?>" data-points="<?php echo htmlspecialchars(implode("\n", $pts)); ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="?delete_journey=<?php echo $j['id']; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Delete step?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <!-- Modals for Features -->
    <div class="modal fade" id="addFeatureModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0 shadow">
                <form action="" method="POST">
                    <div class="modal-header border-0 p-4">
                        <h5 class="fw-bold">ADD NEW FEATURE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Feature Title</label>
                            <input type="text" name="title" class="form-control premium-input border" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Description</label>
                            <textarea name="description" class="form-control premium-input border" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Icon Selector</label>
                            <select name="icon" class="form-select premium-input border" required>
                                <option value="" disabled selected>-- Choose Icon --</option>
                                <optgroup label="Academic">
                                    <option value="fas fa-book">Book/Material</option>
                                    <option value="fas fa-flask">Chemistry/Lab</option>
                                    <option value="fas fa-atom">Physics/Science</option>
                                    <option value="fas fa-calculator">Math</option>
                                    <option value="fas fa-dna">Biology</option>
                                    <option value="fas fa-microscope">Research</option>
                                </optgroup>
                                <optgroup label="Features">
                                    <option value="fas fa-laptop-code">Online/Mock Test</option>
                                    <option value="fas fa-clock">Duration/Timing</option>
                                    <option value="fas fa-calendar-alt">Schedule</option>
                                    <option value="fas fa-user-tie">Expert Faculty</option>
                                    <option value="fas fa-hands-helping">Mentorship</option>
                                    <option value="fas fa-chart-line">Reports</option>
                                    <option value="fas fa-bullseye">Goal/Target</option>
                                </optgroup>
                                <optgroup label="Badges">
                                    <option value="fas fa-star">Highlight</option>
                                    <option value="fas fa-trophy">Success</option>
                                    <option value="fas fa-award">Achievement</option>
                                    <option value="fas fa-check-circle">Verified</option>
                                    <option value="fas fa-shield-alt">Secure</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="add_feature" class="btn btn-premium w-100">SAVE FEATURE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editFeatureModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0 shadow">
                <form action="" method="POST">
                    <input type="hidden" name="feature_id" id="edit_f_id">
                    <div class="modal-header border-0 p-4">
                        <h5 class="fw-bold">EDIT FEATURE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Feature Title</label>
                            <input type="text" name="title" id="edit_f_title" class="form-control premium-input border" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Description</label>
                            <textarea name="description" id="edit_f_desc" class="form-control premium-input border" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Icon Selector</label>
                            <select name="icon" id="edit_f_icon" class="form-select premium-input border" required>
                                <optgroup label="Academic">
                                    <option value="fas fa-book">Book/Material</option>
                                    <option value="fas fa-flask">Chemistry/Lab</option>
                                    <option value="fas fa-atom">Physics/Science</option>
                                    <option value="fas fa-calculator">Math</option>
                                    <option value="fas fa-dna">Biology</option>
                                    <option value="fas fa-microscope">Research</option>
                                </optgroup>
                                <optgroup label="Features">
                                    <option value="fas fa-laptop-code">Online/Mock Test</option>
                                    <option value="fas fa-clock">Duration/Timing</option>
                                    <option value="fas fa-calendar-alt">Schedule</option>
                                    <option value="fas fa-user-tie">Expert Faculty</option>
                                    <option value="fas fa-hands-helping">Mentorship</option>
                                    <option value="fas fa-chart-line">Reports</option>
                                    <option value="fas fa-bullseye">Goal/Target</option>
                                </optgroup>
                                <optgroup label="Badges">
                                    <option value="fas fa-star">Highlight</option>
                                    <option value="fas fa-trophy">Success</option>
                                    <option value="fas fa-award">Achievement</option>
                                    <option value="fas fa-check-circle">Verified</option>
                                    <option value="fas fa-shield-alt">Secure</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="edit_feature" class="btn btn-premium w-100">UPDATE FEATURE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modals for Journey -->
    <div class="modal fade" id="addJourneyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0 shadow">
                <form action="" method="POST">
                    <div class="modal-header border-0 p-4">
                        <h5 class="fw-bold">ADD JOURNEY STEP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="row g-3 mb-3">
                            <div class="col-4">
                                <label class="small fw-bold text-muted text-uppercase mb-2">Step #</label>
                                <input type="text" name="step_number" class="form-control premium-input border" placeholder="01" required>
                            </div>
                            <div class="col-8">
                                <label class="small fw-bold text-muted text-uppercase mb-2">Step Title</label>
                                <input type="text" name="title" class="form-control premium-input border" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Points (One per line)</label>
                            <textarea name="points" class="form-control premium-input border" rows="5" placeholder="Enter points..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="add_journey" class="btn btn-premium w-100">SAVE STEP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editJourneyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0 shadow">
                <form action="" method="POST">
                    <input type="hidden" name="journey_id" id="edit_j_id">
                    <div class="modal-header border-0 p-4">
                        <h5 class="fw-bold">EDIT JOURNEY STEP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="row g-3 mb-3">
                            <div class="col-4">
                                <label class="small fw-bold text-muted text-uppercase mb-2">Step #</label>
                                <input type="text" name="step_number" id="edit_j_step" class="form-control premium-input border" required>
                            </div>
                            <div class="col-8">
                                <label class="small fw-bold text-muted text-uppercase mb-2">Step Title</label>
                                <input type="text" name="title" id="edit_j_title" class="form-control premium-input border" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Points (One per line)</label>
                            <textarea name="points" id="edit_j_points" class="form-control premium-input border" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="edit_journey" class="btn btn-premium w-100">UPDATE STEP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Feature Edit Handler
        const featureModal = document.getElementById('editFeatureModal');
        featureModal.addEventListener('show.bs.modal', e => {
            const b = e.relatedTarget;
            document.getElementById('edit_f_id').value = b.getAttribute('data-id');
            document.getElementById('edit_f_title').value = b.getAttribute('data-title');
            document.getElementById('edit_f_desc').value = b.getAttribute('data-desc');
            document.getElementById('edit_f_icon').value = b.getAttribute('data-icon');
        });

        // Journey Edit Handler
        const journeyModal = document.getElementById('editJourneyModal');
        journeyModal.addEventListener('show.bs.modal', e => {
            const b = e.relatedTarget;
            document.getElementById('edit_j_id').value = b.getAttribute('data-id');
            document.getElementById('edit_j_step').value = b.getAttribute('data-step');
            document.getElementById('edit_j_title').value = b.getAttribute('data-title');
            document.getElementById('edit_j_points').value = b.getAttribute('data-points');
        });
    </script>
</body>
</html>
