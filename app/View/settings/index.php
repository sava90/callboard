<?php

$pageTitle = 'Settings';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <div class="container">
        <div class="page-header">
            <h1>My Settings</h1>
        </div>
        <hr>
        <div class="row" id="pwd-container">
            <div class="col-md-4"></div>

            <div class="col-md-4">
                <section class="login-form">
                    <form id="<?php echo $view_sForm->getName();?>" method="post" name="<?php echo $view_sForm->getName();?>" data-reset="false" data-time="" data-url="">
                        <input type="hidden" name="<?php echo $view_sForm->getToken()->name?>" value="<?php echo $view_sForm->getToken()->value?>">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="<?php echo $view_sForm->getName();?>_email" id="<?php echo $view_sForm->getName();?>_email" placeholder="Email" required disabled value="<?php echo $view_user->email?>">
                            <div class="error alert-danger d-none mt-1"></div>
                        </div>
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" class="form-control" name="<?php echo $view_sForm->getName();?>_login" id="<?php echo $view_sForm->getName();?>_login" placeholder="Login" required value="<?php echo $view_user->login?>">
                            <div class="error alert-danger d-none mt-1"></div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="<?php echo $view_sForm->getName();?>_username" id="<?php echo $view_sForm->getName();?>_username" placeholder="Username" required value="<?php echo $view_user->fullName?>">
                            <div class="error alert-danger d-none mt-1"></div>
                        </div>
                        <input type="submit" name="go" class="btn btn-lg btn-primary btn-block" value="Update">
                        <div class="form-group result">
                            <input type="hidden" name="<?php echo $view_sForm->getName();?>_result" id="<?php echo $view_sForm->getName();?>_result">
                            <div class="error alert alert-danger d-none mt-1"></div>
                            <div class="success alert alert-success d-none mt-1"></div>
                        </div>
                    </form>
                </section>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
<?php

$pageContent = ob_get_contents();
ob_end_clean();

require_once(__DIR__.'/../master/master.php');
?>