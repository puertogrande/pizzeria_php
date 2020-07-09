<?php

class OfertasModel extends Database{
    private $id;
    private $titulo;
    private $imagen;
    private $descripcion;
    private $conn;
   

    public function __construct($titulo=null,$imagen=null,$descripcion=null){
        $this -> conn = parent::conectaDB();
        if (isset($titulo)){$this->titulo=$titulo;}
        if (isset($imagen)){$this->imagen=$imagen;}
        if (isset($descripcion)){$this->descripcion=$descripcion;}
    }

    public function delete(){
        $sql="DELETE FROM oferta WHERE id={$this->getId()};";
        $save = $this->conn->exec($sql);
    }
       
    public function getOfertasByid(){
        $consulta=$this->conn->query("SELECT * FROM oferta WHERE id={$this->getId()} ;");
        return $consulta;
    }

    public function getOfertas(){
        $consulta=$this->conn->query("SELECT * FROM oferta ORDER BY id DESC");
        return $consulta;
    }
    public function Insert(){
        $titulo=$this->getTitulo();
        $imagen=$this->getImagen();
        $descripcion=$this->getDescripcion();
        $sql = "INSERT INTO oferta VALUES(NULL,'{$this->getTitulo()}','{$this->getImagen()}','{$this->getDescripcion()}');";
        $save = $this->conn->exec($sql);
        $result = false;
        if($save){
            $result = true;
        }
    }
    public function Modificar(){
        echo "se ha llamado al modelo";
        $titulo=$this->getTitulo();
        $imagen=$this->getImagen();
        echo(var_dump($imagen));
        echo $imagen;
        if ($imagen == null){
            echo "llega aqui";
            $sql = "UPDATE oferta SET titulo='{$this->getTitulo()}',descripcion='{$this->getDescripcion()}' WHERE id='{$this->getId()}';";
            $save = $this->conn->exec($sql);
            $result = false;
            if($save){
                $result = true;
                echo "se ha guardado";
            }
        }
        else{

        
        $descripcion=$this->getDescripcion();
       //si no consigues el de la imagen no lo pongas
        $sql = "UPDATE oferta SET titulo='{$this->getTitulo()}', imagen='{$this->getImagen()}',descripcion='{$this->getDescripcion()}' WHERE id='{$this->getId()}';";
        $save = $this->conn->exec($sql);
        $result = false;
        if($save){
            $result = true;
        }
    }
    }

    function getId(){
        return $this->id;
    }
    function setId($id){
        $this->id= $id;
    }
    
    function getTitulo(){
        return $this->titulo;
    }
    
    function setTitulo($titulo){
        $this->titulo= $titulo;
    }
    
    function getImagen(){
        return $this->imagen;
    }
    
    function setImagen($imagen){
        $this->imagen= $imagen;
    }

    function getDescripcion(){
        return $this->descripcion;
    }
    function setDescripcion($descripcion){
        $this->descripcion= $descripcion;
    }
}

?>