<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">Login</div>
                <div class="card-body">
                    <form action="<?= base_url('login/authenticate'); ?>" method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                        value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                    <p class="mt-2">Don't have an account? <a href="<?= base_url('register'); ?>">Signup</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
