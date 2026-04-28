<?php

$FILE_PATH = '../DATA_GIS/GDB.txt';

$TARGET_ID = file_get_contents('php://input'); 


if(!file_exists($FILE_PATH)){
    die('File not found!');
}

$FILE = fopen($FILE_PATH, 'r') or die('Unable to open file!');

$titles = fgets($FILE);
$arrayKeys = explode("; ", $titles);


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


$pos = -1; // SEEK_END solo acepta valores negativos
$arrayCombined = ["modification"=> ""];

while($arrayCombined["modification"] != "00"){ // 00 - resgistro sin actualizaciones para ultimo ID de la ficha 
    
    [$currentLine, $newPos] = getNewLine($FILE, $pos);

    if($currentLine){
        $arrayValues = explode("; ", $currentLine);
        $arrayCombined = array_combine($arrayKeys, $arrayValues);
    }

    $pos = (int)$newPos-1; // ultima posicion(\n) -1 para saltar la posicion del (\n) y subir a la siguiente linea
}


$ID_key = $arrayKeys[0];
$ID = $arrayCombined["cod_n"];

$ID = (int)$ID +1; // incrementa el ID en +1 para obtener el nuevo ID para la ficha
$ID = str_pad($ID, 6, '0', STR_PAD_LEFT); // rellenar el ID con ceros para formato de 6 digitos

echo json_encode([$ID_key => $ID]);

