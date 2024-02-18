<?php include_once  'Views/template/header.php' ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1><?php echo $data['title'] ?></h1>
            </div>
        </div>
        <div class="cold-md-12">
            <button class="btn btn-outline-primary btn-lg mb-4" type="button" id="btnNuevo">Nuevo Usuario</button>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tblUsuarios" class="table table-striped table-bordered table-hover table-light display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Id</th>
                                    <th>Nombres</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Perfil</th>
                                    <th>F. Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalRegistro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Usuarios</h5>
                <button class="btn-close text-light btn-lg" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario" autocomplete="off">
                <input type="hidden" id="id_usuario" name="id_usuario">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nombre">Nombre</label>
                            <div class="input-group">
                                <!-- <span class="input-group-text"></span> -->
                                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre del usuario" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido">Apellido</label>
                            <div class="input-group">
                                <!-- <span class="input-group-text"></span> -->
                                <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Nombre del usuario" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="correo">Correo</label>
                            <div class="input-group">
                                <!-- <span class="input-group-text"></span> -->
                                <input class="form-control" type="text" id="correo" name="correo" placeholder="Nombre del usuario" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono">Teléfono</label>
                            <div class="input-group">
                                <!-- <span class="input-group-text"></span> -->
                                <input class="form-control" type="text" id="telefono" name="telefono" placeholder="Nombre del usuario" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="direccion">Dirección</label>
                            <div class="input-group">
                                <!-- <span class="input-group-text"></span> -->
                                <input class="form-control" type="text" id="direccion" name="direccion" placeholder="Nombre del usuario" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="clave">Contraseña</label>
                            <div class="input-group">
                                <!-- <span class="input-group-text"></span> -->
                                <input class="form-control" type="password" id="clave" name="clave" placeholder="Nombre del usuario" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="rol">Rol</label>
                            <div class="input-group">
                                <!-- <span class="input-group-text"></span> -->
                                <select name="rol" id="rol" class="form-control" required>
                                    <option value="1">Administrador</option>
                                    <option value="2">Usuario</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Registrar</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once  'Views/template/footer.php' ?>