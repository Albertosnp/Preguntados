<?php 
require_once 'funciones.php'; 
/* Funcion que desordena por completo el array de preguntas */
function fDesordenarPreguntas()
{
    //Desordena las tematicas
    $_SESSION['preguntas'] = fDesordenar($_SESSION['preguntas']);
    /* Desordena las preguntas de cada tematica 
        Si el array de tematica esta vacio, borra esa tematica (no volvera a mostrarse)
    */
    if (empty($_SESSION['preguntas']['Historia'])) 
        unset($_SESSION['preguntas']['Historia']);
    else
        $_SESSION['preguntas']['Historia'] = fDesordenar($_SESSION['preguntas']['Historia']);
    
    if (empty($_SESSION['preguntas']['Arte']))
        unset($_SESSION['preguntas']['Arte']);
    else
        $_SESSION['preguntas']['Arte'] = fDesordenar($_SESSION['preguntas']['Arte']);
    
    if (empty($_SESSION['preguntas']['Deportes'])) 
        unset($_SESSION['preguntas']['Deportes']);
    else
        $_SESSION['preguntas']['Deportes'] = fDesordenar($_SESSION['preguntas']['Deportes']);
    if (empty($_SESSION['preguntas']['Ciencias'])) 
        unset($_SESSION['preguntas']['Ciencias']);
    else
        $_SESSION['preguntas']['Ciencias'] = fDesordenar($_SESSION['preguntas']['Ciencias']);     
}

function aniadir1000puntos()
{
    $contador = 0;
    if (isset($_SESSION['acertadas'])) {
        
        foreach ($_SESSION['acertadas'] as $key => $value) {
            $contador += $value;
        }
    }
    return ($contador === 20)? true : false;
}