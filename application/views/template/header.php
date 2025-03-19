<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.5/css/ui.jqgrid.min.css">
    <title>Employees!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= base_url('employee'); ?>">Employee Management</a>
    
    <div class="ml-auto">
      <?php if ($this->session->userdata('user_id')): ?>
        <span class="text-white mr-3">Welcome, <?= $this->session->userdata('user_name'); ?>!</span>
        <a href="<?= base_url('logout'); ?>" class="btn btn-danger">Logout</a>
      <?php endif; ?>
    </div>
  </nav>