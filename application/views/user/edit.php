<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= isset($title) ? ucwords($title) : ucwords($active) ?></h1>
    <!-- End Page Heading -->

    <!-- Flash message -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <small class="text-black p-0"><?= $this->session->flashdata('message') ?></small>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>
    <!-- End Flash message -->

    <div class="row">
        <div class="col-10">
            <form action="<?= base_url('user/edit') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" readonly value="<?= $user['email'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nickname" class="col-sm-2 col-form-label">Nickname</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nickname" name="nickname" value="<?= $user['nickname'] ?>">
                        <?= form_error('nickname', '<small class="text-danger p-0">', '</small>') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="image">Picture</label>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-sm-2">
                                <img style="width:100%;max-width:100%;" src="<?= base_url('assets/img/profile/') . $user['image'] ?>" alt="<?= $user['image'] ?>">
                            </div>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<!-- Jquery for picture image -->
<script>
    $(".custom-file-input").on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next(".custom-file-label").addClass('selected').html(filename);
    });
</script>
<!-- End Jquery for picture image -->