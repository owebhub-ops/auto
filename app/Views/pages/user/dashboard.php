<?php 
// ✅ SAFE ACCESS - Prevent undefined key errors
$stats = $stats ?? [];
$total_courses = $stats['total_courses'] ?? 0;
$completed_courses = $stats['completed_courses'] ?? 0;
$in_progress = $stats['in_progress'] ?? 0;
$completion_rate = $stats['completion_rate'] ?? 0;
$recent_courses = $recent_courses ?? [];
?>

<div class="container-fluid py-4">
    <!-- Welcome Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <img src="<?= esc(session()->get('user_avatar') ?: base_url('public/assets/img/avatar-default.png')) ?>" 
                     class="rounded-circle me-4 shadow-lg" width="80" height="80" alt="Avatar">
                <div>
                    <h1 class="mb-1 fw-bold">Welcome back, <?= esc(session()->get('user_name') ?: 'User') ?>!</h1>
                    <p class="text-muted mb-0">Here's what's happening with your learning</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Overview - ✅ SAFE VALUES -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center bg-primary text-white">
                <div class="card-body py-4">
                    <i class="bi bi-journal-bookmark-fill display-4 opacity-75 mb-3"></i>
                    <div class="h2 fw-bold mb-1"><?= $total_courses ?></div>  <!-- ✅ SAFE -->
                    <div class="h6 mb-0">Total Courses</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center bg-success text-white">
                <div class="card-body py-4">
                    <i class="bi bi-trophy-fill display-4 opacity-75 mb-3"></i>
                    <div class="h2 fw-bold mb-1"><?= $completed_courses ?></div>  <!-- ✅ SAFE -->
                    <div class="h6 mb-0">Completed</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center bg-warning text-white">
                <div class="card-body py-4">
                    <i class="bi bi-clock-fill display-4 opacity-75 mb-3"></i>
                    <div class="h2 fw-bold mb-1"><?= $in_progress ?></div>  <!-- ✅ SAFE -->
                    <div class="h6 mb-0">In Progress</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center bg-info text-white">
                <div class="card-body py-4">
                    <div class="progress mb-3 mx-auto" style="width: 80%; height: 20px;">
                        <div class="progress-bar bg-light" style="width: <?= $completion_rate ?>%"></div>  <!-- ✅ SAFE -->
                    </div>
                    <div class="h4 fw-bold"><?= $completion_rate ?>%</div>  <!-- ✅ SAFE -->
                    <div class="h6 mb-0">Completion Rate</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title mb-3">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="<?= base_url('courses/my-courses') ?>" class="card border-0 shadow-sm h-100 text-decoration-none hover-lift">
                                <div class="card-body text-center py-4">
                                    <i class="bi bi-book display-4 text-primary mb-3"></i>
                                    <h6 class="fw-bold mb-1">My Courses</h6>
                                    <p class="text-muted small mb-0">Continue learning</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url('quizzes') ?>" class="card border-0 shadow-sm h-100 text-decoration-none hover-lift">
                                <div class="card-body text-center py-4">
                                    <i class="bi bi-lightning display-4 text-success mb-3"></i>
                                    <h6 class="fw-bold mb-1">Practice Quizzes</h6>
                                    <p class="text-muted small mb-0">Test your knowledge</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Courses - ✅ SAFE ARRAY ACCESS -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-0">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-clock-history me-2"></i>Recent Courses
                    </h6>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($recent_courses)): ?>
                        <?php foreach ($recent_courses as $course): ?>
                        <a href="<?= base_url("course/{$course['course_id']}") ?>" class="list-group-item list-group-item-action border-0 px-3 py-3 hover-light">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                        <i class="bi bi-play-circle text-primary fs-5"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-bold text-truncate" style="max-width: 200px;">
                                        <?= esc($course['title'] ?? 'Untitled Course') ?>
                                    </div>
                                    <small class="text-muted">
                                        Progress: <?= ($course['progress'] ?? 0) ?>%
                                    </small>
                                </div>
                                <div class="progress flex-shrink-0" style="width: 60px; height: 8px;">
                                    <div class="progress-bar" style="width: <?= ($course['progress'] ?? 0) ?>%"></div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-inbox display-4 opacity-25 mb-3"></i>
                            <p class="mb-0">No recent courses</p>
                            <a href="<?= base_url('courses') ?>" class="btn btn-outline-primary btn-sm mt-2">Browse Courses</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: all 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}
.hover-light:hover {
    background-color: rgba(0,0,0,0.025) !important;
}
</style>