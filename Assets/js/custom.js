// Here goes your custom javascript
const inputBuscar = document.getElementById('inputBuscar');
const container_result = document.getElementById('container-result');

document.addEventListener('DOMContentLoaded', () => {
    inputBuscar.addEventListener('keyup', (e) => {
        if (e.target.value.length > 2) {
            buscarArchivos(e.target.value);
        }
    });

    inputBuscar.addEventListener('blur', (e) => {
        e.target.value = '';
        container_result.innerHTML = '';
    });
})

const alertaPersonalizada = (type, mensaje) => {
    Swal.fire({
        position: "top-end",
        icon: type,
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
    });
}

const eliminarRegistro = (title, text, accion, url, table) => {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: accion
    }).then((result) => {
        if (result.isConfirmed) {
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        if (table != null) {
                            table.ajax.reload();
                        } else {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    }
                }
            };
        }
    });
}

function buscarArchivos(valor) {
    const url = base_url + 'archivos/buscar/' + valor;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = `<div class="card">
                            <div class="card-body">`;
            if (res.length > 0) {
                res.forEach(archivo => {
                    html += `
                                <h5 class="card-title"><a href="${base_url + 'Assets/archivos/' + archivo.id_carpeta + '/' + archivo.nombre}" download="${archivo.nombre}">${archivo.nombre}</a></h5> <hr>
                    `;
                });
                html += `</div>
                    </div>`;
            } else {
                html = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">No se encontraron resultados</h5>
                        </div>
                    </div>
                `;
            }

            container_result.innerHTML = html;
        }
    };
}

// Deotra manera
/* alertaPersonalizada('success', 'Hola mensaje de prueba');
function alertaPersonalizada(type, mensaje) {
    Swal.fire({
        position: "top-end",
        icon: type,
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
    });
} */