<?php

function find_reserved_id_position($id_a_buscar, $nueva_linea){

    $origen = '../DATA_GIS/GDB.txt';
    $destino = '../DATA_GIS/GDB_temp.txt';

    $lectura = fopen($origen, 'r');
    $escritura = fopen($destino, 'w');


    while (($linea = fgets($lectura)) != false) {

        // Buscamos el ID en la línea actual
        if ( $linea == $id_a_buscar) {
            if($linea){
                $nueva_linea = $nueva_linea . PHP_EOL;
            }
            fputs($escritura, $nueva_linea);
        } else {
            fputs($escritura, $linea);
        }
    }

    fclose($lectura);
    fclose($escritura);

    // Reemplazamos el original por el temporal
    rename($destino, $origen);

}

