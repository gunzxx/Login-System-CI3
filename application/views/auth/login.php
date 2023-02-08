<div class="container-fluid">

    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center" style="width: 100%; height:100vh;">
        <div class="col-lg-5 col-sm-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12 p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login</h1>
                            </div>

                            <?php if ($this->session->flashdata('logout')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show p-3" role="alert">
                                    <p><?= $this->session->flashdata('logout') ?>!</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php if ($this->session->flashdata('login')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show p-3" role="alert">
                                    <p><?= $this->session->flashdata('login') ?>!</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php if ($this->session->flashdata('register')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <p>Register <strong><?= $this->session->flashdata('register') ?></strong>, please login!</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <form action="<?= base_url() ?>auth/login" method="post">
                                <div class="form-group">
                                    <input value="<?= set_value('email') ?>" autocomplete="off" type="email" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address...">
                                    <?= form_error('email', '<small class="text-danger p-0">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <input autocomplete="off" type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    <?= form_error('password', '<small class="text-danger p-0">', '</small>') ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a class="small" href="<?= base_url() ?>auth/forgot">Forgot Password?</a>
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