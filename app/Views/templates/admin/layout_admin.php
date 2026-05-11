<?= view('templates/admin/header_admin', ['pageData' => $pageData]) ?>
<?= view('templates/admin/menu_admin') ?>

<main class="py-4 layout_inner mt-5">
        <div class="container-fluid">
                <div class="row">
                        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                                <?= view('templates/admin/left_inner_menu_admin') ?>
                        </div>
                        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> <?= $content ?></main>
                </div>

        </div>
</main>
<?= view('templates/admin/footer_admin') ?>