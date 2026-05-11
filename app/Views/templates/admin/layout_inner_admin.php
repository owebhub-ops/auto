<?= view('templates/header', ['pageData' => $pageData]) ?>
<?= view('templates/menu') ?>

<main class="py-4 layout_inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                <?= view('templates/left_inner_menu_admin') ?>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12"> <?= $content ?></div>
        </div>

    </div>
</main>

<?= view('templates/footer') ?>