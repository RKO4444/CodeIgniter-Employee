<div class="container mt-4">
    <h2>Add Blog</h2>
    <form action="<?= base_url('blogs/store'); ?>" method="POST">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
        value="<?= $this->security->get_csrf_hash(); ?>">
        <div class="form-group">
            <label>Blog Title</label>
            <input type="text" name="title" class="form-control">
            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['title'])): ?>
                <small class="text-danger"><?= $errors['title']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Blog Content</label>
            <textarea name="content" class="form-control" id="content" rows="4"></textarea>
            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['content'])): ?>
                <small class="text-danger"><?= $errors['content']; ?></small>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-success">Save Blog</button>
    </form>
</div>
