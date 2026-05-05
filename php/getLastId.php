<?php

$FILE_PATH = '../DATA_GIS/GDB.txt';

$TARGET_ID = file_get_contents('php://input'); 


if(!file_exists($FILE_PATH)){
    die('File not found!');
}

$FILE = fopen($FILE_PATH, 'r') or die('Unable to open file!');

function getNewLine($FILE, $pos){
    do{
        $pos-=1;
        fseek($FILE, $pos, SEEK_END);

        if(fgetc($FILE) === "\n"){ 
            // echo fgets($FILE);
            return [fgets($FILE), $pos];
        }
        
    }while(fgetc($FILE) !== "\n"); // si llega al (\n) es el principio de la linea
}


$arrayValues = [];

$pos = -1; // SEEK_END solo acepta valores negativos

while( ($arrayValues[4] ?? NULL) != "00" ){ // 00 - resgistro sin actualizaciones para ultimo ID de la ficha 
    
    [$currentLine, $newPos] = getNewLine($FILE, $pos);

    if(count($arrayValues) == 1){ // si el array tiene solo 1 elemento (el codigo), detener el while
        break;
    }

    $arrayValues = explode("; ", $currentLine);
    
    $pos = (int)$newPos-1; // ultima posicion(\n) -1 para saltar la posicion del (\n) y subir a la siguiente linea
}


$ID = $arrayValues[0];

$ID = (int)$ID +1; // incrementa el ID en +1 para obtener el nuevo ID para la ficha
$ID = str_pad($ID, 6, '0', STR_PAD_LEFT); // rellenar el ID con ceros para formato de 6 digitos

file_put_contents($FILE_PATH, "\n{$ID}", FILE_APPEND);

echo json_encode(["cod_n" => $ID]);

