<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Your Blogs</h4>
                    <a href="<?= base_url('blogs/create'); ?>" class="btn btn-light">+ Add Blog</a>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($blogs as $blog): ?>
                            <div class="list-group-item">
                                <h4><?= $blog->title; ?></h4>
                                <p><?= nl2br($blog->content); ?></p>
                                <a href="<?= base_url('blogs/edit/'.$blog->id); ?>" class="btn btn-warning mr-1">Edit</a>
                                <a href="javascript:void(0);" onclick="confirmBlogDelete(<?= $blog->id; ?>);" class="btn btn-danger">Delete</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>