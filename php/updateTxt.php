<?php
// INPUTS

$formData = $_POST;

// FILE

// $file = fopen("../DATA_GIS/GDB.txt", "w") or die("Unable to open file!");


// 
foreach($formData as $key => $value){

    $value = $value != NULL ? $value :  "EMPTY";

    echo "{$key}. => {$value}<br>";
    // echo "{$key},";
}
