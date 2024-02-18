
let tblArchivos;

document.addEventListener('DOMContentLoaded', () => {
    // Cargar datos con data table
    tblArchivos = $('#tblArchivos').DataTable({
        ajax: {
            url: base_url + 'archivos/listarHistorial',
            dataSrc: ''
        },
        columns: [
            { data: 'accion' },
            { data: 'id' },
            { data: 'nombre' },
            { data: 'tipo' },
            { data: 'fecha_create' },
            { data: 'elimina' }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        responsive: true
    });
});

const restaurar = (id) => {
    const url = base_url + 'archivos/deleted/' + id;
    eliminarRegistro('¿Estas seguro de restaurar el archivo?', 'El archivo aparecerá disponible nuevamente', 'Restaurar', url, tblArchivos);
}