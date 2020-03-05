<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    
    // Define Variable
    $title = "Profile";
    $id = $_SESSION['id'];

    // If not login the user
    if (!$user->get_session()) {
        header("location: login.php");
    }

    // If no username in URL
    if (!$_GET['u']) {
        header("location: login.php");
    }

    // Logout button
    if (isset($_GET['a'])) {
        if ($_GET['a'] == 'logout') {
            $user->user_logout();
            header("location: login.php");
        }
    }

    // If profile not created
    
?>

<!-- Header -->
<?php include_once("templates/header-dashboard.php") ?>
<?php include_once("templates/sidebar-dashboard.php") ?>

    <!-- Body -->
    <section>
        <h1><?php echo $title; ?></h1>
        <a href="add-profile.php?u=<?php echo $_GET['u']; ?>">Add Profile</a>
        <a href="edit-profile.php?u=<?php echo $_GET['u']; ?>">Edit Profile</a>
    </section>

<!-- Footer -->
<?php include_once("templates/sidebar-dashboard-footer.php") ?>
<?php include_once("templates/footer.php") ?>