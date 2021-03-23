<?php require_once 'includes/head.php' ?>
<?php //Comprobacion si en la sesion hay errores 
        if(isset($_SESSION['errores'])){
        echo "<p class='error'>Has dejado sin rellenar los siguientes campos:</p>";
        foreach ($_SESSION['errores'] as $key => $value)
            echo $value ."<br>";
        //Despues de mostrar los errores se elimina de session  
        unset($_SESSION['errores']);}?>
<form action="logica/validar-pregunta.php" method="post" class="bloque-editar" name="formulario-preguntas">
    <h3>Aquí puedes añadir una pregunta al juego</h3>
    <?php //Si se añade al fichero de preguntas, se muestra un mensaje al usuairo
        if(isset($_SESSION['preguntaCreada'])){ 
        echo "<p>La pregunta ha sido añadida correctamente.</p>"; 
        unset($_SESSION['preguntaCreada']); //Se limpia ese indice de session
        } ?>
    <div class="central-editar" >
        <div class="tematica">
            <label for="tematica">Tematica:</label>    
            <select name="tematica" id="tematica">
                <option value="Ciencias" default>Ciencias</option>
                <option value="Historia">Historia</option>
                <option value="Arte">Arte</option>
                <option value="Deportes">Deportes</option>
            </select>
        </div>
        <div id="pregunta"><textarea name="pregunta" id="nueva-pregunta"></textarea></div>      
    </div>
    <div class="respuestas">
        <div class="central-editar" id="respuestas">
            <label for="A">A:</label><input type="text" name="A" id="A" class="opcionRespuesta">
            <label for="B">B:</label><input type="text" name="B" id="B" class="opcionRespuesta">
            <label for="C">C:</label><input type="text" name="C" id="C" class="opcionRespuesta">
            <label for="D">D:</label><input type="text" name="D" id="D" class="opcionRespuesta">
        </div>
        <div class="correcta">
            <label for="correcta">Respuesta correcta:</label>    
            <select name="correcta" id="correcta">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>    
    </div>
    <div class="botones-editar">
        <input type="submit" name="Guardar" value="Guardar" class="botones-glv" >
        <input type="reset" value="Limpiar" class="botones-glv">
        <input type="button" class="botones-glv" onclick="window.location='index.php'" value="Volver">
    </div> 
</form>
<?php require_once 'includes/footer.php'?>