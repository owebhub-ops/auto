<?php
$links = $pager->links();
?>

<?php if (! empty($links)): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mb-0">
            <?php if ($pager->hasPrevious()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= esc($pager->getPreviousPageURI()) ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php foreach ($links as $link): ?>
                <li class="page-item <?= ! empty($link['active']) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= esc($link['uri']) ?>"><?= esc($link['title']) ?></a>
                </li>
            <?php endforeach; ?>

            <?php if ($pager->hasNext()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= esc($pager->getNextPageURI()) ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>