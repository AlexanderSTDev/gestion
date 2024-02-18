<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?php echo $data['title'] ?></title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>Assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>Assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>Assets/plugins/pace/pace.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?php echo BASE_URL ?>Assets/css/main.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>Assets/css/darktheme.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>Assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>Assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>Assets/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>Assets/css/select2-bootstrap-5-theme.rtl.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL ?>Assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>Assets/images/neptune.png" />
</head>

<body>

    <div class="app app-error align-content-stretch d-flex flex-wrap">
        <div class="app-error-info">
            <h5>Oops!</h5>
            <h3><?php echo $data['title'] ?></h3>
            <span>Parece que la página que buscas ya no existe.<br>
                Haremos todo lo posible para solucionar este problema pronto.</span>
            <a href="<?php echo BASE_URL . 'admin' ?>" class="btn btn-dark">Regresar al inicio</a>
        </div>
        <div class="app-error-background"></div>
    </div>

</body>

</html>