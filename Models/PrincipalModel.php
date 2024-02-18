<?php
class PrincipalModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuario($correo)
    {
        $data = $this->select("SELECT * FROM usuarios WHERE correo = '$correo' AND estado = 1");
        return $data;
    }

    public function updateToken($token, $correo)
    {
        $sql = "UPDATE usuarios SET token = ? WHERE correo = ?";
        return $this->save($sql, array($token, $correo));
    }

    public function getToken($token)
    {
        $data = $this->select("SELECT * FROM usuarios WHERE token = '$token' AND estado = 1");
        return $data;
    }

    public function cambiarPass($clave, $token)
    {
        $sql = "UPDATE usuarios SET clave = ?, token = ? WHERE token = ?";
        return $this->save($sql, array($clave, null, $token));
    }
}
