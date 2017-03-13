<?php

class Router {

    private $rutas = array();

    function __construct() {
        $this->rutas['index'] = new Route('Model', 'View', 'Controller');
        $this->rutas['ajaxactividad'] = new Route('ModelActivity', 'ViewAjax', 'ControllerActivity');
        $this->rutas['ajaxgrupo'] = new Route('ModelGroup', 'ViewAjax', 'ControllerGroup');
        $this->rutas['ajaxprofesor'] = new Route('ModelTeacher', 'ViewAjax', 'ControllerTeacher');
    }

    function getRoute($ruta) {
        if (!isset($this->rutas[$ruta])) {
            return $this->rutas['index'];
        }
        return $this->rutas[$ruta];
    }

}