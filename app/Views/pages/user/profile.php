<?php
// ✅ SAFE ACCESS
$user = $user ?? [];
$stats = $stats ?? [];
$total_courses = $stats['total_courses'] ?? 0;
$completed_courses = $stats['completed_courses'] ?? 0;
$in_progress = $stats['in_progress'] ?? 0;
$completion_rate = $stats['completion_rate'] ?? 0;
$enrollments_count = $stats['total_courses'] ?? 0;
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-xl-9 col-lg-10">
            <!-- Hero Profile Section -->
            <!-- 🎨 Clean Modern Profile Hero - Professional & Elegant -->
            <div class="profile-hero-clean position-relative rounded-4 shadow-xl mb-5 overflow-hidden">
                <!-- Subtle Hero Background -->
                <div class="hero-bg-clean"></div>

                <div class="container-fluid px-4 px-lg-0">
                    <div class="row align-items-center min-vh-60">
                        <div class="col-lg-4 col-md-5 text-center text-md-start">
                            <!-- Enhanced Avatar -->
                            <div class="avatar-wrapper position-relative mx-auto mx-md-0 mb-4 mb-md-0">
                                <img src="<?= esc(session()->get('user_avatar') ?: base_url('public/assets/img/avatar-default.png')) ?>"
                                    class="avatar-clean rounded-4 shadow-lg"
                                    style="width: 140px; height: 140px; object-fit: cover;" alt="Profile Photo"
                                    loading="lazy">
                                <div class="avatar-status bg-success"></div>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-7 ps-lg-5">
                            <div class="hero-content-clean ps-lg-4">
                                <!-- Name & Title -->
                                <h1 class="h2 h1-lg fw-bold mb-3 text-white lh-sm">
                                    <?= esc($user['name'] ?? session()->get('user_name') ?: 'User') ?></h1>

                                <!-- Email -->
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-envelope text-white-75 fs-5 me-3"></i>
                                    <span
                                        class="text-white-90 fs-6 fw-medium"><?= esc($user['email'] ?? session()->get('user_email') ?: 'No email set') ?></span>
                                </div>

                                <!-- Primary Stat Badge -->
                                <div class="stat-primary position-relative">
                                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-3 p-3 px-lg-4">
                                        <div class="row align-items-center g-3">
                                            <div class="col-auto">
                                                <i class="bi bi-book-half text-primary fs-3"></i>
                                            </div>
                                            <div class="col">
                                                <div class="h4 fw-bold text-white mb-1">
                                                    <?= number_format($total_courses) ?></div>
                                                <small class="text-white-75 fw-semibold">Courses Enrolled</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid - Professional Glassmorphism -->
            <div class="row g-4 mb-5 justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card glass-effect h-100 text-center p-4 rounded-3 shadow-lg border-0">
                        <div class="stat-icon mb-3">
                            <i class="bi bi-journal-bookmark-fill display-5 text-primary"></i>
                        </div>
                        <div class="h2 fw-bold mb-1 text-primary"><?= $total_courses ?></div>
                        <div class="text-muted fw-semibold">Total Courses</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card glass-effect h-100 text-center p-4 rounded-3 shadow-lg border-0">
                        <div class="stat-icon mb-3">
                            <i class="bi bi-check-circle-fill display-5 text-success"></i>
                        </div>
                        <div class="h2 fw-bold mb-1 text-success"><?= $completed_courses ?></div>
                        <div class="text-muted fw-semibold">Completed</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card glass-effect h-100 text-center p-4 rounded-3 shadow-lg border-0">
                        <div class="stat-icon mb-3">
                            <i class="bi bi-clock-fill display-5 text-warning"></i>
                        </div>
                        <div class="h2 fw-bold mb-1 text-warning"><?= $in_progress ?></div>
                        <div class="text-muted fw-semibold">In Progress</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card glass-effect h-100 text-center p-4 rounded-3 shadow-lg border-0">
                        <div class="progress mb-3 mx-auto rounded-pill"
                            style="width: 85%; height: 12px; background: rgba(255,255,255,0.2);">
                            <div class="progress-bar bg-gradient-success rounded-pill shadow-sm"
                                style="width: <?= $completion_rate ?>%"></div>
                        </div>
                        <div class="h3 fw-bold mb-0 text-gradient"><?= $completion_rate ?>%</div>
                        <div class="text-muted fw-semibold">Completion Rate</div>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="card border-0 shadow-xl rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-light border-0 py-4 px-5">
                    <h3 class="h4 mb-0 fw-bold text-dark">
                        <i class="bi bi-person-badge-fill me-2 text-primary"></i>
                        Account Details
                    </h3>
                </div>
                <div class="card-body p-5">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div
                                class="info-item p-4 border-start border-4 border-primary rounded-end shadow-sm bg-white">
                                <div class="info-icon me-3">
                                    <i class="bi bi-person-circle fs-3 text-primary"></i>
                                </div>
                                <div>
                                    <label class="form-label fw-bold text-muted mb-1 small">Full Name</label>
                                    <div class="h5 fw-bold text-dark">
                                        <?= esc($user['name'] ?? session()->get('user_name') ?: 'User') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div
                                class="info-item p-4 border-start border-4 border-success rounded-end shadow-sm bg-white">
                                <div class="info-icon me-3">
                                    <i class="bi bi-envelope fs-3 text-success"></i>
                                </div>
                                <div>
                                    <label class="form-label fw-bold text-muted mb-1 small">Email Address</label>
                                    <div class="h5 fw-bold text-dark">
                                        <?= esc($user['email'] ?? session()->get('user_email') ?: 'No email set') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-item p-4 border-start border-4 border-info rounded-end shadow-sm bg-white">
                                <div class="info-icon me-3">
                                    <i class="bi bi-calendar-check fs-3 text-info"></i>
                                </div>
                                <div>
                                    <label class="form-label fw-bold text-muted mb-1 small">Date Joined</label>
                                    <div class="h5 fw-bold text-dark">
                                        <?= isset($user['created_at']) ? date('M d, Y', strtotime($user['created_at'])) : 'Recently' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div
                                class="info-item p-4 border-start border-4 border-warning rounded-end shadow-sm bg-white">
                                <div class="info-icon me-3">
                                    <i class="bi bi-award fs-3 text-warning"></i>
                                </div>
                                <div>
                                    <label class="form-label fw-bold text-muted mb-1 small">Total Enrollments</label>
                                    <div class="h5 fw-bold text-dark"><?= $enrollments_count ?></div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-5 pt-5">
                <div class="row justify-content-center g-3">
                    <div class="col-auto">
                        <a href="<?= base_url('courses/my-courses') ?>"
                            class="btn btn-primary btn-lg px-5 shadow-lg lift-hover">
                            <i class="bi bi-play-circle me-2"></i>Continue Learning
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('courses') ?>"
                            class="btn btn-outline-primary btn-lg px-5 shadow lift-hover">
                            <i class="bi bi-plus-circle me-2"></i>Browse Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Professional Glassmorphism */
    .profile-hero {
        height: 420px;
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        position: relative;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-effect:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        background: rgba(255, 255, 255, 0.98);
    }

    .info-item {
        transition: all 0.3s ease;
        cursor: default;
    }

    .info-item:hover {
        transform: translateX(8px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .fw-mono {
        font-family: 'SF Mono', 'Monaco', monospace;
        font-size: 0.9em;
    }

    .text-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .bg-gradient-light {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .lift-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .lift-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .profile-hero {
            height: 360px;
        }

        .avatar-container img {
            width: 120px;
            height: 120px;
        }
    }

    /* 🧼 Clean Professional Hero Styles */
    .profile-hero-clean {
        height: 320px;
        background: linear-gradient(135deg,
                #1e293b 0%,
                #334155 50%,
                #475569 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
        position: relative;
        overflow: hidden;
    }

    .hero-bg-clean {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(ellipse 60% 30% at 20% 40%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
            radial-gradient(ellipse 40% 20% at 80% 70%, rgba(16, 185, 129, 0.12) 0%, transparent 50%);
        z-index: 1;
    }

    .min-vh-60 {
        min-height: 320px;
    }

    /* Avatar Styling */
    .avatar-wrapper {
        position: relative;
        display: inline-block;
        width: 140px;
        height: 140px;
    }

    .avatar-clean {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 4px solid rgba(255, 255, 255, 0.2);
    }

    .avatar-wrapper:hover .avatar-clean {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .avatar-status {
        position: absolute;
        bottom: 8px;
        right: 8px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .avatar-wrapper:hover .avatar-status {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.5);
    }

    /* Content Styling */
    .hero-content-clean {
        position: relative;
        z-index: 3;
    }

    .stat-primary {
        max-width: 320px;
    }

    .bg-opacity-10 {
        background: rgba(255, 255, 255, 0.12) !important;
    }

    .backdrop-blur-sm {
        backdrop-filter: blur(12px);
    }

    .text-white-90 {
        color: rgba(255, 255, 255, 0.92) !important;
    }

    .text-white-75 {
        color: rgba(255, 255, 255, 0.75) !important;
    }

    /* Hover Effects */
    .stat-primary:hover {
        transform: translateY(-4px);
    }

    .stat-primary .row {
        transition: all 0.3s ease;
    }

    .stat-primary:hover .row {
        transform: scale(1.02);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .profile-hero-clean {
            height: 280px;
            text-align: center !important;
        }

        .avatar-wrapper {
            width: 120px;
            height: 120px;
        }

        .avatar-clean {
            width: 120px !important;
            height: 120px !important;
        }

        .hero-content-clean {
            padding-top: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .profile-hero-clean {
            height: 260px;
        }

        .avatar-wrapper {
            width: 110px;
            height: 110px;
        }

        .avatar-clean {
            width: 110px !important;
            height: 110px !important;
        }

        h1 {
            font-size: 1.75rem !important;
        }

        .stat-primary {
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .profile-hero-clean {
            border-radius: 1.5rem;
        }
    }
</style>