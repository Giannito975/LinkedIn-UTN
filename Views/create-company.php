<?php
        if(!isset($_SESSION["loggedUser"])) {
            header("location: ".FRONT_ROOT."Home/HomeView");
        }
?>

<div class="modify-company">
    <?php
        require_once('header.php');
        require_once('admin-nav.php');
    ?>
    <form action="<?php echo FRONT_ROOT."Company/CreateCompany"?>" method="POST" class="modify-company-form">

        <div class="mb-3">
            <label for="InputName" class="form-label">Name</label>
            <input type="text" class="form-control" name="name"
                aria-describedby="emailHelp" required placeholder="Type company´s name">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">About us</label>
            <input type="text" class="form-control" name="aboutUs"  required placeholder="Type something relevant about the company">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Company Link</label>
            <input type="text" class="form-control" name="companyLink" required placeholder="Type company´s website link">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required placeholder="Type company´s email">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Industry</label>
            <input type="text" class="form-control" name="industry" required placeholder="Type company´s industry">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">City</label>
            <input type="text" class="form-control" name="city" required placeholder="Type company´s city">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Country</label>
            <input type="text" class="form-control" name="country" required placeholder="Type company´s country">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>