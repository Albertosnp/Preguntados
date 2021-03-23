<?php session_start();
if (isset($_POST['Enviar'])) {
    $nombreUsuario = $_POST['nombreJugador'];
    $nombreUsuario = trim($nombreUsuario, " ");//Limpia de espacios a la izq-der
    if(!empty($nombreUsuario))
         $_SESSION['jugador']= ['nombre' => $nombreUsuario,
                                'puntos' => 0 ]; 
    else 
        $_SESSION['errores']['nombreJugador'] = "Nombre no válido";
    /* Se redirecciona al usuario a la pagina de la partida 
       mostrando el nombre del jugador, en caso de no ser valido (Vacio) tb se muestra 
    */
    header('Location: ../game.php');
}
?>