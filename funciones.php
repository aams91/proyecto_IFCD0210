<?php


/* Conectar PHP a la base de datos */
class ConectarDB {
    private $host = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $db = "pen_arb";
    public $conexion;
    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->db) or die($this->conexion->connect_error);
        $this->conexion->set_charset("utf8");
    }

    public function consultar($consulta) {
        // This objeto a consultar ($consulta) se lleva (->) al objeto conexion y se hace la consulta (query)
        $resultado = $this->conexion->query($consulta) or die($this->conexion->error);
        if ($resultado) {
            return $resultado;
        }
    }

    // Desconectar.
    public function cerrar(){
        $this->conexion->close();
      }

}



function chequearSesion(){
    if(!$_SESSION["usuario"]){
        header('Location: index.php');
    }
}

?>