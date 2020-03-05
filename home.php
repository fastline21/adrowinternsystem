<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    
    // Define Variable
    $title = "Home";
    $id = $_SESSION['id'];

    // If not login the user
    if (!$user->get_session()) {
        header("location: login.php");
    }

    // Logout button
    if (isset($_GET['a'])) {
        if ($_GET['a'] == 'logout') {
            $user->user_logout();
            header("location: login.php");
        }
    }
?>

<!-- Header -->
<?php include_once("templates/header-dashboard.php") ?>
<?php include_once("templates/sidebar-dashboard.php") ?>

    <!-- Body -->
    <section>
        <h1>Welcome <?php $user->get_fullname($id); ?></h1>
    </section>

<!-- Footer -->
<?php include_once("templates/sidebar-dashboard-footer.php") ?>
<?php include_once("templates/footer.php") ?>