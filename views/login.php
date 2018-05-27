<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Project</title>
        <!-- Latest compiled and minified CSS -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Project</a>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li><a href="/">Home</a></li>
                  <li class="active"><a href="/login">Login</a></li>
                  <li><a href="/register">Register</a></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>

        <div class="container">
            <?php
                if(Session::exists('home')) {
                    echo '<p>' . Session::flash('home'). '</p>';
                }
            ?>

            <form action="login" method="post">
                <div class="form-group">
                    <label for='username'>Username</label>
                    <input class="form-control" type="text" name="username" id="username">
                </div>

                <div class="form-group">
                    <label for='password'>Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>

                <div class="checkbox">
                    <label for="remember">
                        <input type="checkbox" name="remember" id="remember">Remember me
                    </label>
                </div>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" class="btn btn-default">Login</button>
            </form>
        </div>

        <hr>
        <hr>

        <footer class="bg-dark text-white">
            <div class="text-center py-2 lead">Copyright ©2018 - Mihail Nikov</div>
        </footer>
    </body>
</html>