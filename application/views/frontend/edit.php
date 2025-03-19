
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h5>
                        Edit Your Data
                        <a href="<?php echo base_url('employee'); ?>" class="btn btn-danger float-right">Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('employee/update/'.$employee->id)?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                        value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="first_name" value="<?= $employee->first_name ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['first_name'])): ?>
                                <small class="text-danger"><?= $errors['first_name']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="last_name" value="<?= $employee->last_name ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['last_name'])): ?>
                                <small class="text-danger"><?= $errors['last_name']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="profile_photo">Profile Photo</label>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-control">

                            <?php if (!empty($employee->profile_photo)): ?>
                                <input type="hidden" name="old_profile_photo" value="<?= $employee->profile_photo ?>">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" name="dob" value="<?= $employee->dob ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['dob'])): ?>
                                <small class="text-danger"><?= $errors['dob']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" value="<?= $employee->email ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['email'])): ?>
                                <small class="text-danger"><?= $errors['email']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Phone<span class="text-danger">*</span></label>
                            <input type="tel" name="phone" value="<?= $employee->phone ?>" class="form-control" pattern="[0-9]{10}" title="Enter 10-digit phone number" placeholder="Enter your 10-digit phone number">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['phone'])): ?>
                                <small class="text-danger"><?= $errors['phone']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Department<span class="text-danger">*</span></label>
                            <input type="text" name="department" value="<?= $employee->department ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['department'])): ?>
                                <small class="text-danger"><?= $errors['department']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">State<span class="text-danger">*</span></label>
                            <input type="text" name="state" value="<?= $employee->state ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['state'])): ?>
                                <small class="text-danger"><?= $errors['state']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">City<span class="text-danger">*</span></label>
                            <input type="text" name="city" value="<?= $employee->city ?>" class="form-control">
                            <?php if (($errors = $this->session->flashdata('validation_errors')) && isset($errors['city'])): ?>
                                <small class="text-danger"><?= $errors['city']; ?></small>
                            <?php endif; ?>
                        </div>

                            <button type="submit" class="btn btn-success">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
