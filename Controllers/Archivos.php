<?php
class Archivos extends Controller
{
    private $id_usuario, $correo;
    public function __construct()
    {
        parent::__construct();
        session_start();
        // id del usuario logueado
        $this->id_usuario = $_SESSION['id'];
        $this->correo = $_SESSION['correo'];
    }

    public function index()
    {
        $data['title'] = "Archivos";
        $data['active'] = "Todos";
        $data['script'] = "files.js";
        $data['menu'] = 'admin';
        $data['archivos'] = $this->model->getArchivos(1, $this->id_usuario);

        $carpetas = $this->model->getCarpetas($this->id_usuario);
        for ($i = 0; $i < count($carpetas); $i++) {
            $carpetas[$i]['color'] = substr(md5($carpetas[$i]['id']), 0, 6);
            $carpetas[$i]['fecha'] = time_ago(strtotime($carpetas[$i]['fecha_create']));
        }
        $data['carpetas'] = $carpetas;
        $data['shares'] = $this->model->verificarEstado($this->correo);
        $this->views->getView('archivos', 'index', $data);
    }

    public function getUsuarios()
    {
        $valor = $_GET['q'];
        $data = $this->model->getUsuarios($valor, $this->id_usuario);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['text'] = $data[$i]['correo'];
        }
        echo json_encode($data);
        die();
    }

    public function compartir()
    {
        $usuarios = $_POST['usuarios'];
        if (empty($_POST['archivos'])) {
            $res = array('tipo' => 'warning', 'mensaje' => 'Seleccione un archivo para compartir');
        } else {
            $archivos = $_POST['archivos'];
            $res = 0;
            for ($i = 0; $i < count($archivos); $i++) {
                $archivo = $archivos[$i];
                for ($j = 0; $j < count($usuarios); $j++) {
                    $usuario = $usuarios[$j];
                    $dato = $this->model->getUsuario($usuario);
                    $result = $this->model->getDetalle($dato['correo'], $archivo);
                    if (empty($result)) {
                        $res = $this->model->registrarDetalle($dato['correo'], $archivo, $this->id_usuario);
                    } else {
                        $res = 1;
                    }
                }
            }
            if ($res > 0) {
                $res = array('tipo' => 'success', 'mensaje' => 'Compartido con éxito');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'Error al compartir');
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function verArchivos($id_carpeta)
    {
        $data = $this->model->getArchivosCarpeta($id_carpeta);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscarCarpeta($id)
    {
        $data = $this->model->getCarpeta($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Eliminar archivo recientes
    public function eliminar($id)
    {
        $fecha = date('Y-m-d H:i:s');
        $nueva = date('Y-m-d H:i:s', strtotime($fecha . ' + 1 month'));
        $data = $this->model->eliminar(0, $nueva, $id);
        if ($data == 1) {
            $res = array('tipo' => 'success', 'mensaje' => 'Archivo eliminado con exito');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'Error al eliminar archivo');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Eliminar archivo Compartido
    public function eliminarCompartido($id)
    {
        $fecha = date('Y-m-d H:i:s');
        $nueva = date('Y-m-d H:i:s', strtotime($fecha . ' + 1 month'));
        $data = $this->model->eliminarCompartido($nueva, $id);
        if ($data == 1) {
            $res = array('tipo' => 'success', 'mensaje' => 'Archivo eliminado con exito');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'Error al eliminar archivo');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Filtrar archivos
    public function buscar($valor)
    {
        $data = $this->model->getBusqueda($valor, $this->id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function recicle()
    {
        $data['title'] = "Archivos Eliminados";
        $data['active'] = "Eliminar";
        $data['menu'] = "admin";
        $data['script'] = "deleted.js";

        $data['shares'] = $this->model->verificarEstado($this->correo);
        $this->views->getView('archivos', 'deleted', $data);
    }

    public function listarHistorial()
    {
        $data = $this->model->getArchivos(0, $this->id_usuario);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<a href="#" class="btn btn-outline-danger btn-sm" onclick="restaurar(' . $data[$i]['id'] . ')" title="Editar">Restaurar</a>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function deleted($id)
    {
        $data = $this->model->eliminar(1, null, $id);
        if ($data == 1) {
            $res = array('tipo' => 'success', 'mensaje' => 'Archivo restaurado con exito');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'Error al restaurar archivo');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}













// Solo compartir sin necesidad de usar checkbox
/* public function compartir()
    {
        $id_archivo = $_POST['id_archivo'];
        $usuarios = $_POST['usuarios'];
        $res = 0;
        for ($i = 0; $i < count($usuarios); $i++) {
            $dato = $this->model->getUsuario($usuarios[$i]);
            $result = $this->model->getDetalle($dato['correo'], $id_archivo);
            if (empty($result)) {
                $res = $this->model->registrarDetalle($dato['correo'], $id_archivo, $this->id_usuario);
            } else {
                $res = 1;
            }
        }

        if ($res > 0) {
            $res = array('tipo' => 'success', 'mensaje' => 'Compartido con exito');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'Error al compartir');
        }
        echo json_encode($res);
        die();
    } */