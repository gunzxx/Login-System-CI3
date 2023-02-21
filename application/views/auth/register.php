<div class="container-fluid d-flex justify-content-center align-items-center" style="height:100vh;">

    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="<?= base_url() ?>auth/register" method="post">
                            <div class="form-group">
                                <input value="<?= set_value('nickname') ?>" type="text" class="form-control form-control-user" id="nickname" name="nickname" placeholder="First Name">
                                <?= form_error('nickname', '<small class="text-danger pl-0 pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input value="<?= set_value('email') ?>" type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address">
                                <?= form_error('email', '<small class="text-danger p-0 pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input value="<?= set_value('password') ?>" type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                                    <?= form_error('password', '<small class="text-danger p-0 pl-3">', '</small>') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input value="<?= set_value('password2') ?>" type="password" class="form-control form-control-user" name="password2" id="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url() ?>auth/forgot_password">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url() ?>auth/login">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>