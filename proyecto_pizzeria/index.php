<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 1</title>
</head>
<body>
    <?php
    session_start();
    require_once 'comun.php';
    require_once 'models/PizzeriaDB.php';
    require_once 'helpers/utils.php';
    require_once 'Controllers/OfertasController.php';
   
    
    if(!isset($_GET['c'])|| !isset($_GET['a'])){
        $controlador= new OfertasController();
        $controlador->Index();
    }
    else{
        $nombre_controlador=$_GET['c'].'Controller';
        if(class_exists($nombre_controlador)){
            $controlador= new $nombre_controlador();
            if(method_exists($controlador, $_GET['a'])){
                $action = $_GET['a'];
                if(isset($_GET['id'])){
                $id=$_GET['id'];
                $controlador->$action($id);
                }
                else{
                    $controlador->$action();
                }
                }
            
            else{
                echo "la pagina que buscas no existe";
            }
        }
        else{
            echo "la pagina que buscas no existe";
        }
    }

    ?>
    
</body>
</html>