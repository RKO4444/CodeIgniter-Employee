<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">Login</div>
                <div class="card-body">
                    <form action="<?= base_url('login/authenticate'); ?>" method="POST">
                        <?php if ($this->session->flashdata('login_error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('login_error'); ?>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                        value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?= set_value('password'); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                    <p class="mt-2">Don't have an account? <a href="<?= base_url('register'); ?>">Signup</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
