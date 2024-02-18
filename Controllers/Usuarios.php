<?php
class Usuarios extends Controller
{
    private $id_usuario, $correo;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->id_usuario = $_SESSION['id'];
        $this->correo = $_SESSION['correo'];
    }

    public function index()
    {
        $data['title'] = "Gestión de usuarios";
        $data['script'] = "usuarios.js";
        $data['menu'] = "usuarios";
        $data['shares'] = $this->model->verificarEstado($this->correo);
        $this->views->getView('usuarios', 'index', $data);
    }

    // Listar usuarios
    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '
            <div>
            <a href="#" class="btn btn-outline-primary btn-sm" onclick="editar(' . $data[$i]['id'] . ')" title="Editar"><span class="material-icons md-18">edit</span></a>
            <a href="#" class="btn btn-outline-danger btn-sm" onclick="eliminar(' . $data[$i]['id'] . ')" title="Editar"><span class="material-icons md-18">delete</span></a>
            ';
            $data[$i]['nombres'] = $data[$i]['nombre'] . ' ' . $data[$i]['apellido'];
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function guardar()
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $clave = $_POST['clave'];
        $rol = $_POST['rol'];
        $id_usuario = $_POST['id_usuario'];
        if (empty($nombre) || empty($apellido) || empty($correo) || empty($telefono) || empty($direccion) || empty($clave) || empty($rol)) {
            $res = array('tipo' => 'warning', 'mensaje' => 'Todos los campos son requeridos por favor');
        } else {
            if ($id_usuario == '') {
                // Comprobar si existe datos
                $verificarCorreo = $this->model->getVerificar('correo', $correo, 0);
                if (empty($verificarCorreo)) {
                    // Comprobar si existe telefono
                    $verificarTel = $this->model->getVerificar('telefono', $telefono, 0);
                    if (empty($verificarTel)) {
                        $hash = password_hash($clave, PASSWORD_DEFAULT);
                        $data = $this->model->guardar($nombre, $apellido, $correo, $telefono, $direccion, $hash, $rol);
                        if ($data > 0) {
                            $res = array('tipo' => 'success', 'mensaje' => 'Usuario registrado');
                        } else {
                            $res = array('tipo' => 'error', 'mensaje' => 'Error al registrar usuario');
                        }
                    } else {
                        $res = array('tipo' => 'warning', 'mensaje' => 'El teléfono ya existe');
                    }
                } else {
                    $res = array('tipo' => 'warning', 'mensaje' => 'El correo ya existe');
                }
            } else {
                // Modificando
                // Comprobar si existe datos
                $verificarCorreo = $this->model->getVerificar('correo', $correo, $id_usuario);
                if (empty($verificarCorreo)) {
                    // Comprobar si existe telefono
                    $verificarTel = $this->model->getVerificar('telefono', $telefono, $id_usuario);
                    if (empty($verificarTel)) {
                        $hash = password_hash($clave, PASSWORD_DEFAULT);
                        $data = $this->model->modificar($nombre, $apellido, $correo, $telefono, $direccion,  $rol, $id_usuario);
                        if ($data == 1) {
                            $res = array('tipo' => 'success', 'mensaje' => 'Usuario modificado');
                        } else {
                            $res = array('tipo' => 'error', 'mensaje' => 'Error al modificar usuario');
                        }
                    } else {
                        $res = array('tipo' => 'warning', 'mensaje' => 'El teléfono ya existe');
                    }
                } else {
                    $res = array('tipo' => 'warning', 'mensaje' => 'El correo ya existe');
                }
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($id)
    {
        $data = $this->model->delete($id);
        if ($data == 1) {
            $res = array('tipo' => 'success', 'mensaje' => 'Usuario dado de baja');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'Error al eliminar usuario');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    public function editar($id)
    {
        $data = $this->model->editar($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function profile()
    {
        $data['title'] = "Perfil del usuario";
        $data['script'] = "profile.js";
        $data['menu'] = "usuarios";
        $data['shares'] = $this->model->verificarEstado($this->correo);
        $this->views->getView('usuarios', 'perfil', $data);
    }

    public function cambiarPass()
    {
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['clave_confirmar'];
        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $res = array('tipo' => 'warning', 'mensaje' => 'Todos los campos son requeridos por favor');
        } else {
            if ($nueva != $confirmar) {
                $res = array('tipo' => 'warning', 'mensaje' => 'Las contrasañas no coinciden');
            } else {
                $consulta = $this->model->getUsuario($this->id_usuario);
                if (password_verify($actual, $consulta['clave'])) {
                    $hash = password_hash($nueva, PASSWORD_DEFAULT);
                    $data = $this->model->cambiarPass($hash, $this->id_usuario);
                    if ($data == 1) {
                        $res = array('tipo' => 'success', 'mensaje' => 'Contrasena modificada');
                    } else {
                        $res = array('tipo' => 'error', 'mensaje' => 'Error al modificar contrasena');
                    }
                } else {
                    $res = array('tipo' => 'warning', 'mensaje' => 'La contrasena actual no coincide');
                }
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header("Location: " . BASE_URL);
    }
}
