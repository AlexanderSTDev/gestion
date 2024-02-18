const frm = document.getElementById('formulario');
const btnNuevo = document.getElementById('btnNuevo');
const title = document.getElementById('title');
const modalRegistro = document.getElementById('modalRegistro');
// levantar el modal
const myModal = new bootstrap.Modal(modalRegistro);

let tblUsuarios;

document.addEventListener('DOMContentLoaded', () => {
    // Cargar datos con data table
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + 'usuarios/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'acciones' },
            { data: 'id' },
            { data: 'nombres' },
            { data: 'correo' },
            { data: 'telefono' },
            { data: 'direccion' },
            { data: 'perfil' },
            { data: 'fecha' }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        responsive: true
    });
    // Levantar el modal
    btnNuevo.addEventListener('click', () => {
        title.innerHTML = 'Nuevo usuario';
        frm.id_usuario.value = '';
        frm.reset();
        frm.clave.removeAttribute('readonly');
        myModal.show();
    });
    // Registrar usuario por ajax
    frm.addEventListener('submit', (e) => {
        e.preventDefault();
        if (frm.nombre.value == '' || frm.apellido.value == '' || frm.correo.value == '' || frm.telefono.value == '' || frm.direccion.value == '' || frm.clave.value == '' || frm.rol.value == '') {
            alertaPersonalizada('error', 'Todos los campos son obligatorios');
        } else {
            const data = new FormData(frm);
            const http = new XMLHttpRequest();
            const url = base_url + 'usuarios/guardar';
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        frm.reset();
                        myModal.hide();
                        tblUsuarios.ajax.reload();
                    }
                }
            };
        }
    });
});

const eliminar = (id) => {
    const url = base_url + 'usuarios/delete/' + id;
    eliminarRegistro('¿Estas seguro?', 'No podras recuperar el registro', 'Eliminar', url, tblUsuarios);
}

const editar = (id) => {
    const url = base_url + 'usuarios/editar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            title.innerHTML = 'Editar usuario';
            frm.id_usuario.value = res.id;
            frm.nombre.value = res.nombre;
            frm.apellido.value = res.apellido;
            frm.correo.value = res.correo;
            frm.telefono.value = res.telefono;
            frm.direccion.value = res.direccion;
            frm.clave.value = '00000000000';
            frm.clave.setAttribute('readonly', 'readonly');
            frm.rol.value = res.rol;
            title.innerHTML = 'Editar usuario';
            myModal.show();
        }
    };
}