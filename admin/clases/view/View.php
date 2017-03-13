<?php

class View {

    private $model;
    
    function __construct(Model $model) {
        $this->model = $model;
    }
    
    function getModel(){
        return $this->model;
    }
    
    function render() {
        return Util::renderFile('plantilla/_index.html');
    }
    
}