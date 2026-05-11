<?php $courses = $courses ?? []; ?>

<div class="container-fluid py-4">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1 fw-bold">My Courses</h1>
            <p class="text-muted mb-0">Continue your learning journey (<?= count($courses) ?> enrolled)</p>
        </div>
        <a href="<?= base_url('courses') ?>" class="btn btn-outline-primary mt-2 mt-sm-0">
            <i class="bi bi-plus-circle me-2"></i>Browse Courses
        </a>
    </div>

    <?php if (empty($courses)): ?>
    <!-- Empty State -->
    <div class="text-center py-8">
        <div class="mb-5">
            <i class="bi bi-book display-1 text-muted opacity-25"></i>
        </div>
        <h3 class="fw-bold text-muted mb-3">No courses enrolled yet</h3>
        <p class="text-muted mb-4">Get started by browsing our course catalog</p>
        <a href="<?= base_url('courses') ?>" class="btn btn-primary btn-lg">
            <i class="bi bi-search me-2"></i>Find Courses
        </a>
    </div>
    <?php else: ?>
    <!-- Courses Grid -->
    <div class="row g-4">
        <?php foreach ($courses as $course): ?>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100 shadow-sm border-0 hover-lift">
                <?php if ($course['image']): ?>
                <img src="<?= base_url('uploads/courses/' . $course['image']) ?>" 
                     class="card-img-top" alt="<?= esc($course['title']) ?>" style="height: 200px; object-fit: cover;">
                <?php else: ?>
                <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                    <i class="bi bi-laptop display-4 opacity-75"></i>
                </div>
                <?php endif; ?>
                
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-bold mb-2 line-clamp-2"><?= esc($course['title']) ?></h6>
                    <div class="flex-grow-1">
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: <?= $course['progress'] ?>%"></div>
                        </div>
                        <div class="small text-muted mb-2">
                            <?= $course['progress'] ?>% Complete
                        </div>
                    </div>
                    <div class="mt-auto">
                        <a href="<?= base_url("course/{$course['course_id']}") ?>" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-play-circle me-1"></i>Continue
                        </a>
                        <div class="d-flex justify-content-between small text-muted">
                            <span>Enrolled: <?= date('M d', strtotime($course['enrolled_at'])) ?></span>
                            <?php if ($course['progress'] >= 90): ?>
                            <span class="badge bg-success">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<style>
.hover-lift {
    transition: all 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>