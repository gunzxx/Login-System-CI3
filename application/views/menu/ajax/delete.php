<?php foreach ($menus as $k => $menu) : ?>
    <tr style="width: 100%;">
        <th style="width:5%;" scope=" row"><?= $k + 1; ?></th>
        <td style="width:45%;"><?= ucwords($menu['menu']); ?></td>
        <td style="width:100%;display:flex;justify-content:space-evenly;">
            <a class="badge badge-success" href="edit">Edit</a>
            <button onclick="return confirm('Menu dan semua submenu akan terhapus,\nYakin hapus?')" class="badge badge-danger border-0 outline-none delete" value="<?= $menu['id'] ?>" type="button">Delete</button>
        </td>
    </tr>
<?php endforeach ?>