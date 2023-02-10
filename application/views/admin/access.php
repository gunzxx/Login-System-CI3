<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <a href="<?= base_url('admin/role') ?>" class="btn btn-primary">
            <i class="fas fa-backward"></i>
        </a>
        <?= isset($title) ? ucwords($title) : $active ?>
    </h1>

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

            <table class="table table-hover bg-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col" style="width:100%;display:flex;justify-content:center;">Access</th>
                    </tr>
                </thead>
                <tbody id="menus">
                    <?php foreach ($menus as $k => $menu) : ?>
                        <tr style="width: 100%;">
                            <th style="width:5%;"><?= $k + 1; ?></th>
                            <td style="width:45%;">
                                <label class="form-check-label" for="menu<?= $menu['id']; ?>">
                                    <?= $menu['menu']; ?>
                                </label>
                            </td>
                            <td style="width:100%;display:flex;justify-content:space-evenly;">
                                <div class="form-check">
                                    <label for="menu<?= $menu['id']; ?>" style="width: 40px;">
                                        <i class='<?= check_access($role['id'], $menu['id']) ? "fas fa-fw fa-check-circle text-success" : "far fa-fw fa-check-square" ?>'></i>
                                    </label>
                                    <input style="display: none;" <?= check_access($role['id'], $menu['id']) ? "checked" : "" ?> class="form-check-input" type="checkbox" value="<?= $menu['id']; ?>" data-role="<?= $role['id'] ?>" data-menu="<?= $menu['id'] ?>" id="menu<?= $menu['id']; ?>">
                                </div>
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

<script>
    $(".form-check-input").on('change', function(e) {
        menu_id = $(this).data('menu');
        role_id = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/ch_access') ?>",
            method: "post",
            data: {
                role_id: role_id,
                menu_id: menu_id
            },
            success: function(e) {
                alert(e);
                document.location.href = "<?= base_url('admin/role_access/' . $role['id']) ?>"
            },
            error: function(e) {
                console.log("gagal : " + e);
            }
        })
    });
</script>