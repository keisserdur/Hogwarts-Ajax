<?php

require_once('clases/AutoLoad.php');

$ruta = Request::read("ruta");
$accion = Request::read("accion");

$frontController = new FrontController($ruta);

$frontController->doAction($accion);

echo $frontController->getOutput();