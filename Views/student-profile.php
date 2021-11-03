<div class="student-profile-background">
    <?php
    require_once('header.php');
    require_once('student-nav.php')
    ?>
    <h3>aca va el perfil del estudiante</h3>
    <div>
    <table class="table bg-light-alpha">
                    <thead>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Dni</th>
                         <th>File Number</th>
                         <th>Gender</th>
                         <th>Birthdate</th>
                         <th>Phone Number</th>
                         <th>Email</th>
                    </thead>
                    <tbody>
                         <tr>
                              <?php foreach($studentList as $student){?>
                                        <td><?php echo $student->getFirstName(); ?></td>
                                        <td><?php echo $student->getLastName(); ?></td>
                                        <td><?php echo $student->getDni(); ?></td>
                                        <td><?php echo $student->getFileNumber(); ?></td>
                                        <td><?php echo $student->getGender(); ?></td>
                                        <td><?php echo $student->getBirthDate(); ?></td>
                                        <td><?php echo $student->getPhoneNumber(); ?></td>
                                        <td><?php echo $student->getEmail(); ?></td>
                         </tr>
                         <tr>
                              <?php } ?>
                         </tr>
                    </tbody>
               </table>
    </div>
</div>