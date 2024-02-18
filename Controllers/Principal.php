<?php
class Principal extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = "Iniciar Sesion";
        $this->views->getView('principal', 'index', $data);
    }

    // Funcion para iniciar sesion
    public function validar()
    {
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $data = $this->model->getUsuario($correo);
        if (!empty($data)) {
            if (password_verify($password, $data['clave'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['correo'] = $data['correo'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['correo'] = $data['correo'];
                $res = array('tipo' => 'success', 'mensaje' => 'Bienvenido ' . $data['nombre'] . ' al gestor de archivos');
            } else {
                $res = array('tipo' => 'warning', 'mensaje' => 'Contraseña incorrecta');
            }
        } else {
            $res = array('mensaje' => 'El correo no existe');
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
