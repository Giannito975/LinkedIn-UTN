<div class="user-register-form">
    <?php
        require_once('header.php');
    ?>
    <form action="<?php echo FRONT_ROOT."Student/updatePassword"?>" method="POST">
        <h3>Register Form</h3>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <br><br>
        <a class="btn btn-primary" href="<?php echo FRONT_ROOT."Home/Index"?>">Home</a>
    </form>
</div>