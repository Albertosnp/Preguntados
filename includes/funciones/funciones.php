<?php
/* Funcion que lee el fichero csv donde estan contenidos los jugadores y su puntuacion */
function fLeerJugadores()
{
    $jugadores = [];
    $fichero = fopen("csv/jugadores.csv", "c+");
    if (!empty($fichero)) {
        while ($linea = fgetcsv($fichero, 0, ":")) {
            $nombreJugador = $linea[0];
            $puntosJugador = (int)$linea[1]; 
            //Clave => nombreJugador , Valor => puntos
            $jugadores[$nombreJugador] = $puntosJugador;
        }
    }
    return $jugadores;
}
/* Funcion que lee el fichero csv donde estan contenidos las preguntas del juego */
function fLeerPreguntas()
{
    $preguntas = [];
    $fichero = fopen("csv/preguntas.csv", "c+");
    if ($fichero) {
        while ($linea = fgetcsv($fichero, 0, ":")) {
            //Preguntas organizadas por tematica, y dentro de cada tematica sus preguntas, a su vez cada pregunta tiene su contenido
            //Si encuentra una pregunta igual sobrescribe la informacion => NO HAY REPETIDOS
            $preguntas[$linea[0]][$linea[1]] = [  
                                                'respuestaCorrecta' => $linea[2],
                                                'respuestaA' => $linea[3],
                                                'respuestaB' => $linea[4],
                                                'respuestaC' => $linea[5],
                                                'respuestaD' => $linea[6]
                                                ];
        }
    }
    return $preguntas;
}
/* Funcion que ordena descendente el array de jugadores por puntos (100 > 1) */
function fOrdenarJugadores($arrayJugadores)
{
    arsort($arrayJugadores); //ordena por valor (puntos) manteniendo claves
    return $arrayJugadores;    
}

/* Funcion que escribe en el fichero de preguntas*/
function fAnadirPregunta($preguntaNueva)
{   
    $strPregunta = implode(":",$preguntaNueva);
    $fichero = "../csv/preguntas.csv";
    //Escribe en al final del fichero (FILE_APPEND), añado un salto de linea (\n) a la cadena
    //retorna true si se ha escrito y false si ha habido fallo
    return file_put_contents($fichero, $strPregunta."\n",FILE_APPEND)? true: false;
}
/* Funcion que recibe un array y lo devuelve desordenado */
function fDesordenar($preguntas)
{
    //He aplicado la siguiente funcion para desordenar el array, porque con la funcion SHUFFLE pierdo las claves del array de preguntas.
    uksort($preguntas, function ($a, $b) {return mt_rand(-10, 10);});
    return $preguntas;
}
/* Funcion que registra al jugador y su puntuacion en fichero de jugadores.csv */
function fRegistrarJugador(Array $jugador)
{
    $strJugador = implode(":", $jugador);
    $fichero = "csv/jugadores.csv";
    return file_put_contents($fichero, $strJugador."\n", FILE_APPEND)? true: false;
}