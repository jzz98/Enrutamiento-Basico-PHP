<?php

use routers\Router;

$server = "localhost";
$user = 'root';
$password = 'root';
$db = 'Routing';

$conection = new mysqli($server, $user, $password, $db);

if($conection -> connect_errno){
    die('Conexion fallida'.$conection->connect_errno);
}

Router::get('/home', function() {
    require_once './src/templates/home.php';
});

Router::get('/about', function(){
    require_once './src/templates/about.php';
});

Router::post('/about', function(){
    global $conection;

    $nombre = $_POST['Nombre'];
    $password = $_POST['Contraseña'];

    $sql = "INSERT INTO Users(Nombre, Contraseña) VALUES(?, ?)";
    $stmt = $conection->prepare($sql);

    if($stmt){
        $stmt->bind_param("ss", $nombre, $password);

        if($stmt->execute()){
            header('Location: /about');
        }else{
            echo "Error al insertar";
        }
    
        $stmt->close();
    }else{
        echo "Error al hacer la consulta";
    }
});

Router::Run();