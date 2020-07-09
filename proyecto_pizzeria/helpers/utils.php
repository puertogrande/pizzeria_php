<?php
class Utils{
    public static function mostrarError($name){
        $error="";
        if (isset($_SESSION[$name])){
            if ($_SESSION[$name] == 'complete'){
                $error ='<strong class="alert_green">Registro completado correctamente</strong>';
            }else{
                $error='<strong class="alert_red">Registro fallido, introduce bien los datos</strong>';
            }
                $_SESSION[$name] = null;
                unset($_SESSION[$name]);

        }
        return $error;
    }
}


?>