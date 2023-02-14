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
            <form action="<?= base_url('user/edit') ?>" method="post">
                
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