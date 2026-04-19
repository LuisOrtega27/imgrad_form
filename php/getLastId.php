<?php

$FILE_PATH = '../DATA_GIS/GDB.txt';

$TARGET_ID = file_get_contents('php://input') ?: '000001'; /* '000001' is the default ID, you can change it to any other ID you want to test with 
    if ID is provided, get registry with that ID, 
    otherwise get the last registry in the file and get its ID, 
    then return the registry as JSON with the ID as a key, for example: 
    {"id": "000001"}
*/ 

if(!file_exists($FILE_PATH)){
    die('File not found!');
}

$file = fopen($FILE_PATH, 'r') or die('Unable to open file!');

// IMPORTANT: read the first line to get the titles of the columns, those are te keys of the json object that will be returned
$titles_line = fgets($file); 

fseek($file, -1, SEEK_END);

$line = '';
$position = -2;


while(fgetc($file) != "\n"){
    fseek($file, $position, SEEK_END);
    $position--;
}

$line = fgets($file);

fclose($file);

$titles = explode(', ', $titles_line);
$ID_key = $titles[0]; // get the first title as the key for the ID

$line_array = explode(', ', $line);

$ID = $line_array[0];

$ID = (int)$ID +1; // increment the ID by 1 to get the next ID for the new registry
$ID = str_pad($ID, 6, '0', STR_PAD_LEFT); // pad the ID with zeros to have 6 digits

echo json_encode([$ID_key => $ID]);

