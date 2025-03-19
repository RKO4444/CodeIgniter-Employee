<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Employee Data</h4>
                    <a href="<?= base_url('employee/add'); ?>" class="btn btn-light">+ Add Employee</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="employeeGrid"></table>
                        <div id="pager"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
