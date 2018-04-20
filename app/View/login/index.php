<?php

$pageTitle = 'Sign In';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
<div class="container">
    <div class="page-header">
        <h1>Sign In</h1>
    </div>
    <hr>
    <div class="row" id="pwd-container">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <section class="login-form">
                <form id="<?php echo $view_lForm->getName();?>" method="post" name="<?php echo $view_lForm->getName();?>" data-reset="false" data-time="3" data-url="/">
                    <input type="hidden" name="<?php echo $view_lForm->getToken()->name?>" value="<?php echo $view_lForm->getToken()->value?>">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="<?php echo $view_lForm->getName();?>_email" id="<?php echo $view_lForm->getName();?>_email" placeholder="Email" required>
                        <div class="error alert-danger d-none mt-1"></div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="<?php echo $view_lForm->getName();?>_password" id="<?php echo $view_lForm->getName();?>_password" placeholder="Password" required>
                        <div class="error alert-danger d-none mt-1"></div>
                    </div>
                    <input type="submit" name="go" class="btn btn-lg btn-primary btn-block" value="Sign in">
                    <div class="form-group result">
                        <input type="hidden" name="<?php echo $view_lForm->getName();?>_result" id="<?php echo $view_lForm->getName();?>_result">
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