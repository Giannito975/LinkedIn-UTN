<body class="background">

<?php
    require_once('header.php');
?>
<form action="<?php echo FRONT_ROOT."Home/Login"?>" method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        <label for="examplePassword" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp">
    </div>
<<<<<<< HEAD
<<<<<<< Updated upstream
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
=======
    <button type="submit" class="btn btn-primary">Login</button>
    <br>
    <a href="<?php echo FRONT_ROOT."Student/ShowRegisterView"?>">Not an user an user yet? Register now!</a>
>>>>>>> Stashed changes
=======
    <button type="submit" class="btn btn-primary">Login</button>
    <br>
    <a href="<?php echo FRONT_ROOT."Student/ShowRegisterView"?>">Not an user an user yet? Register now!</a>
    <a href="<?php echo FRONT_ROOT."Company/CompanyListViewAdmin"?>">fiummba</a>
    <a href="<?php echo FRONT_ROOT."Admin/ModifyCompany"?>">vista modificar company</a>
    <a href="<?php echo FRONT_ROOT."Admin/AdminMainView"?>">vista ppal admin</a>
>>>>>>> dao
</form>

</body>
