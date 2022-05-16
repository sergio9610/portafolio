<?php

class conexion{

    private $servidor="127.0.0.1:3307";
    private $usuario="root";
    private $contrasenia="";
    private $conexion;

    public function _construct(){

        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=album",$this->usuario,$this->contrasenia);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            /*$sql="INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, 'Proyecto 1', 'imagen.jpg', 'Es un proyecto de prueba');";
            $this->conexion->exec($sql);
            return $this->conexion->lastInsertId(); // retorna el ID insertado
            
            echo "Conexión Establecida";*/

        } catch (PDOException $e) {
            return "falla de conexión: ".$e;
        }

    }

    public function ejecutar($sql){
        $this->conexion = new PDO("mysql:host=$this->servidor;dbname=album",$this->usuario,$this->contrasenia);
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId(); // retorna el ID insertado

    }

    public function consultar($sql){
        $this->conexion = new PDO("mysql:host=$this->servidor;dbname=album",$this->usuario,$this->contrasenia);
        $sentencia=$this->conexion->prepare($sql);  // prepare toma la instrucción sql y la almacena en una variable
        $sentencia->execute();  // se ejecuta la sentencia sql preparada
        return $sentencia->fetchAll(); // el fetchAll retorna todos los registros que se consultan con las sentencia sql
    }

}


?>