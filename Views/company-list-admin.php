<?php
        if(!isset($_SESSION["loggedAdmin"])) {
            header("location: ".FRONT_ROOT."Home/HomeView");
        }
?>

<?php
        require_once('header.php');
        require_once('admin-nav.php');
    ?>
<main class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading 
        <h1 class="h3 mb-2 text-gray-800"> <?php //echo "$validMessage"; ?> </h1>-->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Company list</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="form-group mb-4">
                        <form action="<?php echo FRONT_ROOT."Company/ShowCreateCompanyView"?>">
                            <button type="submit" class="btn btn-success mr-4" data-toggle="modal"
                                data-target="#form-cine">
                                <img src="<?php echo ICONS_PATH."plus.svg"?>" width="16" height="16" alt="Add" /> Add
                                Company
                            </button>
                        </form>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>About Us</th>
                                <th>Company Link</th>
                                <th>Email</th>
                                <th>Industry</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Remove/Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php   foreach($companyList as $company){   ?>

                            <tr id="row-<?php echo $company->getId_company(); ?>">

                                <td><?php echo $company->getName(); ?></td>
                                <td><?php echo $company->getAbout_us(); ?></td>
                                <td><?php echo $company->getCompany_link(); ?></td>
                                <td><?php echo $company->getEmail(); ?></td>
                                <td><?php echo $company->getIndustry(); ?></td>
                                <td><?php echo $company->getCity(); ?></td>
                                <td><?php echo $company->getCountry(); ?></td>

                                <td>
                                    <div class="form-inline">
                                        <form action="<?php echo FRONT_ROOT."Company/RemoveCompany"?>" method="POST">
                                            <button type="submit" name="id" class="btn btn-danger"
                                                value="<?php echo $company->getId_company(); ?>">
                                                <img src="<?php echo ICONS_PATH."trash-2.svg"?>" width="16" height="16"
                                                    alt="Remove" />
                                            </button>
                                        </form>

                                        <form action="<?php echo FRONT_ROOT."Company/ShowModifyCompanyView"?>">
                                            <button class="btn btn--edit btn-info ml-4 " type="submit" name="id"
                                                data-id="<?php echo $company->getId_company(); ?>" data-toggle="modal"
                                                data-target="#form-cine"
                                                value="<?php echo $company->getId_company();?>">
                                                <img src="<?php echo ICONS_PATH."edit.svg"?>" width="16" height="16"
                                                    alt="Update" />
                                            </button>
                                        </form>
                                    </div>
                                </td>

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

<!-- add company -->
<div class="modal fade" id="form-cine" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form class="modal-content" action="<?php echo FRONT_ROOT ?>Company/ShowCreateCompanyView" method="POST">
            <div class="modal-header">
                <h5 class="modal-title">Add Company</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
        </form>
    </div>

    <div class="modal-body">

        <div class="form-group">
            <label>Nombre</label>
            <input pattern="[a-zA-Z\s]+" title="Please enter on alphabets only" type="text" class="form-control"
                name="name" required />
        </div>

        <div class="form-group">
            <label>Direccion</label>
            <input pattern="[a-zA-Z0-9\s]+" title="Please enter on alphabets only" type="text" class="form-control"
                name="adress" required />
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark">Add</button>
    </div>

    <input type="hidden" name="id" value="" />

    </form>

</div>
</div>

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