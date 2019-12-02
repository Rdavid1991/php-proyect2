<?php
require_once('config.php');

class coneccion{
    protected $_db;
    public function __construct(){
        $this->_db=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if ($this->_db->connect_error) {
            echo "fallo coneccion".$this->_db->connect_error;
        }
    }
}
?>