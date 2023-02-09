<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= ucwords($active) ?></h1>
    <?php if (form_error('title')) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= form_error('title', '<small class="text-danger p-0">', '</small>') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="m-0 text-black p-0"><?= $this->session->flashdata('message') ?></p>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <!-- Menu management -->
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenu">Add new sub menu</a>
            <table class="table table-hover bg-white">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sub Menu</th>
                        <th>Menu</th>
                        <th>Url</th>
                        <th>Icon</th>
                        <th>Active</th>
                        <th style="width:100%;text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody id="menus">
                    <?php foreach ($submenus as $k => $submenu) : ?>
                        <tr style="width: 100%;">
                            <th style="width:5%;" scope=" row"><?= $k + 1; ?></th>
                            <td style="width:15%;"><?= ucwords($submenu['title']); ?></td>
                            <td style="width:10%;"><?= ucwords($submenu['menu']); ?></td>
                            <td style="width:10%;"><?= $submenu['url']; ?></td>
                            <td style="width:10%;"><?= $submenu['icon']; ?></td>
                            <td style="width:10%;"><?= $submenu['is_active']; ?></td>
                            <td style="width:100%;display:flex;justify-content:space-evenly;">
                                <a class="badge badge-success" href="<?= base_url('submenu/edit'); ?>">Edit</a>
                                <button class="badge badge-danger border-0 outline-none delete" value="<?= $submenu['id'] ?>" type="button">Delete</button>
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
<div class="modal fade" id="newSubMenu" tabindex="-1" aria-labelledby="newSubMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuLabel">Add menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('submenu/manage') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                    </div>
                    <div class="form-group">
                        <label for="menu_id">Select Menu : </label>
                        <select name="menu_id" id="menu_id">
                            <?php foreach ($menus as $menu) : ?>
                                <option value="<?= $menu['id']; ?>"><?= $menu['menu']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label" for="True">
                                <input class="form-check-input" type="checkbox" value="1" id="True" name="is_active" checked>
                                Active
                            </label>
                        </div>
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
            if(lanjut == true)
            {
                $.ajax({
                    url: "<?= base_url('submenu/delete'); ?>",
                    method: "POST",
                    data: {
                        id: dltBtn.value
                    },
                    success: function(e) {
                        document.getElementById("menus").innerHTML = e;
                    },
                    error : function(xhr,status,error){
                        console.log(arguments);
                    }
                })
            }
        })
    });
</script>