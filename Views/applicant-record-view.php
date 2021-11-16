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
                <h6 class="m-0 font-weight-bold text-primary">Applied Job Offers List</h6>
            </div>
            <div class="go-back-btn">
                <a href="<?php echo FRONT_ROOT."Student/ShowProfileStudentView" ?>">
                    Go Back
                </a>
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
                            </tr>
                        </thead>

                        <tbody>
                            <?php   foreach($jobOfferArray as $jobOffer){   ?>

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
                                <?php } ?> 
                            </tr>
                            <?php } ?> 
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</main>