<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5>
                        Edit Employee
                        <a href="<?php echo base_url('employee'); ?>" class="btn btn-danger float-right">Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('employee/update/' . $employee->id) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="first_name" value="<?= set_value('first_name', $this->session->flashdata('old_values')['first_name'] ?? $employee->first_name); ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['first_name'])) : ?>
                                <small class="text-danger" id="error_first_name"><?= $errors['first_name']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="last_name" value="<?= set_value('last_name', $this->session->flashdata('old_values')['last_name'] ?? $employee->last_name); ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['last_name'])) : ?>
                                <small class="text-danger" id="error_last_name"><?= $errors['last_name']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="profile_photo">Profile Photo</label>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*">

                            <?php if (!empty($employee->profile_photo)) : ?>
                                <input type="hidden" name="old_profile_photo" value="<?= $employee->profile_photo ?>">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" name="dob" value="<?= set_value('dob', $this->session->flashdata('old_values')['dob'] ?? $employee->dob); ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['dob'])) : ?>
                                <small class="text-danger" id="error_dob"><?= $errors['dob']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" value="<?= set_value('email', $this->session->flashdata('old_values')['email'] ?? $employee->email); ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['email'])) : ?>
                                <small class="text-danger" id="error_email"><?= $errors['email']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Phone<span class="text-danger">*</span></label>
                            <input type="tel" name="phone" value="<?= set_value('phone', $this->session->flashdata('old_values')['phone'] ?? $employee->phone); ?>" class="form-control" pattern="[0-9]{10}" title="Enter 10-digit phone number" placeholder="Enter your 10-digit phone number">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['phone'])) : ?>
                                <small class="text-danger" id="error_phone"><?= $errors['phone']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Department<span class="text-danger">*</span></label>
                            <input type="text" name="department" value="<?= set_value('department', $this->session->flashdata('old_values')['department'] ?? $employee->department); ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['department'])) : ?>
                                <small class="text-danger" id="error_department"><?= $errors['department']; ?></small>
                            <?php endif; ?>
                        </div>

                        <?php
                        $old_state = set_value('state', $this->session->flashdata('old_values')['state'] ?? $employee->state);
                        ?>

                        <div class="form-group">
                            <label for="">State<span class="text-danger">*</span></label>
                            <select name="state" id="state" class="form-control">
                                <option value="">Select State</option>
                                <?php foreach ($states as $state) : ?>
                                    <option value="<?= $state->id ?>" <?= $old_state == $state->id ? 'selected' : ''; ?>>
                                        <?= $state->state_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['state'])) : ?>
                                <small class="text-danger" id="error_state"><?= $errors['state']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">City<span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-control" data-selected="<?= $this->session->flashdata('old_values')['city'] ?? $employee->city ?>">
                                <option value="">Select City</option>
                            </select>
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['city'])) : ?>
                                <small class="text-danger" id="error_city"><?= $errors['city']; ?></small>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>