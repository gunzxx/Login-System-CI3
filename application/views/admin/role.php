<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= isset($title) ? ucwords($title) : ucwords($active) ?></h1>

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <small class="text-black p-0"><?= gettext($this->session->flashdata('error')) ?></small>

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
        <div class="col-md-12">
            <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRole">Add new role</a>
            <table class="table table-hover bg-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col" style="width:100%;display:flex;justify-content:center;">Action</th>
                    </tr>
                </thead>
                <tbody id="menus">
                    <?php foreach ($roles as $k => $role) : ?>
                        <tr style="width: 100%;">
                            <th style="width:5%;"><?= $k + 1; ?></th>
                            <td style="width:45%;"><?= $role['role']; ?></td>
                            <td style="width:100%;display:flex;justify-content:start;gap:30px;">
                                <a class="btn btn-warning" href="<?= base_url('admin/role_access/') . $role['id']; ?>">Access</a>
                                <a class="btn btn-success" href="<?= base_url('admin/edit'); ?>">Edit</a>
                                <?php if($role['id'] != 1) : ?>
                                    <button class="btn btn-danger border-0 outline-none delete" value="<?= $role['id'] ?>" type="button">Delete</button>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Menu management -->

</div>
<!-- /.container-fluid -->


<!-- Modal -->
<div class="modal fade" id="newRole" tabindex="-1" aria-labelledby="newRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleLabel">Add role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/add_role') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
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
            let lanjut = confirm('Data akan terhapus,\nYakin hapus?');

            if (lanjut == true) {
                console.log("oke");
                $.ajax({
                    url: "<?= base_url('admin/role_delete'); ?>",
                    method: "POST",
                    data: {
                        id: dltBtn.value
                    },
                    success: function(e) {
                        document.getElementById("menus").innerHTML = e;
                    },
                    error: function(xhr, status, error) {
                        console.log(arguments);
                    }
                })
            };
        })
    });
</script>