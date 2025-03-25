
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5>
                         Add Employee
                        <a href="<?php echo base_url('employee'); ?>" class="btn btn-danger float-right">Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('employee/store')?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                        value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control" value="<?= set_value('first_name'); ?>">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['first_name'])): ?>
                                <small class="text-danger" id="error_first_name"><?= $errors['first_name']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control" value="<?= set_value('last_name'); ?>">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['last_name'])): ?>
                                <small class="text-danger" id="error_last_name"><?= $errors['last_name']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Profile Photo</label>
                            <input type="file" name="profile_photo" class="form-control" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" name="dob" class="form-control" value="<?= set_value('dob'); ?>">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['dob'])): ?>
                                <small class="text-danger" id="error_dob"><?= $errors['dob']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['email'])): ?>
                                <small class="text-danger" id="error_email"><?= $errors['email']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Phone<span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control" pattern="[0-9]{10}" title="Enter 10-digit phone number" placeholder="Enter your 10-digit phone number" value="<?= set_value('phone'); ?>">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['phone'])): ?>
                                <small class="text-danger" id="error_phone"><?= $errors['phone']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Department<span class="text-danger">*</span></label>
                            <input type="text" name="department" class="form-control" value="<?= set_value('department'); ?>">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['department'])): ?>
                                <small class="text-danger" id="error_department"><?= $errors['department']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">State<span class="text-danger">*</span></label>
                            <select name="state" id="state" class="form-control">
                                <option value="">Select State</option>
                                <?php foreach ($states as $state): ?>
                                    <option value="<?= $state->id ?>" <?= set_value('state') == $state->id ? 'selected' : ''; ?>>
                                        <?= $state->state_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['state'])): ?>
                                <small class="text-danger" id="error_state"><?= $errors['state']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">City<span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-control" data-selected="<?= set_value('city'); ?>">
                                <option value="">Select City</option>
                            </select>
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['city'])): ?>
                                <small class="text-danger" id="error_city"><?= $errors['city']; ?></small>
                            <?php endif; ?>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
