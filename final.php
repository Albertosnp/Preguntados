<?php require_once'includes/head.php'?>
<?php require_once'includes/funciones/funciones-session.php'?> 
<?php if (isset($_SESSION['jugador'])){
    //Añade 1000 puntos al jugador si ha completado todas las categorias
    if(aniadir1000puntos()) $_SESSION['jugador']['puntos'] += 1000;
    //Se registra al jugador con su puntuacion en el fichero de jugadores
    fRegistrarJugador($_SESSION['jugador']);
?>
<div class="bloque" id="bloque-final">
    <div class="puntuacion-final">
        <div class="tu-puntuacion"><p>Esta es tu puntuación</p></div>
        <div class="img-final">
            <img src="assets/img/logo-puntuacion.png" alt="imagen">
            <div class="puntos">
                <p><?=$_SESSION['jugador']['nombre']?></p>
                <p><?=$_SESSION['jugador']['puntos']?></p>
            </div>
        </div>
    </div>
    <input type="button" onclick="window.location='index.php'" value="Volver al inicio">
</div>
<?php session_unset();} else{ ?>
<p>No permitido</p>
<?php } require_once 'includes/footer.php'?>