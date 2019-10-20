<?php
class Redirect{
    private $location;
    /**
     * Método para redireccionar usuario a una sección determinada
     * 
     * @param string $location
     */
    public static function to($location){
        $self = new Self();
        $self->location = $location;
        // Si las cabeceras ya fueron envíadas
        if(headers_sent()){
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.URL.$self->location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.URL.$self->location.'" />';
            echo '</noscript>';
            die();
        }

        // cuando se pasa una url externa
        if (strpos($self->location, 'http') !== false) {
            header('Location: '.$self->location);
            die();
        }
        
        // Redirigir al usuario a otra sección
        header('Location: '.URL.$self->location);
        die();
    }
}
