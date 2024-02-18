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
}
