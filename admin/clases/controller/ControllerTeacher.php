<?php

class ControllerTeacher extends Controller{
    
    
    function get(){
        $teacher = new Teacher();
        $teacher->read();
        echo $this->getModel()->get($teacher);
    }
    
    function getByNick($nick){
        echo $this->getModel()->getByNick($nick);
    }
    
    function getByPassword($password){
        echo $this->getModel()->getByPassword($password);
    }
    
    function getByDepartment($department){
        echo $this->getModel()->getByDepartment($department);
    }
    
    function getByAdmin($admin){
        echo $this->getModel()->getByAdmin($admin);
    }
    
    function doinsert(){
        $teacher = new Teacher();
        $teacher->read();
        $r = $this->getModel()->insert($teacher);
        
        $this->getListJson();
    }
    
    function dodelete(){
        $array = $_POST['id'];
       
        $ids = $array['id'];
        
        $r = $this->getModel()->remove($ids);
        
        $modelActivity = new ModelActivity();
        $modelActivity->removeByTeacher($ids);
        
        $listTeacher = $this->getListJson();
    }
    
    function doedit(){
        $teacher = new Teacher();
        $teacher->read();
        
        $r = $this->getModel()->edit($teacher);
        
        $listTeacher = $this->getListJson();
    }
    
    function getList(){
        $this->getListJson(false);
    }
    
    function getListJson($json = true){
        $listTeacher = $this->getModel()->getList($json);
        $this->getModel()->setData('listTeacher', $listTeacher);  
    }
    
    function getatributes(){
        $object = new Teacher();
        echo $object->json();
    }
    
    function getuserlogin(){
         $session = Session::getInstance(Constants::SESSIONNAME);
         
         $user = $session->getUser()->get();
         unset($user['password']);
         
         $this->getModel()->setData('islogin', json_encode($user));
    }
    
    function dologin(){
        $session = Session::getInstance(Constants::SESSIONNAME);
        if($session->isLogged()){
            $session->destroy();
            $session->close();
        }
        
        $profesorALoguear = new Teacher();
        $profesorALoguear->read();
        $login = $this->getModel()->doLogin($profesorALoguear);
        
        $stringLogin = $login ? 'true' : 'false';
        
        $this->getModel()->setData('islogin', $stringLogin);
    }
    
    function dologout(){
        $session = Session::getInstance(Constants::SESSIONNAME);
        $session->destroy();
        $session->close();
    }
    
    function islogin(){
        $session = Session::getInstance(Constants::SESSIONNAME);
        $login = $session->isLogged();
        
        
        $stringLogin = $login ? 'true' : 'false';
        
        if(!$login){
            $session->destroy();
            $session->close();
        }
        
        $this->getModel()->setData('islogin', $stringLogin);
    }
    
}