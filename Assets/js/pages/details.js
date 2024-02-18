const id_carpeta = document.getElementById('id_carpeta');
let tbl;
document.addEventListener('DOMContentLoaded', () => {
    tbl = $('#tblDetalle').DataTable({
        ajax: {
            url: base_url + 'admin/listarDetalle/' + id_carpeta.value,
            dataSrc: ''
        },
        columns: [
            { data: 'acciones' },
            { data: 'correo' },
            { data: 'nombre' },
            { data: 'estado' }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        responsive: true,
        destroy: true
        // scrollY: '150px'
    });
})

function eliminarDetalle(id) {
    const url = base_url + 'archivos/eliminarCompartido/' + id;
    eliminarRegistro('¿Estas seguro de eliminar el archivo compartido?', 'No podras recuperar el registro', 'Eliminar', url, tbl);
}