<?php

$pageTitle = 'Ad add';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <div class="container">
        <div class="page-header">
            <h1>Ad add</h1>
        </div>
        <hr>
        <div class="row" id="pwd-container">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <section class="login-form">
                    <form id="<?php echo $view_adForm->getName();?>" method="post" name="<?php echo $view_adForm->getName();?>" data-reset="true" data-time="3" data-url="/" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $view_adForm->getToken()->name?>" value="<?php echo $view_adForm->getToken()->value?>">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="<?php echo $view_adForm->getName();?>_title" id="<?php echo $view_adForm->getName();?>_title" placeholder="Title" required>
                            <div class="error alert-danger d-none mt-1"></div>
                        </div>
                        <div class="form-group">
                            <label>Text</label>
                            <textarea rows="10" class="form-control" name="<?php echo $view_adForm->getName();?>_text" id="<?php echo $view_adForm->getName();?>_text" placeholder="Text" required></textarea>
                            <div class="error alert-danger d-none mt-1"></div>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="<?php echo $view_adForm->getName();?>_image" id="<?php echo $view_adForm->getName();?>_image" placeholder="Image">
                            <div class="error alert-danger d-none mt-1"></div>
                        </div>
                        <input type="submit" name="go" class="btn btn-lg btn-primary btn-block" value="Add">
                        <div class="form-group result">
                            <input type="hidden" name="<?php echo $view_adForm->getName();?>_result" id="<?php echo $view_adForm->getName();?>_result">
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