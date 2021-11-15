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
        <a href="<?php echo FRONT_ROOT."JobOffer/JobOfferListViewStudent" ?>">
            Go Back
        </a>
    </div>
    <!-- foreach con todas las companys -->
    <br>
    <a href="<?php echo FRONT_ROOT."JobOffer/JobOfferListViewStudent" ?>">
        <button type="submit" class="btn btn-success mr-4" data-toggle="modal" 
           >
            <img src="<?php echo ICONS_PATH."user-check.svg"?>" width="16" height="16" alt="Add" /> Job Offer apply record
        </button>
    </a>
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