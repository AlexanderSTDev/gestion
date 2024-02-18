const frm = document.getElementById('formulario');
const correo = document.getElementById('correo');
const password = document.getElementById('password');

// Recuperar contraseña
const inputReset = document.getElementById('inputReset');
const btnReset = document.getElementById('resetPassword');
// Levantar el modal
const reset = document.getElementById('reset');
const modaReset = document.getElementById('myModal');
const myModal = new bootstrap.Modal(modaReset);

document.addEventListener('DOMContentLoaded', () => {
    frm.addEventListener('submit', (e) => {
        e.preventDefault();
        if (correo.value === '' || password.value === '') {
            alertaPersonalizada('error', 'Todos los campos son obligatorios');
        } else {
            const data = new FormData(frm);

            const http = new XMLHttpRequest();
            const url = base_url + 'principal/validar';

            http.open("POST", url, true);

            http.send(data);

            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);

                    if (res.tipo === 'success') {
                        let timerInterval;
                        Swal.fire({
                            title: res.mensaje,
                            html: "Será redirigido en <b></b> milliseconds.",
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                    timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location = base_url + 'admin';
                            }
                        });
                    }
                }

            };

        }
    });

    reset.addEventListener('click', () => {
        inputReset.value = '';
        myModal.show();
    })

    btnReset.addEventListener('click', () => {
        if (inputReset.value === '') {
            alertaPersonalizada('error', 'Ingrese el correo');
        } else {
            const http = new XMLHttpRequest();
            const url = base_url + 'principal/enviarCorreo' + '/' + inputReset.value;
            http.open("POST", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        inputReset.value = '';
                        myModal.hide();
                    }
                }
            };
        }
    })
});