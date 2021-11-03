<div class="company-list-admin">
    <?php
        require_once('header.php');
        require_once('admin-nav.php');
    ?>
    <!-- foreach con todas las companys -->
    <div class="company-container">
        <?php foreach($companyList as $company){?>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <?php echo $company->getName(); ?>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php echo $company->getAbout_us(), echo $company->getCompany_link(),
                         echo $company->getEmail(),  echo $company->getIndustry(,)  echo $company->getCity(),
                          echo $company->getCountry(); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        
    </div>