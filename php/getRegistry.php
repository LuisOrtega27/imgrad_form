<?php
$prueba = '{"targetId":"1", "last": true}';

$FILE_PATH = "../DATA_GIS/GDB.txt";
$formData = file_get_contents("php://input") ?: $prueba;
$formData = json_decode($formData, true);
    
$FILE = fopen($FILE_PATH, "r");

$result = [];
// se lee la primera linea del archivo para obtener los titulos de cada columna
$titles = explode("; ", fgets($FILE)); 

if($FILE){
    while(!feof($FILE)){
        $line = fgets($FILE);
        $array_line = explode("; ", $line);
        
        if( count($array_line) === 1 && $array_line[0] == $formData["targetId"] ){

            array_push($result, array_combine(["cod_n"], $array_line)); 

        }else if($array_line[0] == $formData["targetId"]){
            // se guardan todas las coincidencias
            // se combina el array de titulos con el array de datos para crear un array asociativo y se agrega al resultado    
            array_push($result, array_combine($titles, $array_line)); 
        }
    }
}


// IF EMPTY si no se encuentra, debolver array vacio
if(empty($result)){
    echo json_encode([
        "code" => 404,
        "success" => false,
        "status" => "error",
        "message" => "Registro no encontrado",
        "data" => $result
    ]);
    exit;
} 

// IF $result length === 1 (registro reservado, alguien lo esta trabajando) 
if( count($result) === 1 ){
    echo json_encode([
        "code" => 409,
        "success" => true,
        "status" => "success",
        "message" => "Codigo: 409 Este registro se encuentra reservado",
        "data" => $result[0]
    ]);
    exit;
} 



for($i = 0; $i < count($result); $i++){
    // limpiar el formato guardado en el txt (hay que modificar esto para limpiar varios para el historico)
    foreach($result[$i] as $key => $value){
        $result[$i][$key] = $result[$i][$key] === "----" ? "" : $result[$i][$key]; 
        // $result[$i][$key] = str_replace(";", ",", $result[$i][$key]); 
    }
}

// true: se guarda solo la ultima coincidencia, false: retorna la liasta completa (tal vez para mostrar el historico)
if($formData["last"] == true){
    $result = end($result); 
    // actualizar la modificacion, para el historico
    $result["modification"] = str_pad((int)$result["modification"] +1, 2, "0", STR_PAD_LEFT);
}

echo json_encode([
    "code" => 200,
    "success" => true,
    "status" => "success",
    "message" => "Registro encontrado",
    "data" => $result
]);
