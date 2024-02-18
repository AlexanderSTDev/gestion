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
    <title><?php echo $data['title']; ?></title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>Assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>Assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>Assets/plugins/pace/pace.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?php echo BASE_URL; ?>Assets/css/main.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>Assets/css/darktheme.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>Assets/css/custom.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>Assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>Assets/images/neptune.png" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="#"><?php echo $data['title']; ?></a>
            </div>
            <p class="auth-description">Inicie sesión en su cuenta y continúe hasta el panel.<br>¿No tienes una cuenta? <a href="sign-up.html">Inscribirse</a></p>

            <form action="" id="formulario" autocomplete="off">
                <div class="auth-credentials m-b-xxl">
                    <label for="correo" class="form-label">Dirección de correo electrónico <span class="text-danger">*</span></label>
                    <input type="email" class="form-control m-b-md" id="correo" name="correo" aria-describedby="correo" placeholder="example@neptune.com">

                    <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                </div>

                <div class="auth-submit">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    <a href="#" class="auth-forgot-password float-end" id="reset">¿Has olvidado tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Olvidaste tu contraseña?</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="inputReset" class="form-label">Ingresa tu correo electronico></label>
                    <input type="text" class="form-control" id="inputReset" name="inputReset" placeholder="example@neptune.com">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-outline-primary" id="resetPassword">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="<?php echo BASE_URL; ?>Assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/plugins/pace/pace.min.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/js/sweetalert2@11.js"></script>
    <!-- <script src="<?php echo BASE_URL; ?>Assets/js/main.min.js"></script> -->
    <!-- <script src="<?php echo BASE_URL; ?>Assets/js/alertas.js"></script> -->
    <script src="<?php echo BASE_URL; ?>Assets/js/custom.js"></script>
    <script>
        const base_url = <?php echo json_encode(BASE_URL); ?>
    </script>
    <script src="<?php echo BASE_URL; ?>Assets/js/pages/login.js"></script>
</body>

</html>