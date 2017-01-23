<?php


// web/index.php

// CARGA DEL MODELO Y DE LOS CONTROLADORES

require_once __DIR__.'/../app/Config.php';
require_once __DIR__.'/../app/Model.php';
require_once __DIR__.'/../app/Controller.php';

// ENRUTAMIENTO

$map= array(
    'inicio'=>array('controller'=>'Controller','action'=>'inicio'),
    'listar'=>array('controller'=>'Controller','action'=>'listar'),
    'insertar'=>array('controller'=>'Controller','action'=>'insertar'),
    'buscar'=>array('controller'=>'Controller','action'=>'buscarPorNombre'),
    'ver'=>array('controller'=>'Controller','action'=>'ver')
);

// PARSEO DE LA RUTA

if(isset($_GET['clt'])) {
    
    if(isset($map[$_GET['clt']])) {
        $ruta=$_GET['clt'];
    } else {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta<i>'.
                $_GET['clt'].
                '</p></body></html>';
        exit;
    }
    
} else {
    
    $ruta='inicio';
    
}

$controlador=$map[$ruta];

//EJECUCIÓN DEL CONTROLADOR ASOCIADO A LA RUTA

if (method_exists($controlador['controller'], $controlador['action'])) {
    call_user_func(array(new $controlador['controller'],$controlador['action']));
}else {
    
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>'.
            $controlador['controller'].'->'.$controlador['action'].
            '</i>no existe</h1></body></html>';
}