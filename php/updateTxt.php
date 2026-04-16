<?php
// INPUTS
$formData = $_POST;
$ID_ficha = $formData["cod_n"]; /* Revisar si el campo "cod_n" es el ID unico de cada registro, 
    si es asi, usarlo como ID en lugar de generar uno nuevo, para evitar problemas de duplicados 
    y mantener un historial de modificaciones. */ 
    
    
unset($formData["cod_n"]); /* Eliminar el campo "cod_n" del array de datos para cambiar su posicion en el txt, 
si es necesario, o para evitar que se duplique ya que es el ID unico. */ 

array_unshift($formData, $ID_ficha); /* Agregar el ID unico al inicio del array de datos para mantener un formato consistente en el txt, 
si es necesario, o para evitar que se duplique ya que es el ID unico. */

// ID HANDLER
$ficha_n = 0001; // Revisar el ultimo ID registrado en el archivo txt y sumarle 1 para generar el nuevo ID
    
// MODIFY HANDLER
$Modified = "false"; // Si se esta modificando un registro existente, cambiar a true y asignar el ID del registro
$ModifyID = "00"; /* Si $Modify es true, buscar el registro con el mismo ID en el archivo txt 
y cambiar el campo "modificacion" sumandole 1, luego sumar una nueva linea con el mismo ID 
y los nuevos datos, sin eliminar el registro anterior, para mantener un historial de modificaciones. */ 
    
array_splice($formData, 1, 0, $Modified); // revisar si en el txt se guarda el estado de modificacion, para saber si es un nuevo registro o una modificacion de uno existente
array_splice($formData, 2, 0, $ModifyID); // revisar si en el txt el id de modificacion es distinto a 00, para saber si es un nuevo registro o una modificacion de uno existente
    

// FILE PATH
$filePath = "../DATA_GIS/GDB.txt";
// $file = fopen("../DATA_GIS/GDB.txt", "a") or die("Unable to open file!");
// "a" - APPEND


// TRANSFORM FROM DATA TO STRING
$data_array = [];


foreach($formData as $value){


    $value = $value != NULL ? $value : "vacio";

    // esto hace que los datos se triplicados en el txt, revisar si es necesario o si se puede eliminar.
    // $data_array[] = str_replace(",", ";", $value); // Reemplazar comas por punto y coma para evitar conflictos con el formato CSV
    // $data_array[] = str_replace(PHP_EOL, " ", $value); // Reemplazar saltos de linea por espacio para evitar conflictos con el formato CSV


    $data_array[] = $value;
    var_dump($value);
}

$newline = implode(", ", $data_array) . PHP_EOL;

file_put_contents($filePath, $newline, FILE_APPEND | LOCK_EX);

var_dump($newline);

// var_dump($formData["cod_n"]);
