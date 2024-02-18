// levantar el modal subir o crear carpeta
const btnUpload = document.getElementById('btnUpload');
const modalFile = document.getElementById('modalFile');
const myModal = new bootstrap.Modal(modalFile);

// levantar el modal carpeta
const btnNuevaCarpeta = document.getElementById('btnNuevaCarpeta');
const modalCarpeta = document.getElementById('modalCarpeta');
const myModalCarpeta = new bootstrap.Modal(modalCarpeta);

// levantar el modal subir
const btnSubirArchivo = document.getElementById('btnSubirArchivo');
const file = document.getElementById('file');

// levantar el modal para compartir
const btnSubir = document.getElementById('btnSubir');
const modalCompartir = document.getElementById('modalCompartir');
const myModalCompartir = new bootstrap.Modal(modalCompartir);
const idCarpeta = document.getElementById('id_carpeta');
const carpetas = document.querySelectorAll('.carpetas');

// levantar modal para compatir por carpeta
const btnCompartir = document.getElementById('btnCompartir');
const containerArchivos = document.getElementById('container-archivos');

// Ver archivos
const btnVer = document.getElementById('btnVer');

// Compartir archivos entre usuarios
const compartir = document.querySelectorAll('.compartir');

// levantar modal para compartir archivos entre usuarios
const modalUsuarios = document.getElementById('modalUsuarios');
const myModalUsuarios = new bootstrap.Modal(modalUsuarios);
const idArchivo = document.getElementById('id_archivo');

const frmCarpeta = document.getElementById('frmCarpeta');
const frmCompartir = document.getElementById('frmCompartir');
const usuarios = document.getElementById('usuarios');

const btnVerDetalle = document.getElementById('btnVerDetalle');
const content_acordeon = document.querySelector('#accordionFlushExample')

// Eliminar archivos recientes
const eliminar = document.querySelectorAll('.eliminar');

document.addEventListener('DOMContentLoaded', () => {

    btnUpload.addEventListener('click', () => {
        myModal.show();
    });

    btnNuevaCarpeta.addEventListener('click', () => {
        myModal.hide();
        myModalCarpeta.show();
    });

    frmCarpeta.addEventListener('submit', (e) => {
        e.preventDefault();
        if (frmCarpeta.nombre.value == '') {
            alertaPersonalizada('error', 'El nombre es requerido');
        } else {
            const data = new FormData(frmCarpeta);
            const http = new XMLHttpRequest();
            const url = base_url + 'admin/crearCarpeta';
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                }
            };
        }
    });

    btnSubirArchivo.addEventListener('click', () => {
        myModal.hide();
        file.click();
    });

    file.addEventListener('change', (e) => {
        console.log(e);
        const data = new FormData(frmCarpeta);
        data.append('id_carpeta', idCarpeta.value);
        data.append('file', e.target.files[0]);
        const http = new XMLHttpRequest();
        const url = base_url + 'admin/subirArchivo';
        http.open("POST", url, true);
        http.send(data);
        http.onreadystatechange = function () {

            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                alertaPersonalizada(res.tipo, res.mensaje);
                if (res.tipo == 'success') {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            }
        };
    });

    carpetas.forEach(carpeta => {
        carpeta.addEventListener('click', () => {
            idCarpeta.value = carpeta.getAttribute('data-id');
            myModalCompartir.show();
            console.log('click');
        });
    });

    btnSubir.addEventListener('click', () => {
        myModalCompartir.hide();
        file.click();
    });

    btnVer.addEventListener('click', () => {
        window.location = base_url + 'admin/ver/' + idCarpeta.value;
    });

    $('.js-states').select2({
        theme: 'bootstrap-5',
        placeholder: 'Buscar y agregar usuarios',
        maximumSelectionLength: 5,
        minimumInputLength: 2,
        dropdownParent: $('#modalUsuarios'),

        ajax: {
            url: base_url + 'archivos/getUsuarios',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {

                return {
                    results: data
                };
            },
            cache: true
        },
    });

    compartir.forEach(enlace => {
        enlace.addEventListener('click', () => {
            // window.location = base_url + 'admin/compartir/' + enlace.getAttribute('data-id');
            compartirArchivo(enlace.getAttribute('data-id'));
        });
    });

    frmCompartir.addEventListener('submit', (e) => {
        e.preventDefault();
        if (usuarios.value == '') {
            alertaPersonalizada('error', 'Todos los campos son obligatorios');
        } else {
            const data = new FormData(frmCompartir);
            const http = new XMLHttpRequest();
            const url = base_url + 'archivos/compartir';
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        $('.js-states').val(null).trigger('change');
                        myModalUsuarios.hide();
                    }
                }
            };
        }
    })

    // Compartir archivos por carpeta mediante el modal
    btnCompartir.addEventListener('click', () => {
        verArchivo();
    })

    // Ver detalle compartido
    btnVerDetalle.addEventListener('click', () => {
        window.location = base_url + 'admin/verdetalle/' + idCarpeta.value;
    })

    // Eliminar archivo reciente
    eliminar.forEach(enlace => {
        enlace.addEventListener('click', () => {
            let id = enlace.getAttribute('data-id');
            const url = base_url + 'archivos/eliminar/' + id;
            eliminarRegistro('¿Estas seguro de eliminar el archivo compartido?', 'No podras recuperar el registro', 'Eliminar', url, null);
        });
    })
});

const compartirArchivo = (id_archivo) => {
    const http = new XMLHttpRequest();
    const url = base_url + 'archivos/buscarCarpeta/' + id_archivo;
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            idCarpeta.value = res.id_carpeta;
            content_acordeon.classList.add('d-none');
            containerArchivos.innerHTML = `<input type="hidden" value="${res.id}" name="archivos[]">`;
            myModalUsuarios.show();
        }
    };
}

function verArchivo() {
    const http = new XMLHttpRequest();
    const url = base_url + 'archivos/verArchivos/' + idCarpeta.value;
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            if (res.length > 0) {
                content_acordeon.classList.remove('d-none');
                res.forEach(archivo => {
                    html += `
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="${archivo['id']}" name="archivos[]" id="flexCheckDefault_${archivo['id']}"">
                            <label class="form-check-label" for="flexCheckDefault_${archivo['id']}">
                                ${archivo['nombre']}
                            </label>
                        </div>
                    `;
                });
                // cargarDetalle(idCarpeta.value);
            } else {
                html = `
                    <div class="alert alert-custom alert-indicator-right indicator-warning" role="alert">
                        <div class="alert-content">
                            <span class="alert-title">Warning!</span>
                            <span class="alert-text">Carpeta vacía</span>
                        </div> 
                    </div>
                `;
            }
            containerArchivos.innerHTML = html;
            myModalCompartir.hide();
            myModalUsuarios.show();
        }
    };
}
