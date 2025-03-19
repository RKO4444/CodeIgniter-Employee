<div class="container mt-4">
    <h2>Your Blogs</h2>
    <a href="<?= base_url('blogs/create'); ?>" class="btn btn-success mb-3">Add Blog</a>

    <div class="list-group">
        <?php foreach ($blogs as $blog): ?>
            <div class="list-group-item">
                <h4><?= $blog->title; ?></h4>
                <p><?= nl2br($blog->content); ?></p>
                <a href="<?= base_url('blogs/edit/'.$blog->id); ?>" class="btn btn-warning">Edit</a>
                <a href="javascript:void(0);" onclick="confirmBlogDelete(<?= $blog->id; ?>);" class="btn btn-danger">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
