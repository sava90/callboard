<?php

$pageTitle = 'User';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <div class="container">
        <div class="page-header">
            <h1>User - #<?php echo $view_user->userId?></h1>
        </div>
        <hr>
        <div class="row" id="pwd-container">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <p>Login: <?php echo $view_user->login?></p>
                <p>Username: <?php echo $view_user->fullName?></p>
                <p>Email: <?php echo $view_user->email?></p>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
<?php

$pageContent = ob_get_contents();
ob_end_clean();

require_once(__DIR__.'/../master/master.php');
?>