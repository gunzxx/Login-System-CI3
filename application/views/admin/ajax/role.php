<?php foreach ($roles as $k => $role) : ?>
    <tr style="width: 100%;">
        <th style="width:5%;"><?= $k + 1; ?></th>
        <td style="width:45%;"><?= $role['role']; ?></td>
        <td style="width:100%;display:flex;justify-content:start;gap:30px;">
            <a class="btn btn-warning" href="<?= base_url('admin/role_access/') . $role['id']; ?>">Access</a>
            <a class="btn btn-success" href="<?= base_url('admin/edit'); ?>">Edit</a>
            <?php if ($role['id'] != 1) : ?>
                <button class="btn btn-danger border-0 outline-none delete" value="<?= $role['id'] ?>" type="button">Delete</button>
            <?php endif ?>
        </td>
    </tr>
<?php endforeach ?>