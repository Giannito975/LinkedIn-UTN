<body class="background">

<?php
    require_once('header.php');
?>
<form action="">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
        <label for="examplePassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" aria-describedby="passwordHelp">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <br>
    <a href="<?php echo FRONT_ROOT."Student/ShowRegisterView"?>">Not an user an user yet? Register now!</a>
</form>

</body>
