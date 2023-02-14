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