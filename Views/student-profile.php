<?php
        if(!isset($_SESSION["loggedUser"])) {
            header("location: ".FRONT_ROOT."Home/HomeView");
        }
?>
<div class="company-list">
    
    
    <?php
        require_once('header.php');
        require_once('student-nav.php');
    ?>
    <div class="go-back-btn">
        <a href="<?php FRONT_ROOT."Student/ShowJobOfferView"?>">Go back</a>
    </div>
    <!-- foreach con todas las companys -->
    <div class="company-container">
        <table class="table bg-light-alpha">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Dni</th>
                <th>File Number</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Phone Number</th>
                <th>Email</th>
            </thead>
            <tbody>
                <tr>
                    <?php $student = $_SESSION['loggedUser']?>
                    <td><?php echo $student->getFirstName(); ?></td>
                    <td><?php echo $student->getLastName(); ?></td>
                    <td><?php echo $student->getDni(); ?></td>
                    <td><?php echo $student->getFileNumber(); ?></td>
                    <td><?php echo $student->getGender(); ?></td>
                    <td><?php echo $student->getBirthDate(); ?></td>
                    <td><?php echo $student->getPhoneNumber(); ?></td>
                    <td><?php echo $student->getEmail(); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>