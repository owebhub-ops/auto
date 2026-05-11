<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">Lessons for <?= esc($course['title']) ?></h1>
            <div class="text-muted small">
                Manage lessons for this course (<?= $pager ? $pager->getTotal('lessons') : 0 ?> total)
            </div>
        </div>
        <a href="<?= site_url("admin/course/{$course['course_id']}/lesson/create") ?>" class="btn btn-primary">
            Add Lesson
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($lessons)): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>No lessons found.
            <a href="<?= site_url("admin/course/{$course['course_id']}/lesson/create") ?>" class="alert-link">
                Create the first lesson
            </a>.
        </div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th>Title</th>
                                <th style="width: 80px;">Order</th>
                                <th style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lessons as $lesson): ?>
                                <tr>
                                    <td><?= esc($lesson['lesson_id']) ?></td>
                                    <td><?= esc($lesson['title']) ?></td>
                                    <td><?= esc($lesson['order_index']) ?></td>
                                    <td>
                                        <a href="<?= site_url("admin/course/{$course['course_id']}/lesson/edit/{$lesson['lesson_id']}") ?>"
                                            class="btn btn-warning btn-sm me-1">Edit</a>

                                        <a href="<?= site_url("course/{$course['slug']}/{$lesson['slug']}") ?>"
                                            class="btn btn-info btn-sm me-1" target="_blank" rel="noopener">
                                            View
                                        </a>

                                        <?= form_open("admin/course/{$course['course_id']}/lesson/delete/{$lesson['lesson_id']}", ['style' => 'display:inline;']) ?>
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure? All student progress will be lost.')">
                                            Delete
                                        </button>
                                        <?= form_close() ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-muted small mt-2">
            Manage lessons (<?= $pager ? $pager->getTotal('lessons') : 0 ?> total, page
            <?= $pager ? $pager->getCurrentPage('lessons') : 1 ?> of <?= $pager ? $pager->getPageCount('lessons') : 1 ?>)
        </div>

        <?php if ($pager && $pager->getPageCount('lessons') > 1): ?>
            <nav aria-label="Page navigation" class="mt-4">
                <?= $pager->links('lessons', 'bootstrap_pagination') ?>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>