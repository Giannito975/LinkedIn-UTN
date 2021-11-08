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
                <h6 class="m-0 font-weight-bold text-primary">Applicants list</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Dni</th>
                                <th>File Number</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php  foreach($studentsArray as $student){?>
                            <tr id="row-<?php echo $student->getIdStudent(); ?>">

                                <td><?php echo $student->getFirstName(); ?></td>
                                <td><?php echo $student->getLastName(); ?></td>
                                <td><?php echo $student->getDni(); ?></td>
                                <td><?php echo $student->getFileNumber(); ?></td>
                                <td><?php echo $student->getGender(); ?></td>
                                <td><?php echo $student->getBirthdate(); ?></td>
                                <td><?php echo $student->getPhoneNumber(); ?></td>
                                <td><?php echo $student->getEmail(); ?></td>
                                
                             
                                

                                <!--<td>
                                    <div class="form-inline">
                                        <form action="<?//php echo FRONT_ROOT."Company/RemoveCompany"?>" method="POST">
                                            <button type="submit" name="id" class="btn btn-danger"
                                                value="<?//php echo $company->getId_company(); ?>">
                                                <img src="<?//php echo ICONS_PATH."trash-2.svg"?>" width="16" height="16"
                                                    alt="Remove" />
                                            </button>
                                        </form>
                                    </div>
                                </td>-->

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