<?php $i = 1; foreach ($submenus as $k => $submenu) : ?>
    <?php if ($this->session->userdata('role_id') != 1) :  ?>
        <?php if ($submenu['menu_id'] != 1) : ?>
            <tr style="width: 100%;">
                <th style="width:5%;" scope=" row"><?= $i++; ?></th>
                <td style="width:15%;"><?= ucwords($submenu['title']); ?></td>
                <td style="width:10%;"><?= ucwords($submenu['menu']); ?></td>
                <td style="width:10%;"><?= $submenu['url']; ?></td>
                <td style="width:10%;"><?= $submenu['icon']; ?></td>
                <td style="width:10%;"><?= $submenu['is_active']; ?></td>
                <td style="width:100%;display:flex;justify-content:space-evenly;align-items:center;">
                    <a class="badge badge-success p-2" href="<?= base_url('submenu/edit'); ?>">Edit</a>
                    <button class="badge badge-danger border-0 outline-none delete p-2" value="<?= $submenu['id'] ?>" type="button">Delete</button>
                </td>
            </tr>
        <?php endif ?>
    <?php elseif ($this->session->userdata('role_id') == 1) :  ?>
        <tr style="width: 100%;">
            <th style="width:5%;" scope=" row"><?= $i++; ?></th>
            <td style="width:15%;"><?= ucwords($submenu['title']); ?></td>
            <td style="width:10%;"><?= ucwords($submenu['menu']); ?></td>
            <td style="width:10%;"><?= $submenu['url']; ?></td>
            <td style="width:10%;"><?= $submenu['icon']; ?></td>
            <td style="width:10%;"><?= $submenu['is_active']; ?></td>
            <td style="width:100%;display:flex;justify-content:space-evenly;align-items:center;">
                <a class="badge badge-success p-2" href="<?= base_url('submenu/edit'); ?>">Edit</a>
                <button class="badge badge-danger border-0 outline-none delete p-2" value="<?= $submenu['id'] ?>" type="button">Delete</button>
            </td>
        </tr>
    <?php endif ?>
<?php endforeach ?>