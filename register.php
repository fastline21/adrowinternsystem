<?php
    include("includes/autoloader.inc.php");
    $user = new User();

    // Define variable
    $title = "Register";
    $fullnameErr = $usernameErr = $passwordErr = $emailErr = "";
    $message = "";
    $errors = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['submit'])) {
            extract($_REQUEST);

            // Validate input
            empty($fullname) ? ($fullnameErr = "Full Name is required" AND $errors = true) : $fullname = check_input($fullname);
            empty($username) ? ($usernameErr = "Username is required" AND $errors = true) : $username = check_input($username);
            empty($password) ? ($passwordErr = "Password is required" AND $errors = true) : $password = check_input($password);
            empty($email) ? ($emailErr = "Email is required" AND $errors = true) : $email = check_input($email);

            if (!$errors) {
                $register = $user->register_user($fullname, $username, $password, $email);

                if ($register) {
                    $message = "Registration successful <a href='login.php'>Click</a> to login";
                } else {
                    $message = "Registration failed. Email or Username already exits please try again";
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
            <div class="row">
                <div class="col-md-5">
                    <a href="login.php" class="btn btn-primary">Login</a>
                </div>
                <div class="col-md-7">
                    <?php
                        if ($errors) {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $fullnameErr; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $usernameErr; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $passwordErr; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $emailErr; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        }
                    ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                            <input type="text" name="fullname" class="form-control" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email" />
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <?php
                        if ($message) {
                            echo $message;
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<?php include_once("templates/footer.php") ?>