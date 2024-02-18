<?php
class Admin extends Controller
{
    private $id_usuario, $correo;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->id_usuario = $_SESSION['id'];
        $this->correo = $_SESSION['correo'];

        // Eliminar archivos de forma permanente
        $fecha = date('Y-m-d H:i:s');
        $eliminar = $this->model->getConsultar($fecha);
        $ruta = 'Assets/archivos/';
        for ($i = 0; $i < count($eliminar); $i++) {
            if ($eliminar[$i]['elimina'] < $fecha) {
                $accion = $this->model->eliminarRegistro($eliminar[$i]['id']);
                if ($accion == 1) {
                    if (file_exists($ruta . $eliminar[$i]['id_carpeta'] . '/' . $eliminar[$i]['nombre'])) {
                        unlink($ruta . $eliminar[$i]['id_carpeta'] . '/' . $eliminar[$i]['nombre']);
                    }
                }
            }
        }
    }

    public function index()
    {
        $data['title'] = "Panel de Administración";
        $data['script'] = 'files.js';
        $data['active'] = 'Recientes';
        $data['menu'] = 'admin';
        $carpetas = $this->model->getCarpetas($this->id_usuario);
        $data['archivos'] = $this->model->getArchivosRecientes($this->id_usuario);
        for ($i = 0; $i < count($carpetas); $i++) {
            $carpetas[$i]['color'] = substr(md5($carpetas[$i]['id']), 0, 6);
            $carpetas[$i]['fecha'] = time_ago(strtotime($carpetas[$i]['fecha_create']));
        }
        $data['carpetas'] = $carpetas;
        $data['shares'] = $this->model->verificarEstado($this->correo);
        $this->views->getView('admin', 'home', $data);
    }

    public function crearCarpeta()
    {
        $nombre = $_POST['nombre'];
        if (empty($nombre)) {
            $res = array('tipo' => 'error', 'mensaje' => 'El nombre es requerido');
        } else {
            // Comprobar si existe nombre
            $verificarNombre = $this->model->getVerificar('nombre', $nombre, $this->id_usuario, 0);
            if (empty($verificarNombre)) {
                $data = $this->model->crearCarpeta($nombre, $this->id_usuario);
                if ($data > 0) {
                    $res = array('tipo' => 'success', 'mensaje' => 'Carpeta creada con exito');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'Error al crear carpeta');
                }
            } else {
                $res = array('tipo' => 'warning', 'mensaje' => 'La carpeta ya existe');
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function subirArchivo()
    {
        $id_carpeta = (empty($_POST['id_carpeta'])) ? 1 : $_POST['id_carpeta'];
        $archivo = $_FILES['file'];
        $name = $archivo['name'];
        $tmp = $archivo['tmp_name'];
        $tipo = $archivo['type'];
        $data = $this->model->subirArchivo($name, $tipo, $id_carpeta, $this->id_usuario);

        if ($data > 0) {
            $destino = 'Assets/archivos/';
            if (!file_exists($destino)) {
                mkdir($destino, 0777, true);
            }
            $carpeta = $destino . '/' . $id_carpeta;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            move_uploaded_file($tmp, $carpeta . '/' . $name);
            $res = array('tipo' => 'success', 'mensaje' => 'Archivo subido con exito');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'Error al subir archivo');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ver($id_carpeta)
    {
        $data['title'] = "Listado de Archivos";
        $data['active'] = 'Detail';
        $data['menu'] = 'admin';
        $data['archivos'] = $this->model->getArchivos($id_carpeta, $this->id_usuario);
        $data['shares'] = $this->model->verificarEstado($this->correo);
        $this->views->getView('admin', 'archivos', $data);
    }

    public function verdetalle($id_carpeta)
    {
        // $data['active'] = 'Detail';
        $data['title'] = "Archivos Compartidos";
        $data['id_carpeta'] = $id_carpeta;
        $data['script'] = 'details.js';
        $data['menu'] = 'admin';
        $data['carpeta'] = $this->model->getCarpeta($id_carpeta);
        if (empty($data['carpeta'])) {
            // header('Location: ' . BASE_URL . '/admin');
            echo 'Pagina No Encontrada';
            exit;
        }
        $data['shares'] = $this->model->verificarEstado($this->correo);
        $this->views->getView('admin', 'detalle', $data);
    }

    public function listarDetalle($id_carpeta)
    {
        $data = $this->model->getArchivosCompartidos($id_carpeta);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 0) {
                $data[$i]['estado'] = '<span class="badge bg-warning">Se elimina ' . $data[$i]['elimina'] . ' </span>';
                $data[$i]['acciones'] = '';
            } else {
                $data[$i]['estado'] = '<span class="badge bg-success">Compartido</span>';
                $data[$i]['acciones'] = '<button class="btn btn-danger btn-sm" onclick="eliminarDetalle(' . $data[$i]['id'] . ')">Eliminar</button>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
