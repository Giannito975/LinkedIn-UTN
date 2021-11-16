<?php
        if(!isset($_SESSION["loggedUser"])) {
            header("location: ".FRONT_ROOT."Home/HomeView");
        }
?>

<?php
        require_once('header.php');
        require_once('student-nav.php');
?>
<main class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading 
        <h1 class="h3 mb-2 text-gray-800"> <?php //echo "$validMessage"; ?> </h1>-->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Job Offer list</h6>
            </div>


            <div class="filters">

                <form action="<?php echo FRONT_ROOT."JobOffer/FilterByJob"?>" method="POST" class="filter-options">
                    <div class="mb-3"> <!-- filters -->
                    <label for="" class="form-label">Filter by Job Position</label>
                    <select name="jobPosition">
                    <option hidden selected>Click to select filter parameter</option>
                        <?php
                        foreach($jobPositionList as $jobPosition){
                            ?><option value="<?php echo $jobPosition->getDescription();?>"><?php echo $jobPosition->getDescription();?></option><?php
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-success mr-4" data-toggle="modal" data-target="#form-cine" >
                        <img src="<?php echo ICONS_PATH."book.svg"?>" width="16" height="16" alt="Add" /> Filter
                    </button>
                    </div>
                </form>

                <form action="<?php echo FRONT_ROOT."JobOffer/FilterByCareer"?>" method="POST" class="filter-options">
                    <div class="mb-3"> <!-- filtrar por carrera -->
                    <label for="" class="form-label">Filter by Career</label>
                    <select name="career">
                    <option hidden selected>Click to select filter parameter</option>
                        <?php  // 
                            foreach($careerList as $career){
                                // if($jobPosition->getJobPositionId() == $jobOffer->getJobPositionId()){
                                        ?><option value="<?php echo $career->getDescription();?>"><?php echo $career->getDescription()?></option>       
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-success mr-4" data-toggle="modal" data-target="#form-cine">
                        <img src="<?php echo ICONS_PATH."book.svg"?>" width="16" height="16" alt="Add" /> Filter
                    </button>
                    </div>
                </form>

            </div>


            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Requirementes</th>
                                <th>Responsabilities</th>
                                <th>Profits</th>
                                <th>Salary</th>
                                <th>Company</th>
                                <th>Apply</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php  foreach($jobOfferArray as $jobOffer){   ?>

                            <tr id="row-<?php echo $jobOffer->getJobOfferId(); ?>">

                                <td><?php echo $jobOffer->getTitle(); ?></td>
                                <td><?php echo $jobOffer->getRequirements(); ?></td>
                                <td><?php echo $jobOffer->getResponabilities(); ?></td>
                                <td><?php echo $jobOffer->getProfits(); ?></td>
                                <td><?php echo $jobOffer->getSalary(); ?></td>
                                <?php foreach($companyList as $company){ // feo pero funciona <3
                                    if($company->getId_company() == $jobOffer->getId_company()){
                                        ?><td>
                                    <form method='POST' action="<?php echo FRONT_ROOT."Company/ShowCompanyProfile" ?>">
                                        <button type="submit" class="btn btn-success mr-4" data-toggle="modal"
                                            data-target="#form-cine" name="id"
                                            value="<?php echo $company->getId_company(); ?>">
                                            <?php echo $company->getName();?>
                                        </button>
                                    </form>
                                </td>
                                <?php } ?>
                                <?php } ?> <!-- El boton para aplicar solo se mostrara si no aplico a ese jo offer -->
                                           <!-- Intente de todo para no llamar a la controladora pero no hubo forma -->
                                <?php if(!$jobOfferXStudentController->verifyJobOfferXStudent($jobOffer->getJobOfferId())){ ?>
                                        <th>
                                            <div class="form-group mb-4">
                                                <form action="<?php echo FRONT_ROOT."JobOfferXStudent/ApplyJobOffer"?>">
                                                    <button type="submit" class="btn btn-success mr-4" data-toggle="modal"
                                                        data-target="#form-cine" name="id" value="<?php echo $jobOffer->getJobOfferId(); ?>">
                                                        <img src="<?php echo ICONS_PATH."plus.svg"?>" width="16" height="16"
                                                            alt="Add" /> Apply Here!
                                                    </button>
                                                </form>
                                            </div>
                                        </th><!-- Si ya aplico, se muestra un mensaje de que ya -->
                                <?php } else { ?>
                                            <th>
                                                <div class="form-group mb-4">
                                                    <button type="submit" class="btn btn-success mr-4" data-toggle="modal"
                                                        data-target="#form-cine" name="id" value="<?php echo $jobOffer->getJobOfferId(); ?>">
                                                        <img src="<?php echo ICONS_PATH."plus.svg"?>" width="16" height="16"
                                                            alt="Add" /> Ya Aplicaste
                                                    </button>
                                                </div>
                                            </th>
                                        <?php } ?>
                                    <?php } ?>
                                 <!-- aca va lo de para aplicar al joboffer -->
                            </tr>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</main>



<?php if(isset($message)) { ?>
<div id="message-toast" class="toast showing bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
    style="position:fixed;bottom:0;right:0; min-height:100px; z-index:10000">
    <div class="toast-header bg-danger text-white border-bottom-0">
        <strong class="mr-auto">LinkedIn UTN</strong>
        <button type="button" class="ml-2 mb-1 close text-white" id="btn-close-toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body bg-danger text-white">
        <?php echo $message; ?>
    </div>
</div>
<?php } ?>