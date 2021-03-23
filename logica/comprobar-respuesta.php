<?php session_start();
//Se comprueba si llega el valor de la respuesta, si no por defecto es vacio
$respuesta = $_POST['respuesta']?? "";
$correcta = $_POST['correcta'];
$enunciadoPregunta = $_POST['pregunta'];
$tematica = $_POST['tematica'];

if ($respuesta === $correcta) {

    //Si el jugador aun no ha puntuado entra en else
    if ($_SESSION['jugador']['puntos'] != 0) 
        $_SESSION['jugador']['puntos'] *= 2;
    else
        $_SESSION['jugador']['puntos'] = 10;
    
    $_SESSION['acertadas'][$tematica]++; //Suma a la categoria la respuesta acertada                           
}else{
    $_SESSION['falladas'][$tematica]++; //Suma a la categoria la respuesta fallada
}
//Si el jugador llega a las cinco repuestas acertadas gana la categoria y no mostrará mas preguntas de ella
//Borra la session para esa tematica
if (isset($_SESSION['acertadas']) and ($_SESSION['acertadas'][$tematica] === 5)) 
    unset($_SESSION['preguntas'][$tematica]);


header('Location: ../game.php'); //Redirecciona a la pagina de preguntas
?>