<?php

$FILE = fopen("../DAtA_GIS/GDB.txt", "r");

$titles = fgets($FILE);
$arrayKeys = explode(", ", $titles);


function getNewLine($FILE, $pos){
    do{
        $pos-=1;
        fseek($FILE, $pos, SEEK_END);

        if(fgetc($FILE) === "\n"){
            // echo fgets($FILE);
            return [fgets($FILE), $pos];
        }
        
    }while(fgetc($FILE) !== "\n");
}


$pos = -1; // SEEK_END solo acepta valores negativos
$arrayCombined = ["modification"=> ""];

while($arrayCombined["modification"] != "00"){ // 00 - resgistro sin actualizaciones para ultimo ID de la ficha 
    
    [$currentLine, $newPos] = getNewLine($FILE, $pos);

    if($currentLine){
        $arrayValues = explode(", ", $currentLine);
        $arrayCombined = array_combine($arrayKeys, $arrayValues);
    }

    $pos = (int)$newPos-1; // ultima posicion(\n) -1 para saltar la posicion del (\n) y subir a la siguiente linea
}

var_dump( $arrayCombined );

