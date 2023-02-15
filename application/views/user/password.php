<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= isset($title) ? ucwords($title) : ucwords($active) ?></h1>
    <!-- End Page Heading -->

    <!-- Flash message -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="col-10 p-0 pr-1">
            <div class="alert alert-<?= strpos($this->session->flashdata('message'), 'update!') ? "success" : "warning" ?> alert-dismissible fade show" role="alert">
                <small class="text-black p-0"><?= $this->session->flashdata('message') ?></small>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    <?php endif ?>
    <!-- End Flash message -->

    <div class="row">
        <div class="col-10">
            <form action="<?= base_url('user/password') ?>" method="post">
                <div class="form-group">
                    <label for="oldpassword">Current password</label>
                    <input type="password" class="form-control" name="oldpassword" id="oldpassword">
                    <?= form_error('oldpassword', '<small class="text-danger p-0">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="password1">New password</label>
                    <input type="password" class="form-control" name="password1" id="password1">
                    <?= form_error('password1', '<small class="text-danger p-0">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="password2">Repeat password</label>
                    <input type="password" class="form-control" name="password2" id="password2">
                    <?= form_error('password2', '<small class="text-danger p-0">', '</small>') ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change password</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Script alert animate -->
<script>
    // $('.alert').alert().delay(3000).slideUp('slow');
</script>
<!-- End Script alert animate -->