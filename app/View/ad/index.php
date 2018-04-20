<?php

$pageTitle = $view_ad->title;
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>

<div class="container">
    <div class="page-header">
        <h1><?php echo $view_ad->title?></h1>
        <div>
            <?php if($view_user->userId == $view_ad->userId):?>
                <span class="small">[<a href="/ad/edit/<?php echo $view_ad->adId?>">Edit</a> | <a href="/ad/delete/<?php echo $view_ad->adId?>">Delete</a>]</span>
            <?php endif; ?>
        </div>
    </div>
    <hr>
    <div class="row" id="pwd-container">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <div class="clearfix">
                <?php if($view_ad->fileName):?>
                    <img src="/images/<?php echo $view_ad->fileName?>" width="200" class="float-left mr-2">
                <?php endif; ?>
                <p>Author: <?php echo $view_ad->fullName ?></p>
                <p><?php echo $view_ad->body ?></p>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<?php

$pageContent = ob_get_contents();
ob_end_clean();

require_once(__DIR__.'/../master/master.php');
?>