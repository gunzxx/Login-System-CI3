<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">G-Blog <sup>2</sup></div>
    </a>

    <?php if ($user['role_id'] == 1) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <?php
        
        $queryMenu = 1;
        
        ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            Administrator
        </div>
    
        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= $active == 'dashboard' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url() ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    <?php endif ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= $active == 'profile' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('user/profile') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Action
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/logout') ?>">
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