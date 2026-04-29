<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// 1. Handle Admit Card Upload
if (isset($_POST['upload_admit'])) {
    $student_id = intval($_POST['student_db_id']);
    $file = $_FILES['admit_card'];

    if ($file['error'] == 0) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($ext == 'pdf') {
            $filename = "admit_" . $student_id . "_" . time() . ".pdf";
            $dest_dir = "../uploads/admit_cards/";
            if (!is_dir($dest_dir)) mkdir($dest_dir, 0777, true);

            if (move_uploaded_file($file['tmp_name'], $dest_dir . $filename)) {
                $stmt = $pdo->prepare("UPDATE students SET admit_card = ? WHERE id = ?");
                $stmt->execute([$filename, $student_id]);
                $success_msg = "Admit card uploaded successfully for student.";
            } else { $error_msg = "Server error: Could not save uploaded file."; }
        } else { $error_msg = "Invalid file type. Only PDF files are accepted."; }
    } else { $error_msg = "Upload failed. Please try again."; }
}

// 2. Handle Material Assignment
if (isset($_POST['assign_materials'])) {
    $student_id = intval($_POST['student_db_id']);
    $material_ids = isset($_POST['materials']) ? $_POST['materials'] : [];

    try {
        $pdo->beginTransaction();
        $pdo->prepare("DELETE FROM student_materials WHERE student_id = ?")->execute([$student_id]);
        if (!empty($material_ids)) {
            $stmt = $pdo->prepare("INSERT INTO student_materials (student_id, material_id) VALUES (?, ?)");
            foreach ($material_ids as $m_id) {
                $stmt->execute([$student_id, intval($m_id)]);
            }
        }
        $pdo->commit();
        $success_msg = "Study materials assigned successfully.";
    } catch (Exception $e) {
        $pdo->rollBack();
        $error_msg = "Assignment error: " . $e->getMessage();
    }
}

// 3. Handle Student Delete
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM student_materials WHERE student_id = ?")->execute([$id]);
        $pdo->prepare("DELETE FROM students WHERE id = ?")->execute([$id]);
        header("Location: manage-students.php?deleted=1");
        exit();
    } catch (Exception $e) { $error_msg = "Could not delete student: " . $e->getMessage(); }
}

