<div class="container-fluid">
    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center" style="width: 100%; height:100vh;">
        <div class="col-lg-5 col-sm-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12 p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Reset password</h1>
                            </div>

                            <?php if ($this->session->flashdata('logout')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                                    <p class="m-0" style="width: 90%;"><?= $this->session->flashdata('logout') ?>!</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php if ($this->session->flashdata('login')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                                    <p class="m-0" style="width: 90%;"><?= $this->session->flashdata('login') ?></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
                                    <p class="m-0" style="width: 90%;"><?= $this->session->flashdata('error') ?></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php if ($this->session->flashdata('success')) : ?>
                                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                                    <p class="m-0" style="width: 90%;"><?= $this->session->flashdata('success') ?></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <form method="post">
                                <div class="form-group">
                                    <label for="password">New password</label>
                                    <input value="<?= set_value('password') ?>" autocomplete="off" type="text" class="form-control form-control-user" id="password" name="password" placeholder="Enter password">
                                    <?= form_error('password', '<small class="text-danger p-0">', '</small>') ?>
                                </div>

                                <div class="form-group">
                                    <label for="password2">Retype password</label>
                                    <input value="<?= set_value('password2') ?>" autocomplete="off" type="text" class="form-control form-control-user" id="password2" name="password2" placeholder="Enter password again">
                                    <?= form_error('password2', '<small class="text-danger p-0">', '</small>') ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a class="small" href="<?= base_url() ?>auth/forgot_password">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url() ?>auth/register">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>