<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= isset($title) ? ucwords($title) : ucwords($active) ?></h1>

    <div class="card p-3" style="max-width: 540px;">
        <div class="row no-gutters align-items-center">
            <div class="col-md-4">
                <img style="width: 100%;max-width: 100%;" src="<?= base_url('assets/') ?>img/profile/<?= $user['image'] ?>" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nickname'] ?></h5>
                    <p class="card-text"><?= $user['email'] ?></p>
                    <p class="card-text"><small class="text-muted">Member since : <?= date('d F Y', $user['date_created']) ?></small></p>
                    <strong>Role : <?=$user['role'] ?></strong>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->