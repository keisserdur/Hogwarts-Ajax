<?php

class ControllerAjax extends Controller{
    function index(){
        
    }
    
    function login(){
        /*$this->getModel()->setData('login', '1');*/
        $info = $this->getModel()->doLogin(Request::read('email'), Request::read('password'));
        $users = $this->getModel()->getUsers();
        if($info === false){
            $this->getModel()->setData('login', 0);
        }else{
            $this->getModel()->setData('login', 1);
            $this->getModel()->setData('info', $info);
            $this->getModel()->setData('users', $users);
        }
    }
    
    function doprueba(){
        $r = $this->getModel()->doPrueba();
        $this->getModel()->setData('info', $r);
    }
}