// 4. Handle Add Student
if (isset($_POST['add_student'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $program = trim($_POST['program']);
    // Generate EK + Year + Random 4 digits
    $student_id = "EK" . date('y') . rand(1000, 9999);
    $password = password_hash('Ekalavya123', PASSWORD_DEFAULT);
    try {
        $stmt = $pdo->prepare("INSERT INTO students (student_id, name, email, phone, program, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$student_id, $name, $email, $phone, $program, $password]);
        $success_msg = "Student Added Successfully. Generated ID: <strong>$student_id</strong>. Default password: 'Ekalavya123'";
    } catch (PDOException $e) { $error_msg = "Error adding student: " . $e->getMessage(); }
}

// 5. Handle Edit Profile
if (isset($_POST['edit_student'])) {
    $id = intval($_POST['student_db_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $program = trim($_POST['program']);
    try {
        $stmt = $pdo->prepare("UPDATE students SET name=?, email=?, phone=?, program=? WHERE id=?");
        $stmt->execute([$name, $email, $phone, $program, $id]);
        $success_msg = "Student Profile Updated Successfully.";
    } catch (PDOException $e) { $error_msg = "Error updating profile: " . $e->getMessage(); }
}

// Fetch all students with material count
$students = $pdo->query("
    SELECT s.*, COUNT(sm.material_id) as material_count
    FROM students s
    LEFT JOIN student_materials sm ON s.id = sm.student_id
    GROUP BY s.id
    ORDER BY s.created_at DESC
")->fetchAll();

// Fetch all available study materials
$all_materials = $pdo->query("SELECT id, title, category FROM study_material ORDER BY category, title")->fetchAll();

// Helper: get assigned material IDs for a student
function getAssigned($pdo, $sid) {
    $stmt = $pdo->prepare("SELECT material_id FROM student_materials WHERE student_id = ?");
    $stmt->execute([$sid]);
    return array_map('strval', $stmt->fetchAll(PDO::FETCH_COLUMN));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
    <style>
        /* Student Card Avatars */
        .student-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1rem; flex-shrink: 0;
            color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* Colour cycle for avatars */
        .av-0 { background: linear-gradient(135deg, #ff5722, #ff8c00); }
        .av-1 { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
        .av-2 { background: linear-gradient(135deg, #0ea5e9, #38bdf8); }
        .av-3 { background: linear-gradient(135deg, #10b981, #34d399); }
        .av-4 { background: linear-gradient(135deg, #f59e0b, #fcd34d); color:#1a1a1a; }

        /* Row hover */
        .table-premium tbody tr {
            transition: background 0.2s ease;
        }
        .table-premium tbody tr:hover {
            background: #f9fbff;
        }

        /* Action buttons */
        .action-btn {
            width: 34px; height: 34px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            transition: all 0.25s ease; font-size: 0.8rem;
            border: 1.5px solid currentColor; background: transparent;
        }
        .action-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.12); }

        /* Search bar */
        #studentSearch {
            border-radius: 50px; padding-left: 2.75rem;
            border: 1.5px solid #eef2f6; background: #f8fafc;
            transition: all 0.25s ease;
        }
        #studentSearch:focus {
            border-color: #ff5722; box-shadow: 0 0 0 3px rgba(255,87,34,0.1);
            background: #fff;
        }
        .search-wrapper { position: relative; }
        .search-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }

        /* Status pills */
        .status-pill {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 50px; font-size: 0.73rem; font-weight: 700; letter-spacing: 0.03em;
        }
        .pill-ok { background: rgba(16,185,129,0.1); color: #10b981; border: 1.5px solid rgba(16,185,129,0.25); }
        .pill-none { background: rgba(148,163,184,0.1); color: #94a3b8; border: 1.5px solid rgba(148,163,184,0.25); }

        /* Program Badge */
        .prog-badge {
            font-size: 0.68rem; font-weight: 800; letter-spacing: 0.04em;
            padding: 3px 10px; border-radius: 6px; text-transform: uppercase;
        }
        .prog-neet { background: #ecfdf5; color: #059669; }
        .prog-jee  { background: #eff6ff; color: #2563eb; }
        .prog-foundation { background: #fdf4ff; color: #9333ea; }

        /* Modal Tab Pills */
        .modal-tabs .nav-link {
            border-radius: 50px; font-size: 0.8rem; font-weight: 600;
            color: #64748b; padding: 6px 18px; background: transparent;
            border: 1.5px solid transparent;
        }
        .modal-tabs .nav-link.active {
            background: linear-gradient(135deg, #ff5722, #ff8c00);
            color: #fff; border-color: transparent;
        }

        /* Material checklist */
        .mat-item {
            display: flex; align-items: center; padding: 10px 14px;
            border-radius: 10px; margin-bottom: 6px; cursor: pointer;
            transition: background 0.2s ease; border: 1.5px solid #eef2f6;
        }
        .mat-item:hover { background: #f8fafc; border-color: #e2e8f0; }
        .mat-item input[type=checkbox] { width: 17px; height: 17px; flex-shrink: 0; accent-color: #ff5722; margin-right: 12px; cursor: pointer; }
        .mat-item label { cursor: pointer; flex: 1; margin: 0; font-size: 0.85rem; font-weight: 500; }

        /* Stats strip */
        .stats-strip { background: #fff; border-radius: 16px; padding: 1.25rem 1.75rem; border: 1px solid #eef2f6; }

        /* Admit upload zone */
        .upload-zone {
            border: 2px dashed #e2e8f0; border-radius: 14px;
            padding: 22px; text-align: center;
            transition: all 0.25s ease; background: #f8fafc;
        }
        .upload-zone:hover { border-color: #ff5722; background: rgba(255,87,34,0.03); }
    </style>
</head>
<body>

<div class="row g-0 overflow-hidden" style="min-height: 100vh;">
    <div class="col-auto">
        <?php $current_page = 'students'; include 'includes/sidebar.php'; ?>
    </div>

    <div class="col admin-main">
        <header class="admin-header">
            <div>
                <h4>STUDENT MANAGEMENT</h4>
                <p class="small text-muted mb-0 mt-1">Admit cards, study material assignments and credentials</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge rounded-pill px-3 py-2" style="background: linear-gradient(135deg,#ff5722,#ff8c00); font-size: 0.8rem;">
                    <i class="fas fa-users me-1"></i> <?php echo count($students); ?> Registered
                </span>
                <button class="btn btn-dark btn-sm rounded-pill px-3 py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="fas fa-plus me-1"></i> Add Student
                </button>
            </div>
        </header>

        <!-- Alerts -->
        <?php if ($success_msg || isset($_GET['deleted'])): ?>
        <div class="alert border-0 rounded-4 mb-4 d-flex align-items-center gap-3" style="background: rgba(16,185,129,0.08); color: #059669;">
            <i class="fas fa-check-circle fa-lg"></i>
            <span class="fw-semibold"><?php echo $success_msg ?: 'Student record removed successfully.'; ?></span>
        </div>
        <?php endif; ?>
        <?php if ($error_msg): ?>
        <div class="alert border-0 rounded-4 mb-4 d-flex align-items-center gap-3" style="background: rgba(239,68,68,0.08); color: #dc2626;">
            <i class="fas fa-exclamation-circle fa-lg"></i>
            <span class="fw-semibold"><?php echo $error_msg; ?></span>
        </div>
        <?php endif; ?>

        <!-- Top Stats Strip + Search -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stats-strip text-center">
                    <div class="h3 fw-black mb-0" style="color:#ff5722;"><?php echo count($students); ?></div>
                    <div class="very-small text-muted text-uppercase fw-bold mt-1">Total Students</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-strip text-center">
                    <div class="h3 fw-black mb-0 text-success"><?php echo count(array_filter($students, fn($s) => !empty($s['admit_card']))); ?></div>
                    <div class="very-small text-muted text-uppercase fw-bold mt-1">Admit Cards Issued</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-strip text-center">
                    <div class="h3 fw-black mb-0 text-warning"><?php echo count(array_filter($students, fn($s) => empty($s['admit_card']))); ?></div>
                    <div class="very-small text-muted text-uppercase fw-bold mt-1">Pending Admit Cards</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-strip text-center">
                    <div class="h3 fw-black mb-0 text-info"><?php echo count($all_materials); ?></div>
                    <div class="very-small text-muted text-uppercase fw-bold mt-1">Available Materials</div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-container">
            <!-- Table Header with Search -->
            <div class="d-flex align-items-center justify-content-between p-4 border-bottom" style="border-color: #f1f5f9!important;">
                <h6 class="fw-black mb-0 text-dark">STUDENT REGISTRY</h6>
                <div class="search-wrapper" style="width: 300px;">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="studentSearch" class="form-control" placeholder="Search by name, ID, or program...">
                </div>
            </div>

            <table class="table table-premium table-hover m-0" id="studentTable">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Contact</th>
                        <th>ID & Program</th>
                        <th>Admit Card</th>
                        <th>Materials</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($students): ?>
                        <?php foreach ($students as $i => $s): ?>
                        <?php
                            $progClass = 'prog-foundation';
                            if (stripos($s['program'], 'neet') !== false) $progClass = 'prog-neet';
                            elseif (stripos($s['program'], 'jee') !== false || stripos($s['program'], 'iit') !== false) $progClass = 'prog-jee';
                            $avClass = 'av-' . ($i % 5);
                            $assigned = getAssigned($pdo, $s['id']);
                        ?>
                        <tr class="student-row">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="student-avatar <?php echo $avClass; ?>"><?php echo strtoupper(substr($s['name'], 0, 1)); ?></div>
                                    <div>
                                        <b class="text-dark d-block"><?php echo htmlspecialchars($s['name']); ?></b>
                                        <span class="small text-muted"><?php echo htmlspecialchars($s['email']); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="tel:<?php echo $s['phone']; ?>" class="text-dark small text-decoration-none">
                                        <i class="fas fa-phone-alt text-muted me-1" style="font-size:0.7rem;"></i><?php echo htmlspecialchars($s['phone']); ?>
                                    </a>
                                    <a href="https://wa.me/91<?php echo preg_replace('/\D/','',$s['phone']); ?>" target="_blank" class="action-btn text-success" style="width:28px;height:28px;font-size:0.7rem;" title="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-dark text-white rounded-2 px-2 py-1 mb-1" style="font-size:0.72rem;font-weight:700;letter-spacing:.04em;"><?php echo htmlspecialchars($s['student_id']); ?></span>
                                <div><span class="prog-badge <?php echo $progClass; ?>"><?php echo htmlspecialchars($s['program']); ?></span></div>
                            </td>
                            <td>
                                <?php if (!empty($s['admit_card'])): ?>
                                    <a href="../uploads/admit_cards/<?php echo $s['admit_card']; ?>" target="_blank" class="status-pill pill-ok text-decoration-none">
                                        <i class="fas fa-check-circle"></i> Issued
                                    </a>
                                <?php else: ?>
                                    <span class="status-pill pill-none"><i class="fas fa-clock"></i> Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $mc = intval($s['material_count']); ?>
                                <span class="status-pill <?php echo $mc > 0 ? 'pill-ok' : 'pill-none'; ?>">
                                    <i class="fas fa-book-open"></i> <?php echo $mc; ?> assigned
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn-manage action-btn text-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#manageStudentModal"
                                            data-id="<?php echo $s['id']; ?>"
                                            data-name="<?php echo htmlspecialchars($s['name']); ?>"
                                            data-email="<?php echo htmlspecialchars($s['email']); ?>"
                                            data-phone="<?php echo htmlspecialchars($s['phone']); ?>"
                                            data-sid="<?php echo htmlspecialchars($s['student_id']); ?>"
                                            data-program="<?php echo htmlspecialchars($s['program']); ?>"
                                            data-admit="<?php echo htmlspecialchars($s['admit_card'] ?? ''); ?>"
                                            data-assigned='<?php echo json_encode($assigned); ?>'
                                            title="Manage Student">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <a href="?delete_id=<?php echo $s['id']; ?>"
                                       class="action-btn text-danger"
                                       onclick="return confirm('Permanently delete <?php echo htmlspecialchars($s['name']); ?>? This cannot be undone.')"
                                       title="Delete Student">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-6 text-muted">
                                <i class="fas fa-user-slash fa-3x mb-3 d-block opacity-25"></i>
                                No students registered yet.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
    </div>
</div>

<!-- MANAGE STUDENT MODAL -->
<div class="modal fade" id="manageStudentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">

            <!-- Modal Header -->
            <div class="modal-header border-0 px-4 pt-4 pb-3" style="background:#f8fafc;">
                <div>
                    <h5 class="modal-title fw-black mb-0">
                        <span id="modal_student_name" class="text-dark"></span>
                    </h5>
                    <p class="small text-muted mb-0 mt-1">
                        <span class="badge bg-dark rounded-2 me-2" id="modal_sid" style="font-size:.7rem;"></span>
                        <span id="modal_program" class="prog-badge prog-neet"></span>
                    </p>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>

            <!-- Tabs -->
            <div class="px-4 pt-2 pb-0" style="background:#f8fafc; border-bottom: 1px solid #eef2f6;">
                <ul class="nav modal-tabs gap-2 pb-2" id="studentModalTabs">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-profile">
                            <i class="fas fa-user-edit me-2"></i> Profile
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-admit">
                            <i class="fas fa-id-card me-2"></i> Admit Card
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-materials">
                            <i class="fas fa-book-open me-2"></i> Study Materials
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="modal-body p-4">
                <div class="tab-content">

                    <!-- TAB 0: EDIT PROFILE -->
                    <div class="tab-pane fade show active" id="tab-profile">
                        <form action="manage-students.php" method="POST">
                            <input type="hidden" name="student_db_id" class="student_id_input">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="small fw-bold text-muted mb-1">Full Name</label>
                                    <input type="text" name="name" id="edit_name" class="form-control rounded-3" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="small fw-bold text-muted mb-1">Email Address</label>
                                    <input type="email" name="email" id="edit_email" class="form-control rounded-3" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="small fw-bold text-muted mb-1">Phone Number</label>
                                    <input type="text" name="phone" id="edit_phone" class="form-control rounded-3" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="small fw-bold text-muted mb-1">Academic Program</label>
                                    <select name="program" id="edit_program" class="form-select rounded-3" required>
                                        <option value="NEET">NEET</option>
                                        <option value="IIT-JEE">IIT-JEE</option>
                                        <option value="School Prep (Class 7th-12th)">School Prep (Class 7th-12th)</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="edit_student" class="btn btn-premium text-white w-100 py-3 rounded-3">
                                <i class="fas fa-save me-2"></i> Update Profile details
                            </button>
                        </form>
                    </div>

                    <!-- TAB 1: ADMIT CARD -->
                    <div class="tab-pane fade" id="tab-admit">
                        <div id="admit_status_box" class="mb-4"></div>
                        <form action="manage-students.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="student_db_id" class="student_id_input">
                            <div class="upload-zone mb-3">
                                <i class="fas fa-file-pdf fa-2x text-danger mb-2 d-block"></i>
                                <p class="small fw-bold mb-1">Upload Admit Card (PDF only)</p>
                                <input type="file" name="admit_card" class="form-control form-control-sm mt-2" accept=".pdf" required style="max-width:300px; margin:0 auto;">
                            </div>
                            <button type="submit" name="upload_admit" class="btn btn-premium text-white w-100 py-3 rounded-3">
                                <i class="fas fa-upload me-2"></i> Upload & Publish Admit Card
                            </button>
                        </form>
                    </div>

                    <!-- TAB 2: STUDY MATERIALS -->
                    <div class="tab-pane fade" id="tab-materials">
                        <form action="manage-students.php" method="POST">
                            <input type="hidden" name="student_db_id" class="student_id_input">
                            <p class="small text-muted mb-3 fw-semibold">Select materials to assign. Previously assigned materials are pre-checked.</p>
                            <div class="material-assignment-scroll overflow-auto pe-1" style="max-height: 320px;">
                                <?php if ($all_materials): ?>
                                    <?php $last_cat = ''; ?>
                                    <?php foreach ($all_materials as $mat): ?>
                                        <?php if ($mat['category'] !== $last_cat): ?>
                                            <div class="small text-muted fw-bold text-uppercase mb-2 mt-3" style="font-size:0.68rem;letter-spacing:.06em;"><?php echo htmlspecialchars($mat['category']); ?></div>
                                            <?php $last_cat = $mat['category']; ?>
                                        <?php endif; ?>
                                        <div class="mat-item">
                                            <input type="checkbox" name="materials[]" value="<?php echo $mat['id']; ?>" class="material-checkbox" id="mat_<?php echo $mat['id']; ?>">
                                            <label for="mat_<?php echo $mat['id']; ?>"><?php echo htmlspecialchars($mat['title']); ?></label>
                                            <span class="badge bg-light text-muted" style="font-size:.68rem;"><?php echo htmlspecialchars($mat['type'] ?? 'PDF'); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-2x mb-2 d-block opacity-25"></i>
                                        No study materials uploaded yet.
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mt-4 pt-3 border-top">
                                <button type="submit" name="assign_materials" class="btn btn-premium text-white w-100 py-3 rounded-3">
                                    <i class="fas fa-save me-2"></i> Save Material Assignments
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD STUDENT MODAL -->
<div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <div class="modal-header border-0 px-4 pt-4 pb-3" style="background:#f8fafc; border-bottom: 1px solid #eef2f6!important;">
                <h5 class="modal-title fw-black mb-0">REGISTER NEW STUDENT</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="manage-students.php" method="POST">
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="small fw-bold text-muted mb-1">Full Name</label>
                            <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Rahul Kumar">
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-muted mb-1">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-3" required placeholder="name@example.com">
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-muted mb-1">Phone Number</label>
                            <input type="text" name="phone" class="form-control rounded-3" required placeholder="10-digit number">
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-muted mb-1">Academic Program</label>
                            <select name="program" class="form-select rounded-3" required>
                                <option value="NEET">NEET</option>
                                <option value="IIT-JEE">IIT-JEE</option>
                                <option value="School Prep (Class 7th-12th)">School Prep (Class 7th-12th)</option>
                            </select>
                        </div>
                    </div>
                    <div class="alert alert-info py-2 px-3 small border-0 d-flex align-items-center gap-2 mb-3">
                        <i class="fas fa-info-circle"></i>
                        A unique EKID and default password will be auto-generated.
                    </div>
                    <button type="submit" name="add_student" class="btn btn-dark w-100 py-3 rounded-3 fw-bold tracking-wide">
                        <i class="fas fa-plus-circle me-2"></i> Register Student
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ---------- Modal population ----------
const manageModal = document.getElementById('manageStudentModal');
manageModal.addEventListener('show.bs.modal', event => {
    const btn = event.relatedTarget;
    const sid   = btn.getAttribute('data-id');
    const name  = btn.getAttribute('data-name');
    const email = btn.getAttribute('data-email');
    const phone = btn.getAttribute('data-phone');
    const stuId = btn.getAttribute('data-sid');
    const prog  = btn.getAttribute('data-program');
    const admit = btn.getAttribute('data-admit');
    const assigned = JSON.parse(btn.getAttribute('data-assigned'));

    // Header
    document.getElementById('modal_student_name').textContent = name;
    document.getElementById('modal_sid').textContent = stuId;
    const progEl = document.getElementById('modal_program');
    progEl.textContent = prog;
    progEl.className = 'prog-badge ' + (
        prog.toLowerCase().includes('neet') ? 'prog-neet' :
        (prog.toLowerCase().includes('jee') || prog.toLowerCase().includes('iit')) ? 'prog-jee' :
        'prog-foundation'
    );

    // Populate Edit Profile fields
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_phone').value = phone;
    document.getElementById('edit_program').value = prog;

    // Student ID into all forms
    document.querySelectorAll('.student_id_input').forEach(el => el.value = sid);

    // Admit card status
    const box = document.getElementById('admit_status_box');
    if (admit) {
        box.innerHTML = `
            <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background:rgba(16,185,129,.08); border:1.5px solid rgba(16,185,129,.2);">
                <span class="small fw-semibold text-success"><i class="fas fa-file-pdf me-2"></i> Admit card already uploaded</span>
                <a href="../uploads/admit_cards/${admit}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                    <i class="fas fa-eye me-1"></i> View PDF
                </a>
            </div>`;
    } else {
        box.innerHTML = `
            <div class="d-flex align-items-center gap-2 p-3 rounded-3" style="background:rgba(245,158,11,.08); border:1.5px solid rgba(245,158,11,.2);">
                <i class="fas fa-exclamation-triangle text-warning"></i>
                <span class="small fw-semibold text-warning">No admit card uploaded yet for this student.</span>
            </div>`;
    }

    // Material checkboxes
    document.querySelectorAll('.material-checkbox').forEach(cb => {
        cb.checked = assigned.includes(cb.value);
    });

    // Reset tabs to first tab
    const firstTab = document.querySelector('#studentModalTabs .nav-link');
    if (firstTab) new bootstrap.Tab(firstTab).show();
});

// ---------- Live search ----------
document.getElementById('studentSearch').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#studentTable tbody .student-row').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
</body>
</html>
