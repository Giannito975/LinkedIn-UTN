<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="Views/css/student-navbar.css" rel="stylesheet">
    <link href="Views/css/estilos.css" rel="stylesheet">

    <title>Linkedin UTN</title>
</head>

<body>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>LinkedIn UTN</title>
<!--            AGREGAR FAVICON PARA EL LINKDEIN UTN
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
-->
        <!-- Custom fonts for this template-->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Oswald:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="<?php echo CSS_PATH; ?>student-navbar.css" rel="stylesheet">
        <link href="<?php echo CSS_PATH; ?>estilos.css" rel="stylesheet">
        <link href="<?php echo CSS_PATH; ?>home.css" rel="stylesheet">
        <link href="<?php echo CSS_PATH; ?>theme.css" rel="stylesheet" type="text/css">
    </head>

    <body class="bg-gradient-primary" id="page-top">
        
            <?php if(!isset($_SESSION['loggedAdmin'])){ ?>
              <a href="<?php echo FRONT_ROOT."Home/Login"?>"></a>
              <?php }
              elseif(!isset($_SESSION['loggedUser'])){ ?>
                <a href="<?php echo FRONT_ROOT."Home/Login"?>"></a>
              <?php } ?>
              <!-- CAMBIAR TODO ESTO DE LOS HREF POR LOS CONTROLADORES QUE CORRESPONDA -->
          </div>

    </html>