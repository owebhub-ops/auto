<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">Contacts</h1>
            <div class="text-muted small">Manage all contact messages</div>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($contacts)): ?>
        <div class="alert alert-info">No contacts found.</div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th style="width: 180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $contact): ?>
                                <tr>
                                    <td><?= esc($contact['id']) ?></td>
                                    <td><?= esc($contact['name']) ?></td>
                                    <td><?= esc($contact['email']) ?></td>
                                    <td><?= esc($contact['subject']) ?></td>
                                    <td><?= esc($contact['phone'] ?? '-') ?></td>
                                    <td><?= date('M d, Y H:i', strtotime($contact['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= site_url("admin/contact/{$contact['id']}") ?>" class="btn btn-info btn-sm">View</a>
                                        <?= form_open("admin/contact/delete/{$contact['id']}", ['style' => 'display:inline;']) ?>
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this contact?')">
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