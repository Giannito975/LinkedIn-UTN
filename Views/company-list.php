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

    <div class="mb-3"> <!-- filtrar por nombre -->
                    <label for="" class="form-label">Company</label>
                    <select name="company">
                    <option hidden selected>Click to select filter parameter</option>
                        <?php
                        foreach($companyList as $company){
                            ?><option value="<?php echo $company->getId_company();?>" ><?php echo $company->getName();?></option><?php
                        }
                        ?>
                    </select>
                    </div>

    <table class="table bg-light-alpha">
                    <thead>
                         <th>Name</th>
                         <th>About Us</th>
                         <th>Company Link</th>
                         <th>Email</th>
                         <th>Industry</th>
                         <th>City</th>
                         <th>Country</th>
                    </thead>
                    <tbody>
                         <tr>
                              <?php foreach($companyList as $company){?>
                                        <td><?php echo $company->getName(); ?></td>
                                        <td><?php echo $company->getAbout_us(); ?></td>
                                        <td><?php echo $company->getCompany_link(); ?></td>
                                        <td><?php echo $company->getEmail(); ?></td>
                                        <td><?php echo $company->getIndustry(); ?></td>
                                        <td><?php echo $company->getCity(); ?></td>
                                        <td><?php echo $company->getCountry(); ?></td>
                         </tr>
                         <tr>
                              <?php } ?>
                         </tr>
                    </tbody>
               </table>
    </div>
</div>