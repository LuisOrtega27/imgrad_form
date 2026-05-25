<?php
// Configurar cabeceras para responder en formato JSON
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *"); // Permite peticiones desde cualquier frontend
    
$host = 'localhost';
$db   = 'ficha_b';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';


// Configuración de la conexión
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Activa el reporte de errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve los datos en arrays asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva la emulación para mayor seguridad
];

$METHOD = $_SERVER['REQUEST_METHOD'];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     
     // get last cod_n

     if($METHOD === "GET"){
          $query = "INSERT INTO `data` () VALUES ();";
          $pdo->exec($query);
          $reserved_id = $pdo->lastInsertId(); 
          
          http_response_code(200);
          echo json_encode([
               "status"=> "success",
               "data"=> $reserved_id 
          ]);
     }
     


} catch (\PDOException $e) {
     // Si hay un error, se captura aquí sin exponer datos sensibles
     http_response_code(500);
     echo json_encode([
          "status"=> "error",
          "message"=> $e->getMessage() 
     ]);
}
