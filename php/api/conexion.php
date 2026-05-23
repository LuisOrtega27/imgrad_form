<?php
    
$host = 'localhost';
$db   = 'nombre_de_tu_base_de_datos';
$user = 'tu_usuario';
$pass = 'tu_contraseña';
$charset = 'utf8mb4';

// Configuración de la conexión
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Activa el reporte de errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve los datos en arrays asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva la emulación para mayor seguridad
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "¡Conexión exitosa a la base de datos!";
} catch (\PDOException $e) {
     // Si hay un error, se captura aquí sin exponer datos sensibles
     echo "Error de conexión: " . $e->getMessage();
}

// get last cod_n
$query = "SELECT cod_n FROM data ORDER BY cod_n DESC LIMIT 1"