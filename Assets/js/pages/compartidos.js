const compartidos = document.querySelectorAll('.compartidos');

document.addEventListener('DOMContentLoaded', () => {
    compartidos.forEach(row => {
        row.addEventListener('click', () => {
            // Capturo el id
            let id_detalle = row.getAttribute('data-id')
            verDetalle(id_detalle)
        });
    });
});

function verDetalle(id_detalle) {
    const http = new XMLHttpRequest();
    const url = base_url + 'compartidos/verDetalle/' + id_detalle;
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = `
            <span class="mailbox-open-date">${res.fecha}</span>
            <h5 class="mailbox-open-title">
                ${res.nombre}
            </h5>
            <div class="mailbox-open-author">
                <img src="${base_url + 'Assets/images/avatars/avatar.png'}" alt="">
                <div class="mailbox-open-author-info">
                    <span class="mailbox-open-author-info-email d-block">${res.compartido}</span>
                    <span class="mailbox-open-author-info-to">To <span class="badge badge-info align-self-center">${res.usuario}</span></span>
                </div>
                <div class="mailbox-open-actions">
                    <a href="#" class="btn btn-danger" onclick="eliminarCompartido(${res.id})">Delete</a>
                </div>
            </div>
            <div class="mailbox-open-content-email">
                <p>Vestibulum vitae max
                </p>
                <div class="mailbox-open-content-email-attachments">
                    <ul class="attachments-files-list list-unstyled">
                        <li class="attachments-files-list-item">
                            <span class="attachments-files-list-item-icon">
                                <i class="material-icons-outlined">insert_drive_file</i>
                            </span>
                            <span class="attachments-files-list-item-content">
                                <span class="attachments-files-list-item-title">${res.nombre}</span>
                                <span class="attachments-files-list-item-size">${res.tipo}</span>
                            </span>
                            <a download="${res.nombre}" href="${base_url + 'Assets/archivos/' + res.id_carpeta + '/' + res.nombre}" class="attachments-files-list-item-download-btn">
                                <i class="material-icons-outlined">
                                    download
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mailbox-open-content-reply">
                <div id="reply-editor"></div>
            </div>`;

            document.getElementById('content-info').innerHTML = html
        }
    };
}

function eliminarCompartido(id) {
    const url = base_url + 'compartidos/eliminar/' + id;
    eliminarRegistro('¿Estas seguro de eliminar el archivo compartido?', 'No podras recuperar el registro', 'Eliminar', url, null);
}