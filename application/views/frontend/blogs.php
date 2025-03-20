<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Your Blogs</h4>
                    <a href="<?= base_url('blogs/create'); ?>" class="btn btn-light">+ Add Blog</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($blogs)): ?>
                        <div class="list-group">
                            <?php foreach ($blogs as $blog): ?>
                                <div class="list-group-item">
                                    <h3><?= $blog->title; ?></h4>
                                    <small class="bg-light p-1 my-1 d-block">Posted on: <?= $blog->updated_at; ?></small>
                                    <p><?= $blog->content; ?></p>
                                    <a href="<?= base_url('blogs/edit/'.$blog->id); ?>" class="btn btn-warning btn-sm mr-1">Edit</a>
                                    <a href="javascript:void(0);" onclick="confirmBlogDelete(<?= $blog->id; ?>);" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center">
                            <h5 class="text-muted">No blogs found.</h5>
                            <p class="text-muted">Add your first blog now!</p>
                            <a href="<?= base_url('blogs/create'); ?>" class="btn btn-success">+ Add Your First Blog</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>