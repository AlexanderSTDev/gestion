// Camniar contraseña
const frmPass = document.getElementById('frmPass');
const clave_actual = document.getElementById('clave_actual')
const clave_nueva = document.getElementById('clave_nueva')
const clave_confirmar = document.getElementById('clave_confirmar')

// Cambiar datos del usuario
const frmProfile = document.getElementById('frmProfile');
const nombre = document.getElementById('nombre');
const apellido = document.getElementById('apellido');
const correo = document.getElementById('correo');
const telefono = document.getElementById('telefono');
const direccion = document.getElementById('direccion');

document.addEventListener('DOMContentLoaded', () => {
    frmPass.addEventListener('submit', (e) => {
        e.preventDefault();
        if (clave_actual.value == '' || clave_nueva.value == '' || clave_confirmar.value == '') {
            alertaPersonalizada('error', 'Todos los campos son obligatorios');
        } else {
            if (clave_nueva.value != clave_confirmar.value) {
                alertaPersonalizada('error', 'Las contraseñas no coinciden');
            } else {
                const data = new FormData(frmPass);
                const http = new XMLHttpRequest();
                const url = base_url + 'usuarios/cambiarPass';
                http.open("POST", url, true);
                http.send(data);
                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        alertaPersonalizada(res.tipo, res.mensaje);
                        if (res.tipo == 'success') {
                            setTimeout(() => {
                                window.location = base_url + 'usuarios/salir';
                            }, 1000);
                        }
                    }
                }
            }
        }
    });

    frmProfile.addEventListener('submit', (e) => {
        e.preventDefault();
        if (nombre.value == '' || apellido.value == '' || correo.value == '' || telefono.value == '' || direccion.value == '') {
            alertaPersonalizada('error', 'Todos los campos son obligatorios');
        } else {
            const data = new FormData(frmProfile);
            const http = new XMLHttpRequest();
            const url = base_url + 'usuarios/cambiarProfile';
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);

                }
            }
        }
    });
});