<div class="container py-4">
    <h1 class="h4 mb-4">Create Lesson for <?= esc($course['title']) ?></h1>

    <form action="<?= site_url("admin/course/{$course['course_id']}/lesson/store") ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= old('title') ?>">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="10"><?= old('content') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="order_index" class="form-label">Order Index</label>
            <input type="number" name="order_index" id="order_index" class="form-control" value="<?= old('order_index', 1) ?>">
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
        <a href="<?= site_url("admin/course/{$course['course_id']}/lesson") ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>


<script src="<?= base_url('public/assets/vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script>
    tinymce.init({
  selector: 'textarea#content',
  license_key: 'gpl',
  height: 500,
  plugins: [
    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
    'insertdatetime', 'media', 'table', 'help', 'wordcount',
    /* Premium plugins for demo purposes only */
    'mediaembed',
  ],
  toolbar: 'undo redo | blocks | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});
</script>