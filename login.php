<?php
    session_start();
    include("includes/autoloader.inc.php");
    $user = new User();

    // Define variable
    $title = "Login";
    $usernameErr = $passwordErr = "";
    $message = "";
    $errors = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['submit'])) {
            extract($_REQUEST);

            // Validate input
            empty($username) ? ($usernameErr = "Username is required" AND $errors = true) : $username = check_input($username);
            empty($password) ? ($passwordErr = "Password is required" AND $errors = true) : $password = check_input($password);

            if (!$errors) {
                $login = $user->login_user($username, $password);

                if ($login) {
                    header("location: home.php?u=" . $username);
                } else {
                    $message = "Login failed. Username or Password you entered is incorrect.";
                }
            }
        }
    }

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!-- Header -->
<?php include_once("templates/header.php") ?>

    <!-- Body -->
    <section>
        <div class="container">
            <h1 class="text-center"><?php echo $title; ?></h1>
            <?php
                if ($errors) {
                    if ($usernameErr) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $usernameErr; ?>
                        </div>
                        <?php
                    }
                    if ($passwordErr) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $passwordErr; ?>
                        </div>
                        <?php
                    }
                }
            ?>
            <div class="row">
                <div class="col-md-7">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
                <div class="col-md-5">
                    <a href="register.php" class="btn btn-primary">Register</a>
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<?php include_once("templates/footer.php") ?>