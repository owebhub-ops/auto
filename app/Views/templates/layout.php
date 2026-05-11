<?= view('templates/header', ['pageData' => $pageData]) ?>
<?= view('templates/menu') ?>

<main class="pt-4">    
        <?= $content ?>
</main>

<?= view('templates/footer') ?>
