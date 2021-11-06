<div class="modify-company">
    <?php
        require_once('header.php');
        require_once('admin-nav.php');
    ?>
    <form action="<?php echo FRONT_ROOT."Company/ModifyCompany"?>" method="POST" class="modify-company-form">

        <!-- Se pasa el id al formulario para después poder hacer el UPDATE -->
        <input class="log-input" type="hidden" name="id" value="<?php echo $company->getId_company(); ?>" required readonly>

        <div class="mb-3">
            <label for="InputName" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $company->getName();?>"
                aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">About us</label>
            <input type="text" class="form-control" name="aboutUs" value="<?php  echo $company->getAbout_us()?>"  required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Company Link</label>
            <input type="text" class="form-control" name="companyLink" value="<?php  echo $company->getCompany_link()?>"required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php  echo $company->getEmail()?>"required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Industry</label>
            <input type="text" class="form-control" name="industry" value="<?php echo $company->getIndustry()?>"required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">City</label>
            <input type="text" class="form-control" name="city" value="<?php  echo $company->getCity()?>"required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Country</label>
            <input type="text" class="form-control" name="country" value="<?php  echo $company->getCountry()?>"required>
        </div>

        <button type="submit" class="btn btn-primary">Modify</button>
    </form>
</div>