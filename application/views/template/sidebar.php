<?php
$queryMenu = "
                SELECT menu.*
                FROM menu JOIN access_menu
                ON menu.id = access_menu.menu_id
                WHERE access_menu.role_id = {$user['role_id']}
                ORDER BY access_menu.menu_id ASC
            ";
$menus = $this->db->query($queryMenu)->result_array();
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">G-Blog <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php foreach ($menus as $menu) : ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            <?= $menu['menu']; ?>
        </div>

        <?php
        $querySubMenu = "
                SELECT *
                FROM menu JOIN submenu
                ON menu.id = submenu.menu_id
                WHERE submenu.menu_id = {$menu['id']} AND submenu.is_active = 1
                ORDER BY submenu.menu_id ASC
        ";
        $SubMenus = $this->db->query($querySubMenu)->result_array();
        ?>
        <?php foreach ($SubMenus as $submenu) : ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= strtolower($active) == strtolower($submenu['title']) ? 'active' : '' ?>">
                <a class="nav-link py-2" href="<?= base_url($submenu['url']) ?>">
                    <i class="<?= $submenu['icon']; ?>"></i>
                    <span><?= $submenu['title'] ?></span>
                </a>
            </li>
        <?php endforeach ?>

        <!-- Divider -->
        <hr class="sidebar-divider">
    <?php endforeach ?>


    <!-- Heading -->
    <div class="sidebar-heading">
        Action
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" style="cursor:pointer;" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->