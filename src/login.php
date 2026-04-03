<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles2.css">
    </head>
    <body>
        <div class="d-flex justify-content-center align-items-center vh-100">

            <form class="shadow w-450 p-3" action="checklogin.php" method="POST">
                <h4>Login</h4>
                <br>
                <?php
                    if (isset($_GET['error'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                        echo $_GET['error'];
                    ?>
                </div>
                <?php } ?>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="uname" class="form-control"
                    value="<?php echo (isset($_GET['uname']))? $_GET['uname']:""?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="pass" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="signup.php" class="link-secondary">Sign up</a>
            </form>
        </div>
    </body>
</html>