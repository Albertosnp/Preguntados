<?php session_start();
require_once '../includes/funciones/funciones.php';

if (isset($_POST['Guardar'])) {
    $respuestaCorrecta = $_POST['correcta']; //Siempre viene con un valor por defecto
    $tematica = $_POST['tematica'];
    $arrayPregunta = [];
    $arrayErrores = []; //Para controlar posibles imputs vacios
    
    if (!empty(trim($_POST['pregunta']) and !preg_match('/:/', $_POST['pregunta'])))
        $pregunta = trim($_POST['pregunta']);
    else
        $arrayErrores['pregunta'] = "Pregunta";
    
    if (!empty(trim($_POST['A']) and !preg_match('/:/', $_POST['A'])))
        $respuestaA = trim($_POST['A']);
    else
        $arrayErrores['A'] = "Respuesta A";

    if (!empty(trim($_POST['B']) and !preg_match('/:/', $_POST['B'])))
        $respuestaB = trim($_POST['B']);
    else
        $arrayErrores['B'] = "Respuesta B";

    if (!empty(trim($_POST['C']) and !preg_match('/:/', $_POST['C'])))
        $respuestaC = trim($_POST['C']);
    else
        $arrayErrores['C'] = "Respuesta C";

    if (!empty(trim($_POST['D']) and !preg_match('/:/', $_POST['D'])))
        $respuestaD = trim($_POST['D']);
    else
        $arrayErrores['D'] = "Respuesta D";

    //Si el array de errores esta vacio => todos los campos estan rellenos, los valores se metene en un array   
    if (empty($arrayErrores)) {
        $arrayPregunta = [ 'tematica' => $tematica,
                           'pregunta' => $pregunta,
                           'respuestaCorrecta' => $respuestaCorrecta,
                           'respuestaA' => $respuestaA,
                           'respuestaB' => $respuestaB,
                           'respuesatC' => $respuestaC,
                           'respuestaD' => $respuestaD];
        if(fAnadirPregunta($arrayPregunta)){$_SESSION['preguntaCreada'] = "si";} 
    }else //Añado el array de errores a la v.session para poder mostrarlos 
        $_SESSION['errores'] = $arrayErrores;    
    
    /* Una vez ejecutado todo el codigo redirecciona al usuario a la misma pagina de editar */    
    header('Location: ../editar-pregunta.php');
}
