<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">Courses</h1>
            <div class="text-muted small">Manage all courses</div>
        </div>
        <a href="<?= site_url('admin/course/create') ?>" class="btn btn-primary">Add Course</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($courses)): ?>
        <div class="alert alert-info">No courses found.</div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th style="width: 220px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses as $course): ?>
                                <tr>
                                    <td><?= esc($course['course_id']) ?></td>
                                    <td><?= esc($course['title']) ?></td>
                                    <td><?= esc($course['category']) ?></td>
                                    <td><?= esc($course['slug']) ?></td>
                                    <td>
                                        <a href="<?= site_url("admin/course/{$course['course_id']}/lesson") ?>" class="btn btn-info btn-sm">Lessons</a>
                                        <a href="<?= site_url("admin/course/edit/{$course['course_id']}") ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <?= form_open("admin/course/delete/{$course['course_id']}", ['style' => 'display:inline;']) ?>
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">
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

        <?php if ($pager->getPageCount() > 1): ?>
            <nav aria-label="Page navigation" class="mt-4">
                <?= $pager->links('default', 'bootstrap_pagination') ?>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>