<div class="container py-4">
    <h1 class="h4 mb-4">Create Course</h1>

    <form action="<?= site_url('admin/course/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= old('title') ?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5"><?= old('description') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" class="form-control" value="<?= old('category') ?>">
        </div>

        <div class="mb-3">
            <label for="seo_title" class="form-label">SEO Title</label>
            <input type="text" name="seo_title" id="seo_title" class="form-control" value="<?= old('seo_title') ?>">
        </div>

        <div class="mb-3">
            <label for="seo_description" class="form-label">SEO Description</label>
            <textarea name="seo_description" id="seo_description" class="form-control" rows="3"><?= old('seo_description') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="seo_keywords" class="form-label">SEO Keywords</label>
            <textarea name="seo_keywords" id="seo_keywords" class="form-control" rows="3"><?= old('seo_keywords') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="<?= old('slug') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?= site_url('admin/course') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>