<?php

$prueba = '{"header_fecha__fecha":"2026-05-30","tiem_ins":"50:00","coor_utm__e":"728231.56","coor_utm__n":"1162120.61","ficha_n":"00-00-00-abc-00","modification":"02","cod_n":"000001","header_codigo__huso":"19","header_codigo__altura":"1","id_tec__nom_ape_1":"lo que sea","id_tec__tlf_1":"1234-1234567","id_tec__nom_ape_2":"lo que sea","id_tec__tlf_2":"0000-1234567","datos_cuenta__nombre":"lo que sea","datos_cuenta__estado":"Distrito_Capital","datos_cuenta__municipio":"Libertador","datos_cuenta__parroquia":"Caricuao","datos_cuenta__cent_pobl":"lo que sea","ent_fisi__arboreo":"arboreo","ent_fisi__arbustivos":"arbustivos","ent_fisi__herbaceos":"herbaceos","ent_fisi__area_cult":"area de cultivo","ent_fisi__sue_des":"suelos desnudos","ent_fisi__area_ocu":"area ocupada","ent_fisi__alt_pro":"10","ent_fisi__agu_neg":"aguas negras","ent_fisi__escom":"escombros","ent_fisi__basura":"basura","ent_fisi__resi_fore":"residuos forestales","ent_fisi__prese_arbol_caido":"presencia de arboles caidos","ent_fisi__agri":"agricola","ent_fisi__indus":"industrias","ent_fisi__comer":"comercios","ent_fisi__urban":"urbana","ent_fisi__variacion":"permanente","ent_fisi__retiro_cuerpo_agua":"proteccion ocupada","ent_fisi__soca_marge":"socavacion de los margenes","ent_fisi__flujo_turbu":"flujos turbulentos","ent_fisi__sedim":"sedimentos","ent_fisi__rocas":"rocas","ent_fisi__a_la_mar":"a las margenes","ent_fisi__dentro_cause":"dentro del cause","ent_fisi__obsevaciones":"lo que sea","tipo_obra__nombre":"lo que sea","tipo_obra__tiempo":"01:30","tipo_obra":"operativa","tipo_obra__con_arm":"concreto armado","tipo_obra__con_prefab":"concreto prefabricado","tipo_obra__con_cicl":"contreto ciclopeo","tipo_obra__ace_estruc":"acero estructural","tipo_obra__mampos":"mamposteria","tipo_obra__madera":"madera","tipo_obra__piedra":"piedra","tipo_obra__gavion":"gavion","tipo_obra__tierra":"tierra","tipo_obra__capta":"captacion","tipo_obra__transp":"transporte","tipo_obra__con_regu":"control y regulacion","tipo_obra__distri":"distribucion","tipo_obra__reco":"recoleccion","tipo_obra__trata":"tratamiento","tipo_obra__pro_mejo":"proteccion y mejoras","tipo_obra__trans_ene":"transformacion de energia","tipo_obra__conten":"contencion","tipo_obra__conduc":"conduccion","tipo_obra__toma":"toma","tipo_obra__con_flu":"control fluvial","tipo_obra__evacu":"evacuacion","tipo_obra__espe":"especiales","tipo_obra__drp":"20","tipo_obra__omc":"20","tipo_obra__observaciones":"lo que sea","carac_obra__diseno_obra":"gravedad","carac_obra__tipo_dique":"ventana","carac_obra__tipo_muro":"hincado","carac_obra__observaciones":"lo que sea","carac_obra__tipo_descanso":"pie","carac_obra__vertederos":"simple","carac_obra__mechi":"10","carac_obra__disp_ener":"101","carac_obra__malla_cont":"0","carac_obra__alivi":"10","carac_obra__peine_debas":"10","carac_obra__contradic":"10","carac_obra__espigo":"10","carac_obra__enroca":"10","carac_obra__disenos__canales":"rectangular","carac_obra__otros_canales":"lo que sea","carac_obra__disenos__diques_cerrados":"trapezoidal","carac_obra__disenos__diques_abiertos":"enrejado","carac_obra__altura":"10","carac_obra__base":"101","carac_obra__ancho":"01","carac_obra__longitud":"010","carac_obra__diametro":"10","carac_obra__area":"10","carac_obra__volumen":"10","danos_estruc__ex_ace_su":"exposicion del acero superficial","danos_estruc__ero_estruc_inter":"erocion de estructura interna","danos_estruc__ero_cober_inter":"erocion de cobertura interno","danos_estruc__def_exce_alza":"deformacion excesiva del alzado","danos_estruc__efec_sismi":"efecto sismico","danos_estruc__desli_exter":"deslizamiento externo","danos_estruc__ruptu_fricc":"ruptura por friccion","danos_estruc__despla_profu":"desplazamiento profundo","danos_estruc__desliza":"deslizamiento","danos_estruc__desplaza":"desplazamiento","danos_estruc__sobre_paso":"sobre paso","danos_estruc__vuelco":"vuelco","danos_visivles__rup_es_cort":"ruptura por esfuerzo cortante","danos_visivles__rup_falla_cort":"ruptura por falla de solape","danos_visivles__rup_esfu_raspan":"ruptura por esfuerzo raspante","danos_visivles__fisu_capa_concre":"fisura en la capa de concreto","danos_visivles__super_giro_exce":"superficial giro excesivo","danos_visivles__eroci_superfi":"erocion de superficie","danos_visivles__socava_base":"socavacion de la base","danos_visivles__discon_concre":"discontinuidad del concreto","danos_visivles__figu_exce":"figuracion excesiva","danos_visivles__colma":"colmatada","danos_visivles__carca":"carcavas","danos_visivles__asenta":"asentamiento","danos_funci__gene_duct":"generacion de ductos","danos_funci__frac_comp":"fracturas de compuertas","danos_funci__obst_alivi":"obstruccion de aliviaderos","danos_funci__perme_cober_inter":"permeabilidad de cobertura interna","danos_funci__sedi_alt_max_obra":"sedimiento a la altura maxima de la obra","danos_funci__infil":"infiltracion","meto_apli__prueba_mortero":"mortero grandes","meto_apli__observaciones":"lo que sea","nivel_contaminacion":"alto","org_parti__nom_ape_1":"lo que sea","org_parti__insti_1":"lo que sea","org_parti__tlf_1":"0000-0000000","org_parti__nom_ape_2":"lo que sea","org_parti__insti_2":"lo que sea","org_parti__tlf_2":"1234-1234567","org_parti__nom_ape_3":"lo que sea","org_parti__insti_3":"lo que sea","org_parti__tlf_3":"1234-7654321"}';

// INPUTS
$formData = file_get_contents("php://input") ?: $prueba; // Obtener los datos enviados desde el formulario
$formData = json_decode($formData, true); // Decodificar los datos JSON a un array asociativo de PHP


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


// DB FILE PATH
$FILE_PATH = "../DATA_GIS/GDB.txt";


// TRANSFORM FROM DATA TO STRING
$data_array = [];

// CLEAN FOR CVS FORMAT
foreach($formData as $value){
    $data_array[] = $value == "" ? "----" : $value;
}


// var_dump($data_array);
$newline =  implode("; ", $data_array);



file_put_contents($FILE_PATH, PHP_EOL . $newline, FILE_APPEND | LOCK_EX);

$response = [
    "success" => true,
    "status" => "success",
    "message" => "Registro guardado exitosamente.",
];


echo(json_encode($response));