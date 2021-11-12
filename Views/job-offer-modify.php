<?php
        if(!isset($_SESSION["loggedAdmin"])) {
            header("location: ".FRONT_ROOT."Home/HomeView");
        }
?>

<div class="modify-company">
    <?php
        require_once('header.php');
        require_once('admin-nav.php');
    ?>
    <form action="<?php echo FRONT_ROOT."JobOffer/ModifyJobOffer"?>" method="POST" class="modify-company-form">

        <!-- Se pasa el id al formulario para después poder hacer el UPDATE -->
        <input class="log-input" type="hidden" name="jobOfferId" value="<?php echo $jobOffer->getJobOfferId(); ?>" required readonly>

        <div class="mb-3">
            <label for="InputName" class="form-label">Title</label>
            <input type="text" class="form-control" name="title"
                aria-describedby="emailHelp" value="<?php echo $jobOffer->getTitle();?>">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Requirements</label>
            <input type="text" class="form-control" name="requirements"   value="<?php echo $jobOffer->getRequirements();?>">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Responsabilities</label>
            <input type="text" class="form-control" name="responsabilities"  value="<?php echo $jobOffer->getResponabilities();?>">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Profits</label>
            <input type="text" class="form-control" name="profits"  value="<?php echo $jobOffer->getProfits();?>">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Salary</label>
            <input type="text" class="form-control" name="salary"  value="<?php echo $jobOffer->getSalary();?>">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Job Position</label>
            <select name="job-position">
                <?php
                foreach($jobPositionList as $jobPosition){
                    ?><option value="<?php echo $jobPosition->getJobPositionId();?>"><?php echo $jobPosition->getDescription();?></option><?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Company</label>
            <select name="company">
                <?php
                foreach($companyList as $company){
                    ?><option value="<?php echo $company->getId_company();?>"><?php echo $company->getName();?></option><?php
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Modify</button>
    </form>
</div>