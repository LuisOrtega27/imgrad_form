<?php
$prueba = '{"data":{"header_fecha-fecha":"","tiem_ins":"","coor_utm-e":"","coor_utm-n":"","ficha_n":"","cod_n":"00000","header_codigo-huso":"","header_codigo-altura":"","id_tec-nom_ape_1":"","id_tec-tlf_1":"","id_tec-nom_ape_2":"","id_tec-tlf_2":"","datos_cuenta-nombre":"","datos_cuenta-estado":"Distrito_Capital","datos_cuenta-municipio":"Libertador","datos_cuenta-parroquia":"","datos_cuenta-cent_pobl":"","ent_fisi-alt_pro":"","ent_fisi-obsevaciones":"","tipo_obra-nombre":"","tipo_obra-tiempo":"","tipo_obra-drp":"","tipo_obra-omc":"","tipo_obra-observaciones":"","carac_obra-observaciones":"","carac_obra-mechi":"","carac_obra-disp_ener":"","carac_obra-malla_cont":"","carac_obra-alivi":"","carac_obra-peine_debas":"","carac_obra-contradic":"","carac_obra-espigo":"","carac_obra-enroca":"","carac_obra-altura":"","carac_obra-base":"","carac_obra-ancho":"","carac_obra-longitud":"","carac_obra-diametro":"","carac_obra-area":"","carac_obra-volumen":"","meto_apli-observaciones":"","org_parti-nom_ape_1":"","org_parti-insti_1":"","org_parti-tlf_1":"","org_parti-nom_ape_2":"","org_parti-insti_2":"","org_parti-tlf_2":"","org_parti-nom_ape_3":"","org_parti-insti_3":"","org_parti-tlf_3":""}}';

// INPUTS
$formData = file_get_contents("php://input") ?: $prueba; // Obtener los datos enviados desde el formulario
$formData = json_decode($formData, true); // Decodificar los datos JSON a un array asociativo de PHP

$formData = $formData["data"] ?: []; // Acceder al array de datos dentro del objeto JSON

// EXTRACTING DATA
$FICHA_N = $formData["ficha_n"];
$COORD_E = $formData["coor_utm-e"]; 
$COORD_N = $formData["coor_utm-n"]; 
$COD_N = $formData["cod_n"]; 

// UNSET VARIABLES
unset($formData["ficha_n"]);
unset($formData["coor_utm-e"]);
unset($formData["coor_utm-n"]);
unset($formData["cod_n"]);

// RE-ORDERING DATA
array_unshift($formData, "00"); /*
/*
    esto lleva el historial de actualizaciones, el valor "00" indica que es un nuevo registro, 
    si el valor es distinto a "00", indica que es una modificacion de un registro existente, 
    y al valor ID del registro se aumenta en +1, para mantener un historial de modificaciones.
*/ 
array_unshift($formData, $FICHA_N); 
array_unshift($formData, $COORD_E);
array_unshift($formData, $COORD_N);
//Agregar el ID unico al inicio del array de datos para mantener un formato consistente en el txt
array_unshift($formData, $COD_N); 


// DB FILE PATH
$FILE_PATH = "../DATA_GIS/GDB.txt";

// TRANSFORM FROM DATA TO STRING
$data_array = [];

foreach($formData as $value){
    $data_array[] = $value == "" ? "----" : $value;
}

$newline =  PHP_EOL . implode(", ", $data_array);

file_put_contents($FILE_PATH, $newline, FILE_APPEND | LOCK_EX);

$response = [
    "success" => true,
    "status" => "success",
    "message" => "Registro guardado exitosamente.",
    "data" => $newline
];
echo(json_encode($response));

