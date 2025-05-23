
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5>
                        Add Your Blog
                        <a href="<?php echo base_url('blogs'); ?>" class="btn btn-danger float-right">Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('blogs/store'); ?>" method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                        value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label>Blog Title</label>
                            <input type="text" name="title" class="form-control" value="<?= set_value('title'); ?>">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['title'])): ?>
                                <small class="text-danger" id="error_title"><?= $errors['title']; ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Blog Content</label>
                            <textarea name="content" class="form-control" id="content" rows="4"> <?= set_value('content'); ?> </textarea>
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['content'])): ?>
                                <small class="text-danger" id="error_content"><?= $errors['content']; ?></small>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-success">Save Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  <script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
  <script>CKEDITOR.replace('content');</script>
