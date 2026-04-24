<?php
$prueba = '{"data":{"header_fecha-fecha":"","tiem_ins":"","coor_utm-e":"","coor_utm-n":"","ficha_n":"000001","modification":"00","cod_n":"","header_codigo-huso":"","header_codigo-altura":"","id_tec-nom_ape_1":"","id_tec-tlf_1":"","id_tec-nom_ape_2":"","id_tec-tlf_2":"","datos_cuenta-nombre":"","datos_cuenta-estado":"Distrito_Capital","datos_cuenta-municipio":"Libertador","datos_cuenta-parroquia":"","datos_cuenta-cent_pobl":"","ent_fisi-arboreo":"off","ent_fisi-arbustivos":"off","ent_fisi-herbaceos":"off","ent_fisi-area_cult":"off","ent_fisi-sue_des":"off","ent_fisi-area_ocu":"off","ent_fisi-alt_pro":"","ent_fisi-agu_neg":"off","ent_fisi-escom":"off","ent_fisi-basura":"off","ent_fisi-resi_fore":"off","ent_fisi-prese_arbol_caido":"off","ent_fisi-agri":"off","ent_fisi-indus":"off","ent_fisi-comer":"off","ent_fisi-urban":"off","ent_fisi-variacion":"off","ent_fisi-retiro_cuerpo_agua":"off","ent_fisi-soca_marge":"off","ent_fisi-flujo_turbu":"off","ent_fisi-sedim":"off","ent_fisi-rocas":"off","ent_fisi-a_la_mar":"off","ent_fisi-dentro_cause":"off","ent_fisi-obsevaciones":"","tipo_obra-nombre":"","tipo_obra-tiempo":"","tipo_obra-opera":"off","tipo_obra-inopera":"off","tipo_obra-limit":"off","tipo_obra-con_arm":"off","tipo_obra-con_prefab":"off","tipo_obra-con_cicl":"off","tipo_obra-ace_estruc":"off","tipo_obra-mampos":"off","tipo_obra-madera":"off","tipo_obra-piedra":"off","tipo_obra-gavion":"off","tipo_obra-tierra":"off","tipo_obra-capta":"off","tipo_obra-transp":"off","tipo_obra-con_regu":"off","tipo_obra-distri":"off","tipo_obra-reco":"off","tipo_obra-trata":"off","tipo_obra-pro_mejo":"off","tipo_obra-trans_ene":"off","tipo_obra-conten":"off","tipo_obra-conduc":"off","tipo_obra-toma":"off","tipo_obra-con_flu":"off","tipo_obra-evacu":"off","tipo_obra-espe":"off","tipo_obra-drp":"","tipo_obra-omc":"","tipo_obra-observaciones":"","carac_obra-diseno_obra":"off","carac_obra-tipo_dique":"off","carac_obra-tipo_muro":"off","carac_obra-observaciones":"","carac_obra-tipo_descanso":"off","carac_obra-vertederos":"off","carac_obra-mechi":"","carac_obra-disp_ener":"","carac_obra-malla_cont":"","carac_obra-alivi":"","carac_obra-peine_debas":"","carac_obra-contradic":"","carac_obra-espigo":"","carac_obra-enroca":"","carac_obra-disenos-canales":"off","carac_obra-otros_canales":"","carac_obra-disenos-diques_cerrados":"off","carac_obra-disenos-diques_abiertos":"off","carac_obra-altura":"","carac_obra-base":"","carac_obra-ancho":"","carac_obra-longitud":"","carac_obra-diametro":"","carac_obra-area":"","carac_obra-volumen":"","danos_estruc-ex_ace_su":"off","danos_estruc-ero_estruc_inter":"off","danos_estruc-ero_cober_inter":"off","danos_estruc-def_exce_alza":"off","danos_estruc-efec_sismi":"off","danos_estruc-desli_exter":"off","danos_estruc-ruptu_fricc":"off","danos_estruc-despla_profu":"off","danos_estruc-desliza":"off","danos_estruc-desplaza":"off","danos_estruc-sobre_paso":"off","danos_estruc-vuelco":"off","danos_visivles-rup_es_cort":"off","danos_visivles-rup_falla_cort":"off","danos_visivles-rup_esfu_raspan":"off","danos_visivles-fisu_capa_concre":"off","danos_visivles-super_giro_exce":"off","danos_visivles-eroci_superfi":"off","danos_visivles-socava_base":"off","danos_visivles-discon_concre":"off","danos_visivles-figu_exce":"off","danos_visivles-colma":"off","danos_visivles-carca":"off","danos_visivles-asenta":"off","danos_funci-gene_duct":"off","danos_funci-frac_comp":"off","danos_funci-obst_alivi":"off","danos_funci-perme_cober_inter":"off","danos_funci-sedi_alt_max_obra":"off","danos_funci-infil":"off","meto_apli-prueba_mortero":"off","meto_apli-observaciones":"","nivel_contaminacion":"off","org_parti-nom_ape_1":"","org_parti-insti_1":"","org_parti-tlf_1":"","org_parti-nom_ape_2":"","org_parti-insti_2":"","org_parti-tlf_2":"","org_parti-nom_ape_3":"","org_parti-insti_3":"","org_parti-tlf_3":""}}';

// INPUTS
$formData = file_get_contents("php://input") ?: $prueba; // Obtener los datos enviados desde el formulario
$formData = json_decode($formData, true); // Decodificar los datos JSON a un array asociativo de PHP

$formData = $formData["data"] ?: []; // Acceder al array de datos dentro del objeto JSON

// EXTRACTING DATA
$FICHA_N = $formData["ficha_n"];
$COORD_E = $formData["coor_utm-e"]; 
$COORD_N = $formData["coor_utm-n"]; 
$COD_N = $formData["cod_n"]; 
$MODIFICATION = $formData["modification"]; 

// UNSET VARIABLES
unset($formData["ficha_n"]);
unset($formData["coor_utm-e"]);
unset($formData["coor_utm-n"]);
unset($formData["cod_n"]);
unset($formData["modification"]);

// RE-ORDERING DATA
// array_unshift($formData, "00"); /*
array_unshift($formData, $MODIFICATION); 

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


foreach( $data_array as $key => $value ){
    echo $key;
}

// limpiar para CVS

foreach($formData as $value){
    $value = str_replace( ",", ";", $value);
    $data_array[] = $value == "" ? "----" : $value;
}

// var_dump($data_array);

$newline =  PHP_EOL . implode(", ", $data_array);


file_put_contents($FILE_PATH, $newline, FILE_APPEND | LOCK_EX);

$response = [
    "success" => true,
    "status" => "success",
    "message" => "Registro guardado exitosamente.",
    "data" => $newline
];
echo(json_encode($response));

