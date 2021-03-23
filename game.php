<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/funciones/funciones-session.php'?>
<?php // Comprobacion y lectura del fichero de preguntas, si ya se ha leido anteriormente no llama a funcion
if (!isset($_SESSION['preguntas'])) {
    $_SESSION['preguntas'] = fLeerPreguntas();
    
}else{
    //Desordena y extrae una pregunta
    fDesordenarPreguntas(); 
    //Saca una tematica aleatoria del array de preguntas si el array de preguntas no esta vacio
    if (!empty($_SESSION['preguntas'])) {
        $tematica =  array_rand($_SESSION['preguntas']);
        //Saca una pregunta aleatoria de la tematica extraida
        $enunciadoPregunta = array_rand($_SESSION['preguntas'][$tematica]);
        //Saca el contenido de la pregunta seleccionada (correcta y posibles respuestas)
        $contenidoPregunta = $_SESSION['preguntas'][$tematica][$enunciadoPregunta];
        //Se destruye la pregunta de la session para que no pueda aparecer mas
        unset($_SESSION['preguntas'][$tematica][$enunciadoPregunta]);
    
    }else{
    /* Si el array de preguntas esta vacio, se redirecciona al usuario a la pantalla final    
        donde se le muestra su puntuacion */
        header('Location: final.php');
    }
}
?>
<?php if (!isset($_SESSION['jugador'])) { ?>
<div class="bloque" id="registro">
    <h3>Nueva Partida</h3>
    <?php //Muesta si hay algun error con la validacion del nombre introducido
    if (isset($_SESSION['errores']['nombreJugador'])) { ?>
        <p class="error"><?= $_SESSION['errores']['nombreJugador']; ?></p>
    <?php } //Se borran los errores
    unset($_SESSION['errores']['nombreJugador']); ?>
    <form class="bloque-editar" method="post" action="logica/validar-jugador.php" id="nombreJugador">
        <label for="nombre">Introduce tu nombre:</label>
        <input type="text" name="nombreJugador" id="nombre" required>
        <input type="submit" value="Enviar" name="Enviar" class="botones-glv">
    </form>
</div>
<?php } elseif (isset($_SESSION['jugador'])) {
    $nombreJugador = $_SESSION['jugador']['nombre'];
    $puntuacion = $_SESSION['jugador']['puntos'];
?>

<div class="bloque" id="partida">
    <div class="nombre-puntuacion">
        <div class="jugador">
            <p><?=$nombreJugador?></p>
            <p><?=$puntuacion?></p>
        </div>
        <div class="tematicas">
            <div>
                <p class="tematica-side">Ciencias</p>
                <p class="acierto">Acertadas:<?=$_SESSION['acertadas']['Ciencias']??0?></p>
                <p class="error">Falladas:<?=$_SESSION['falladas']['Ciencias']??0?></p>
            </div>
            <div>
                <p class="tematica-side">Historia</p>
                <p class="acierto">Acertadas:<?=$_SESSION['acertadas']['Historia']??0?></p>
                <p class="error">Falladas:<?=$_SESSION['falladas']['Historia']??0?></p>
            </div>
            <div>
                <p class="tematica-side">Arte</p>
                <p class="acierto">Acertadas:<?=$_SESSION['acertadas']['Arte']??0?></p>
                <p class="error">Falladas:<?=$_SESSION['falladas']['Arte']??0?></p>
            </div>
            <div>
                <p class="tematica-side">Deportes</p>
                <p class="acierto">Acertadas:<?=$_SESSION['acertadas']['Deportes']??0?></p>
                <p class="error">Falladas:<?=$_SESSION['falladas']['Deportes']??0?></p>
            </div>   
        </div>
    </div>
    <div class="bloque-pregunta">
        <form action="logica/comprobar-respuesta.php" method="post">
            <div class="juego" id="tema" ><?=$tematica?></div>
            <div id="enunciado" ><?=$enunciadoPregunta?></div>
            <div id="opciones">
                <button value="A" name="respuesta" onclick="submit"><?=$contenidoPregunta['respuestaA']?></button>
                <button value="B" name="respuesta" onclick="submit"><?=$contenidoPregunta['respuestaB']?></button>
                <button value="C" name="respuesta" onclick="submit"><?=$contenidoPregunta['respuestaC']?></button>
                <button value="D" name="respuesta" onclick="submit"><?=$contenidoPregunta['respuestaD']?></button>
            </div>
            <input type="hidden" name="pregunta" value="<?=$enunciadoPregunta?>">
            <input type="hidden" name="tematica" value="<?=$tematica?>">
            <input type="hidden" name="correcta" value="<?=$contenidoPregunta['respuestaCorrecta']?>">
        </form>
    </div>
</div>
<?php }
require_once 'includes/footer.php'; ?>