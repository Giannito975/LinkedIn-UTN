<?php
        if(!isset($_SESSION["loggedAdmin"])) {
            header("location: ".FRONT_ROOT."Home/HomeView");
        }
?>

<div class="admin-main-view">
    <?php
    require_once('header.php');
    require_once('admin-nav.php');
    ?>
    <a href="<?php echo FRONT_ROOT."Home/HomeView"?>">Go Back</a>
    <div class="welcome-container">
        <h3>Welcome</h3>
    </div>
</div>