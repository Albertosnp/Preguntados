<?php require_once 'includes/head.php'; ?>
<?php $jugadores = fLeerJugadores();
$jugadores = fOrdenarJugadores($jugadores);?>
<div class="bloque">
    <div class="centrales">
        <div class="boton"><a href="editar-pregunta.php">Editar preguntas</a></div>
        <div class="boton"><a href="game.php">Jugar Partida</a></div>
    </div>
    <div class="centrales">
    <h3 id="ranking">Ranking</h3>
        <div name="records" id="records"><?php $index = 0; //Se sacan los 5 mejores jugadores (nombre -> puntos)
                                                foreach ($jugadores as $key => $value) {
                                                    if (4 < $index) {
                                                        break;
                                                    }
                                                    echo "<p>".($index+1) ."º "."{$key} {$value} puntos.</p>";
                                                    $index++;
                                                } ?>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php' ?>