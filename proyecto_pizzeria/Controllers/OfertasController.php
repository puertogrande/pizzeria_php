<?php

require_once("models/OfertasModel.php");

class OfertasController{
    public function Index(){
        $oferta = new OfertasModel();
        $todosOfertas=$oferta->getOfertas();
        require_once("views/ofertas/ListadoView.phtml");
    }
    
    public function BorrarOferta($id){
        $oferta = new OfertasModel();
        $oferta->setId($id);
        $oferta->delete();
        header("location:index.php");
    }

    public function NuevaOferta($id=null){
        $id=$id;

        if($id !=null){
            $oferta = new OfertasModel();
            $oferta->setId($id);
            $oferta->setId($id);
            $oferta_seleccionada=$oferta->getOfertasByid();
        }
        //simplemente llamar a la vista de la oferta
        //$usuario = new NuevaOferta();
        require_once("views/ofertas/RegistroView.phtml");
    }

   
    //realizar la funcion grabar oferta
    public function GrabarOferta(){
        if(isset($_POST['submit1'])){
            if(isset($_FILES['imagen'])){
                $file= $_FILES['imagen'];
                $filename= $file['name'];
                //filename es lo que hay que guardar en la base de datos
                $mimetype=$file['type'];
                if($mimetype=="image/jpg" || $mimetype="image/jpeg" || $mimetype =='image/png' || $mimetype=='image/gif'){
                    if(!is_dir('uploads/img')){
                        mkdir('uploads/img',0777,true);
                    }
                    move_uploaded_file($file['tmp_name'],'uploads/img/'.$filename);
                    //devolvemos el nombre del archivo
                    return $filename;
                }
                else{
                    echo "la imagen no tiene el formato adecuado";
                }
            }
            else{
                echo "no se ha recibido ninguna imagen";
            }
        }
      
    }

    public function crearOferta(){
        $imagen=$this->GrabarOferta();
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
        //$imagen = isset($_POST['']) ? $_POST[''] : false;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
        echo $imagen;
        echo $titulo;
        echo $descripcion;
        if($titulo && $imagen && $descripcion){
            //echo "todos los datos han sido introducidos de forma correcta";
            $oferta_nueva = new OfertasModel($titulo,$imagen,$descripcion);
            $oferta_nueva->Insert();
        }
        header("location:index.php");
    }

    public function ModificarOferta($id){
        $imagen=$this->GrabarOferta();
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
        //$imagen = isset($_POST['']) ? $_POST[''] : false;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
       
        if($titulo && $imagen && $descripcion){
            //echo "todos los datos han sido introducidos de forma correcta";
            $oferta_nueva = new OfertasModel($titulo,$imagen,$descripcion);
            $oferta_nueva->setId($id);
            $oferta_nueva->Modificar();
        }
        else{
            $oferta_nueva = new OfertasModel($titulo);
            $oferta_nueva->setId($id);
            $oferta_nueva->setTitulo($titulo);
            $oferta_nueva->setDescripcion($descripcion);
            $oferta_nueva->Modificar();
        }
        header("location:index.php");
    }
}
?>