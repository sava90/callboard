<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title><?= @$pageTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= @$pageMetas ?>
        <link type="text/css" rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="/">Main</a></li>
                        <li class="nav-item"><a class="nav-link" href="/users">Users</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($view_loggedIn): ?>
                            <li class="nav-item"><a href="/ad/add" class="btn btn-primary">Add ad</a></li>
                            <li class="nav-item"><a class="nav-link" href="/account/settings">My Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="/account/logout">Sign out</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="/account/signin">Log in</a></li>
                            <li class="nav-item"><a class="nav-link" href="/account/signup">Sign up</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?= @$pageContent ?>
        <footer class="footer fixed-bottom bg-light">
            <div class="container">
                <div class="small text-center">&copy; <?php echo date('Y'); ?>, All Rights Reserved</div>
            </div>
        </footer>
        <div id="overlay"></div>

        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="/js/script.js"></script>
    </body>
</html>
