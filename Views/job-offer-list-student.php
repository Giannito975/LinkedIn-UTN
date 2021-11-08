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
                                <th>View company details</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php   foreach($jobOfferList as $jobOffer){   ?>

                            <tr id="row-<?php echo $jobOffer->getJobOfferId(); ?>">

                                <td><?php echo $jobOffer->getTitle(); ?></td>
                                <td><?php echo $jobOffer->getRequirements(); ?></td>
                                <td><?php echo $jobOffer->getResponabilities(); ?></td>
                                <td><?php echo $jobOffer->getProfits(); ?></td>
                                <td><?php echo $jobOffer->getSalary(); ?></td>
                                <?php foreach($companyList as $company){ // feo pero funciona <3
                                    if($company->getId_company() == $jobOffer->getId_company()){
                                        ?><td><?php echo $company->getName();?></td>
                                <?php } ?>
                                <?php } ?>
                            </tr>
                            <?php   } ?>

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