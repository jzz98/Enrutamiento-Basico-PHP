<?php

use routers\Router;

Router::get('/home', function() {
    require_once './src/templates/home.php';
});

Router::get('/about', function(){
    require_once './src/templates/about.php';
});

Router::Run();