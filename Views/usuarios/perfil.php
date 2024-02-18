<?php include_once  'Views/template/header.php' ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-description  page-description-tabbed">
                <h1><?php echo $data['title'] ?></h1>

                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="hoaccountme" aria-selected="true">Tus Datos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">Credenciales</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <form id="frmProfile">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="correo" class="form-label">Correo Electronico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" placeholder="example@neptune.com" value="<?php echo $data['usuario']['correo'] ?>">
                                        <div id="settingsEmailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono" class="form-label">Numero de Telefono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="(xxx) xxx-xxxx" value="<?php echo $data['usuario']['telefono'] ?>">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="John" value="<?php echo $data['usuario']['nombre'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="apellido" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Doe" value="<?php echo $data['usuario']['apellido'] ?>">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <textarea class="form-control" id="direccion" name="direccion" maxlength="500" rows="4"><?php echo $data['usuario']['direccion'] ?></textarea>
                                        <div id="emailHelp" class="form-text">Brief information about you to display on profile (max: 500 characters)</div>
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col">
                                        <button type="submit" class="btn btn-outline-primary m-t-sm">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Credenciales -->
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    <form id="frmPass">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-t-xxl">
                                    <div class="col-md-6">
                                        <label for="clave_actual" class="form-label">Contraseña Actual</label>
                                        <input id="clave_actual" name="clave_actual" type="password" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                        <div id="settingsCurrentPassword" class="form-text">Never share your password with anyone.</div>
                                    </div>
                                </div>
                                <div class="row m-t-xxl">
                                    <div class="col-md-6">
                                        <label for="clave_nueva" class="form-label">Nueva Contraseña</label>
                                        <input id="clave_nueva" name="clave_nueva" type="password" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                    </div>
                                </div>
                                <div class="row m-t-xxl">
                                    <div class="col-md-6">
                                        <label for="clave_confirmar" class="form-label">Confirmar Contraseña</label>
                                        <input id="clave_confirmar" name="clave_confirmar" type="password" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col">
                                        <button type="submit" class="btn btn-outline-primary m-t-sm">Cambiar Contraseña</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once  'Views/template/footer.php' ?>