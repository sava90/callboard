<?php

$pageTitle = 'Main';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <div class="container">
        <div class="page-header">
            <h1>Ads</h1>
        </div>
        <hr>
        <div class="row" id="pwd-container">
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <?php if($view_ads): ?>
                    <?php foreach ($view_ads as $ad): ?>
                        <div class="clearfix">
                            <?php if($ad->fileName):?>
                                <img src="/images/<?php echo $ad->fileName?>" width="150" class="float-left mr-2">
                            <?php endif; ?>
                            <a href="/ad/<?php echo $ad->adId?>"><?php echo $ad->title?></a>
                            <?php if($view_user->userId == $ad->userId):?>
                                <span class="small">[<a href="/ad/edit/<?php echo $ad->adId?>">Edit</a> | <a href="/ad/delete/<?php echo $ad->adId?>">Delete</a>]</span>
                            <?php endif; ?>
                            <p><?php echo mb_strimwidth($ad->body, 0, 350, "...");?></p>
                        </div>
                        <hr>
                    <?php endforeach; ?>
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