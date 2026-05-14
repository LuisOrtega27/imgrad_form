<?php
require __DIR__ . "/find_reserved_id_position.php";

$prueba = '{"data":{"header_fecha__fecha":"12/12/2026","tiem_ins":"50:00","coor_utm__e":"123456,12","coor_utm__n":"1234567,12","ficha_n":"abc123abc","modification":"00","cod_n":"000033","header_codigo__huso":"465464","header_codigo__altura":"","id_tec__nom_ape_1":"","id_tec__tlf_1":"","id_tec__nom_ape_2":"","id_tec__tlf_2":"","datos_cuenta__nombre":"","datos_cuenta__estado":"Distrito_Capital","datos_cuenta__municipio":"Libertador","datos_cuenta__parroquia":"","datos_cuenta__cent_pobl":"","ent_fisi__arboreo":"off","ent_fisi__arbustivos":"off","ent_fisi__herbaceos":"off","ent_fisi__area_cult":"off","ent_fisi__sue_des":"off","ent_fisi__area_ocu":"off","ent_fisi__alt_pro":"","ent_fisi__agu_neg":"off","ent_fisi__escom":"off","ent_fisi__basura":"off","ent_fisi__resi_fore":"off","ent_fisi__prese_arbol_caido":"off","ent_fisi__agri":"off","ent_fisi__indus":"off","ent_fisi__comer":"off","ent_fisi__urban":"off","ent_fisi__variacion":"off","ent_fisi__retiro_cuerpo_agua":"off","ent_fisi__soca_marge":"off","ent_fisi__flujo_turbu":"off","ent_fisi__sedim":"off","ent_fisi__rocas":"off","ent_fisi__a_la_mar":"off","ent_fisi__dentro_cause":"off","ent_fisi__obsevaciones":"","tipo_obra__nombre":"","tipo_obra__tiempo":"","tipo_obra__opera":"off","tipo_obra__inopera":"off","tipo_obra__limit":"off","tipo_obra__con_arm":"off","tipo_obra__con_prefab":"off","tipo_obra__con_cicl":"off","tipo_obra__ace_estruc":"off","tipo_obra__mampos":"off","tipo_obra__madera":"off","tipo_obra__piedra":"off","tipo_obra__gavion":"off","tipo_obra__tierra":"off","tipo_obra__capta":"off","tipo_obra__transp":"off","tipo_obra__con_regu":"off","tipo_obra__distri":"off","tipo_obra__reco":"off","tipo_obra__trata":"off","tipo_obra__pro_mejo":"off","tipo_obra__trans_ene":"off","tipo_obra__conten":"off","tipo_obra__conduc":"off","tipo_obra__toma":"off","tipo_obra__con_flu":"off","tipo_obra__evacu":"off","tipo_obra__espe":"off","tipo_obra__drp":"","tipo_obra__omc":"","tipo_obra__observaciones":"","carac_obra__diseno_obra":"off","carac_obra__tipo_dique":"off","carac_obra__tipo_muro":"off","carac_obra__observaciones":"","carac_obra__tipo_descanso":"off","carac_obra__vertederos":"off","carac_obra__mechi":"","carac_obra__disp_ener":"","carac_obra__malla_cont":"","carac_obra__alivi":"","carac_obra__peine_debas":"","carac_obra__contradic":"","carac_obra__espigo":"","carac_obra__enroca":"","carac_obra__disenos__canales":"off","carac_obra__otros_canales":"","carac_obra__disenos__diques_cerrados":"off","carac_obra__disenos__diques_abiertos":"off","carac_obra__altura":"","carac_obra__base":"","carac_obra__ancho":"","carac_obra__longitud":"","carac_obra__diametro":"","carac_obra__area":"","carac_obra__volumen":"","danos_estruc__ex_ace_su":"off","danos_estruc__ero_estruc_inter":"off","danos_estruc__ero_cober_inter":"off","danos_estruc__def_exce_alza":"off","danos_estruc__efec_sismi":"off","danos_estruc__desli_exter":"off","danos_estruc__ruptu_fricc":"off","danos_estruc__despla_profu":"off","danos_estruc__desliza":"off","danos_estruc__desplaza":"off","danos_estruc__sobre_paso":"off","danos_estruc__vuelco":"off","danos_visivles__rup_es_cort":"off","danos_visivles__rup_falla_cort":"off","danos_visivles__rup_esfu_raspan":"off","danos_visivles__fisu_capa_concre":"off","danos_visivles__super_giro_exce":"off","danos_visivles__eroci_superfi":"off","danos_visivles__socava_base":"off","danos_visivles__discon_concre":"off","danos_visivles__figu_exce":"off","danos_visivles__colma":"off","danos_visivles__carca":"off","danos_visivles__asenta":"off","danos_funci__gene_duct":"off","danos_funci__frac_comp":"off","danos_funci__obst_alivi":"off","danos_funci__perme_cober_inter":"off","danos_funci__sedi_alt_max_obra":"off","danos_funci__infil":"off","meto_apli__prueba_mortero":"off","meto_apli__observaciones":"","nivel_contaminacion":"off","org_parti__nom_ape_1":"","org_parti__insti_1":"","org_parti__tlf_1":"","org_parti__nom_ape_2":"","org_parti__insti_2":"","org_parti__tlf_2":"","org_parti__nom_ape_3":"","org_parti__insti_3":"","org_parti__tlf_3":""}}';

// INPUTS
$formData = file_get_contents("php://input") ?: $prueba; // Obtener los datos enviados desde el formulario
$formData = json_decode($formData, true); // Decodificar los datos JSON a un array asociativo de PHP

$formData = $formData["data"] ?: []; // Acceder al array de datos dentro del objeto JSON



// EXTRACTING DATA
$MODIFICATION = $formData["modification"]; 
$FICHA_N = $formData["ficha_n"];
$COORD_E = $formData["coor_utm__e"]; 
$COORD_N = $formData["coor_utm__n"]; 
$COD_N = $formData["cod_n"]; 


// UNSET VARIABLES
unset($formData["modification"]);
unset($formData["ficha_n"]);
unset($formData["coor_utm__e"]);
unset($formData["coor_utm__n"]);
unset($formData["cod_n"]);

// RE-ORDERING DATA
$newTempArr = ["cod_n" => $COD_N, "coor_utm__n" => $COORD_N, "coor_utm__e" => $COORD_E, "ficha_n" => $FICHA_N, "modification" => $MODIFICATION];
$formData = array_merge($newTempArr, $formData);
/*
    esto lleva el historial de actualizaciones, el valor "00" indica que es un nuevo registro, 
    si el valor es distinto a "00", indica que es una modificacion de un registro existente, 
    y al valor ID del registro se aumenta en +1, para mantener un historial de modificaciones.
*/ 
//Agregar el ID unico al inicio del array de datos para mantener un formato consistente en el txt



// DB FILE PATH
$FILE_PATH = "../DATA_GIS/GDB.txt";
$position = -1;

// TRANSFORM FROM DATA TO STRING
$data_array = [];

// CLEAN FOR CVS FORMAT
foreach($formData as $value){
    $data_array[] = $value == "" ? "----" : $value;
}

// var_dump($data_array);
$newline =  implode("; ", $data_array);


// Buscar posicion del ID reservado (ID de la ficha === ID en el txt)
// reemplazar la linea con unicamente el ID y poner todos los datos

find_reserved_id_position($formData["cod_n"], $newline);

$response = [
    "success" => true,
    "status" => "success",
    "message" => "Registro guardado exitosamente.",
    "data" => $newline
];
echo(json_encode($response));

