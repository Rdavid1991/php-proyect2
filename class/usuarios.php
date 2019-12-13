<?php

require_once("../database/connect.php");

class usuarios extends coneccion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validar_usuario($usr, $pwd)
    {
        $instruccion = "CALL validar_usuario('" . $usr . "','" . $pwd . "')";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if ($resultado) {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function insertar_usuario($usr, $pwd, $role)
    {
        $instruccion = "CALL insertar_usuario('" . $usr . "','" . $pwd . "','".$role."')";
        $consulta = $this->_db->query($instruccion);
    
        if ($consulta) {
            return $consulta;
            $consulta->close();
            $this->_db->close();
        }
    }

    public function verificar_usuario($usr)
    {

        $instruccion = "CALL verificar_usuario('" . $usr . "')";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if ($resultado) {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }
}
