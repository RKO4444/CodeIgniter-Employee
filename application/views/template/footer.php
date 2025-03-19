<script>
    var BASE_URL = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('assets/js/jQuery.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.5/jquery.jqgrid.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/jAlert.min.css'); ?>">
<script src="<?= base_url('assets/js/jAlert.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jAlert-functions.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/employeeGrid.js'); ?>"></script>

<script>
  $(document).ready(function() {
    <?php if ($this->session->flashdata('status')): ?>
        $.jAlert({
            'title': 'Notification',
            'content': '<?= $this->session->flashdata('status'); ?>',
            'theme': '<?= $this->session->flashdata('status_type') === "error" ? "red" : "green"; ?>'
        });
    <?php endif; ?>
});
</script>
</body>

</html>