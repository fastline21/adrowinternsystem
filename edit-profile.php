<?php
    session_start();
    include('includes/autoloader.inc.php');

    $profile = new Profile();

    // Define variable
    $title = "Edit Profile";
?>

<!-- Header -->
<?php include_once('templates/header-dashboard.php'); ?>
<?php include_once("templates/sidebar-dashboard.php"); ?>

    <!-- Body -->
    <section>

    </section>

<!-- Footer -->
<?php include_once("templates/sidebar-dashboard-footer.php"); ?>
<?php include_once('templates/footer.php'); ?>