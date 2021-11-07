<div class="modify-company">
    <?php
        require_once('header.php');
        require_once('admin-nav.php');
    ?>
    <form action="<?php echo FRONT_ROOT."JobOffer/CreateJobOffer"?>" method="POST" class="modify-company-form">

        <div class="mb-3">
            <label for="InputName" class="form-label">Title</label>
            <input type="text" class="form-control" name="title"
                aria-describedby="emailHelp" required placeholder="Type job offer´s title">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Requirements</label>
            <input type="text" class="form-control" name="requirements"  required placeholder="Type the requirements of the job offer">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Responsabilities</label>
            <input type="text" class="form-control" name="responsabilities" required placeholder="Type the responsabilities of the job offer">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Profits</label>
            <input type="text" class="form-control" name="profits" required placeholder="Type the profits of the job offer">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Salary</label>
            <input type="text" class="form-control" name="salary" required placeholder="Type the salary of the job offer">
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

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>