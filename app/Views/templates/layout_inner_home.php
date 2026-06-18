<?= view('templates/header', ['pageData' => $pageData]) ?>
<?= view('templates/menu') ?>

<main class="layout_inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> <?= $content ?></div>
        </div>

    </div>
</main>

<?= view('templates/footer') ?>