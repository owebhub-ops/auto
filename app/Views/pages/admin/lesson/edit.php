
<div class="container">
    <h1>Edit Lesson for <?= $course['title'] ?></h1>
    <form action="<?= site_url("/admin/course/{$course['course_id']}/lesson/update/{$lesson['lesson_id']}") ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="<?= $lesson['title'] ?>">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control"><?= $lesson['content'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="order_index">Order Index</label>
            <input type="number" name="order_index" class="form-control" value="<?= $lesson['order_index'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
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