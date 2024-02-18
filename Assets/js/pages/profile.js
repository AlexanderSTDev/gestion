const frmPass = document.getElementById('frmPass');
const clave_actual = document.getElementById('clave_actual')
const clave_nueva = document.getElementById('clave_nueva')
const clave_confirmar = document.getElementById('clave_confirmar')

document.addEventListener('DOMContentLoaded', () => {
    frmPass.addEventListener('submit', (e) => {
        e.preventDefault();
        if (clave_actual.value == '' || clave_nueva.value == '' || clave_confirmar.value == '') {
            alertaPersonalizada('error', 'Todos los campos son obligatorios');
        } else {
            if (clave_nueva.value != clave_confirmar.value) {
                alertaPersonalizada('error', 'Las contraseñas no coinciden');
            } else {
                console.log(clave_actual.value, clave_nueva.value, clave_confirmar.value);
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
                            console.log(this.responseText);
                            setTimeout(() => {
                                window.location = base_url + 'usuarios/salir';
                            }, 1000);
                        }
                    }
                }
            }
        }
    });
});