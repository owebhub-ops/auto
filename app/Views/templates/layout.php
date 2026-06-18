<?= view('templates/header', ['pageData' => $pageData]) ?>
<?= view('templates/menu') ?>

<main class="mainHome">    
        <?= $content ?>
</main>

<?= view('templates/footer') ?>
