<div class="container-fluid">

    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center" style="width: 100%; height:100vh;">
        <div class="col-lg-5 col-sm-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12 p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Forgot Password</h1>
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

                            <?php if ($this->session->flashdata('register')) : ?>
                                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                                    <p class="m-0" style="width: 90%;"><?= $this->session->flashdata('register') ?></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <form action="<?= base_url() ?>auth/forgot_password" method="post">
                                <div class="form-group">
                                    <input autofocus value="<?= set_value('email') ?>" type="email" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address...">
                                    <?= form_error('email', '<small class="text-danger p-0">', '</small>') ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Send
                                </button>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a class="small" href="<?= base_url() ?>auth/login">Back to login</a>
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