<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= isset($title) ? ucwords($title) : ucwords($active) ?></h1>

    <?php if (form_error('menu')) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= form_error('menu', '<small class="text-danger p-0">', '</small>') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <small class="text-black p-0"><?= $this->session->flashdata('message') ?></small>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <!-- Menu management -->
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenu">Add new menu</a>
            <table class="table table-hover bg-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col" style="width:100%;display:flex;justify-content:center;">Action</th>
                    </tr>
                </thead>
                <tbody id="menus">
                    <?php $i = 1;
                    foreach ($menus as $k => $menu) : ?>
                        <?php if ($this->session->userdata('role_id') != 1) : ?>
                            <?php if ($menu['id'] != 1) : ?>
                                <tr style="width: 100%;">
                                    <th style="width:5%;" scope=" row"><?= $i++; ?></th>
                                    <td style="width:45%;"><?= ucwords($menu['menu']); ?></td>
                                    <td style="width:100%;display:flex;justify-content:space-evenly;">
                                        <a class="btn btn-success" href="edit">Edit</a>
                                        <button class="btn btn-danger border-0 outline-none delete" value="<?= $menu['id'] ?>" type="button">Delete</button>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php else : ?>
                            <tr style="width: 100%;">
                                <th style="width:5%;" scope=" row"><?= $i++; ?></th>
                                <td style="width:45%;"><?= ucwords($menu['menu']); ?></td>
                                <td style="width:100%;display:flex;justify-content:space-evenly;">
                                    <a class="btn btn-success" href="edit">Edit</a>
                                    <button class="btn btn-danger border-0 outline-none delete" value="<?= $menu['id'] ?>" type="button">Delete</button>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Menu management -->

</div>
<!-- /.container-fluid -->


<!-- Modal -->
<div class="modal fade" id="newMenu" tabindex="-1" aria-labelledby="newMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuLabel">Add menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/manage') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<script>
    const deleteBtn = document.querySelectorAll(".delete");

    deleteBtn.forEach(dltBtn => {
        dltBtn.addEventListener('click', function() {
            let lanjut = confirm('Submenu akan terhapus,\nYakin hapus?');

            if (lanjut == true) {
                $.ajax({
                    'url': "<?= base_url('menu/delete'); ?>",
                    'method': "POST",
                    "data": {
                        id: dltBtn.value
                    },
                    "success": function(e) {
                        document.getElementById("menus").innerHTML = e;
                    }
                })
            };
        })
    });
</script>