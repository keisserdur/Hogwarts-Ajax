<?php

class Controller {

    private $model, $session;
    
    function __construct(Model $model) {
        $this->model = $model;
        $this->session = Session::getInstance(Constants::SESSIONNAME);
    }
    
    function getModel(){
        return $this->model;
    }
    
    function getSession(){
        return $this->session;
    }

    function index() {
        $this->getModel()->setData('pagina', 'index');
    }

}