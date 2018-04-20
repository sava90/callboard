<?php

$pageTitle = 'Users';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <div class="container">
        <div class="page-header">
            <h1>Users</h1>
        </div>
        <hr>
        <div class="row" id="pwd-container">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <?php if($view_users): ?>
                        <table class="table">
                            <colgroup>
                                <col width="1%">
                                <col width="*">
                            </colgroup>
                            <tr>
                                <th>ID</th>
                                <th>Login</th>
                            </tr>
                            <?php foreach ($view_users as $user): ?>
                                <tr>
                                    <td class="center"><?php echo $user->userId ?></td>
                                    <td><a href="/user/<?php echo $user->userId ?>"><?php echo $user->login ?></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                <?php endif; ?>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
<?php

$pageContent = ob_get_contents();
ob_end_clean();

require_once(__DIR__.'/../master/master.php');
?>