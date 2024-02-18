<!-- Modal para subir archivos -->
<div id="modalFile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Subir o crear carpeta</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-grid">
                    <button id="btnNuevaCarpeta" type="button" class="btn btn-outline-primary m-r-xs"><i class="material-icons">folder</i>Nueva Carpeta</button>
                    <hr>
                    <input type="file" class="d-none" name="file" id="file">
                    <button id="btnSubirArchivo" type="button" class="btn btn-outline-success m-r-xs"><i class="material-icons">folder_zip</i>Subir Archivo</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para crear nueva carpeta -->
<div id="modalCarpeta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittle-carpeta">Nueva carpeta</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmCarpeta" autocomplete="off">
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-text"><i class="material-icons">folder</i></span>
                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="nombre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para compartir -->
<div id="modalCompartir" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittle-compartir"></h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_carpeta">
                <div class="d-grid">
                    <a id="btnVer" href="#" class="btn btn-outline-info m-r-xs"><i class="material-icons">visibility</i>Ver</a>
                    <hr>
                    <button id="btnSubir" type="button" class="btn btn-outline-primary m-r-xs"><i class="material-icons">folder_zip</i>Subir archivo</button>
                    <hr>
                    <button id="btnCompartir" type="button" class="btn btn-outline-success m-r-xs"><i class="material-icons">share</i>Compartir</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para compartir entre usuarios -->
<div id="modalUsuarios" class="modal fade" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittle-usuarios">Agregar usuarios</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="frmCompartir">
                <div class="modal-body">

                    <select id="usuarios" name="usuarios[]" class="js-states form-control" tabindex="-1" style="display: none; width: 100%" multiple="multiple">
                    </select>
                    <hr>

                    <div class="accordion accordion-flush mb-3" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Seleccionar archivos a compartir
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div id="container-archivos">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="text-center">
                        <a href="#" class="btn btn-outline-info" id="btnVerDetalle">Ver detalle</a>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Compartir</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>