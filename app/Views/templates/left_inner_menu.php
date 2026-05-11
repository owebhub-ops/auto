<?php 
// Fix: Initialize the variable if it doesn't exist to prevent the ErrorException
$current_lesson_slug = $current_lesson_slug ?? ''; 
?>

<style>
    /* Professional Sidebar Styling */
    .lesson-sidebar-container { position: sticky; top: 1.5rem; }
    
    .course-brand-card {
        background: #ffffff;
        border: 1px solid #eef2ff;
        border-left: 4px solid #0d6efd;
        border-radius: 1rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .lesson-list-group .list-group-item {
        background: #ffffff;
        border: 1px solid #f1f5f9; 
        border-radius: 0.75rem !important;
        padding: 0.8rem 1rem;
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .lesson-list-group .list-group-item:hover {
        border-color: #0d6efd;
        color: #0f172a;
        background: #fafbff;
    }

    .lesson-list-group .list-group-item.active {
        background: #f0f7ff !important;
        border-color: #0d6efd !important;
        color: #0d6efd !important;
        font-weight: 600;
    }
</style>

<!-- 🖥️ Sidebar (Desktop) -->
<aside class="d-none d-md-block lesson-sidebar-container">
    <div class="course-brand-card">
        <h1 class="course-name h6 fw-bold mb-0 text-dark"><?= esc($course['title']) ?></h1>
    </div>

    <div class="overflow-auto custom-sidebar-scroll pe-2 px-1" style="max-height: calc(100vh - 200px);">
        <?php renderLessonList($lessons, $current_lesson_slug, $course['slug'] ?? 'default'); ?>
    </div>

    <!-- 🚀 SEO High-Value Resource Box (Increases Site Depth for Google) -->
    <div class="mt-4 p-3 bg-light border rounded-4">
        <h6 class="small fw-bold mb-2 text-uppercase text-primary" style="letter-spacing: 1px;">Technical Resources</h6>
        <ul class="list-unstyled mb-0" style="font-size: 0.75rem; color: #475569;">
            <li class="mb-2"><i class="bi bi-terminal me-2"></i><strong>Data Engineering</strong> Documentation</li>
            <li class="mb-2"><i class="bi bi-cloud-check me-2"></i><strong>AWS Architect</strong> Best Practices</li>
            <li><i class="bi bi-cpu me-2"></i><strong>Machine Learning</strong> Implementation</li>
        </ul>
    </div>
</aside>

<!-- 📱 Mobile Navigation -->
<div class="d-md-none sticky-top mobile-course-nav p-3 border-bottom shadow-sm bg-white">
    <button class="btn btn-light border w-100 d-flex align-items-center justify-content-between py-2 rounded-3" 
            type="button" data-bs-toggle="offcanvas" data-bs-target="#lessonMenu">
        <div class="text-start pe-3">
            <small class="d-block text-uppercase fw-bold text-muted mb-1" style="font-size: 0.6rem;">Curriculum</small>
            <span class="text-truncate d-block fw-bold text-dark h6 mb-0"><?= esc($course['title']) ?></span>
        </div>
        <i class="bi bi-list"></i>
    </button>
</div>

<?php
/**
 * Render Lesson List
 */
function renderLessonList($lessons, $currentSlug, $courseSlug) {
    if (!empty($lessons) && is_array($lessons)): ?>
        <nav class="list-group lesson-list-group border-0">
            <?php foreach ($lessons as $item): 
                $isActive = ($currentSlug === $item['slug']);
                $isQuiz = str_contains(strtolower($item['title']), 'quiz');
            ?>
                <a href="<?= site_url("course/" . esc($courseSlug) . "/" . esc($item['slug'])) ?>"
                   class="list-group-item list-group-item-action <?= $isActive ? 'active' : '' ?>">
                    <i class="bi <?= $isQuiz ? 'bi-patch-question' : ($isActive ? 'bi-play-circle-fill' : 'bi-journal-code') ?> me-2"></i>
                    <span class="text-truncate"><?= esc($item['title']) ?></span>
                </a>
            <?php endforeach; ?>
        </nav>
    <?php else: ?>
        <div class="p-4 text-center border rounded-4 bg-light">
            <i class="bi bi-database-exclamation display-6 text-muted d-block mb-2"></i>
            <p class="small text-muted mb-0">Modules are being updated. Check back shortly.</p>
        </div>
    <?php endif;
}
?>
