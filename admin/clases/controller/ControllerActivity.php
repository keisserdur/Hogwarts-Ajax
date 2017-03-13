<?php

class ControllerActivity extends Controller{

    
    function get(){
        if($this->session->is){
            $activity = new Activity();
            $activity->read();
            echo $this->getModel()->get($activity);
        }
    }
    
    function getByShortTitle($shortTitle){
        return $this->getModel()->getByShortTitle($shortTitle);
    }
    
    function getByDate($date){
        return $this->getModel()->getByDate($date);
    }
    
    function getByDescription($description){
        return $this->getModel()->getByDescription($description);
    }
    
    function doinsert(){
        $session = Session::getInstance(Constants::SESSIONNAME);
        
        if($session->isLogged()){
            $user = $session->getUser();
            $activity = new Activity();
            $activity->read();
            
            $file = new FileUpload('photo');
            
            if($file->upload()){
                $activity->setPhoto($file->getFullName());
            }
            $activity->setIdTeacher($user->getIdTeacher());
            
            $r = $this->getModel()->insert($activity);
            
            $this->getListJson();
        }
    }
    
    function dodelete(){
        $array = $_POST['id'];
        $ids = $array['id'];
        
        $r = $this->getModel()->remove($ids);
        
        $listactivity = $this->getModel()->getList();
        $this->getModel()->setData('listActivity', $listactivity);
        
    }
    
    function doedit(){
        $activity = new Activity();
        $activity->read();
        
        $file = new FileUpload('photo');
            
        if($file->upload()){
            $activity->setPhoto($file->getFullName());
        }
        
        
        $r = $this->getModel()->edit($activity);
        
        
        $listactivity = $this->getModel()->getList();
        $this->getModel()->setData('listActivity', $listactivity);
    }
    
    function getList(){
        $this->getListJson(false);
    }
    
    function getListJson($json = true){
        $listactivity = $this->getModel()->getList($json);
        $this->getModel()->setData('listActivity', $listactivity);  
    }
    
    function getatributes(){
        $activity = new Activity();
        echo $activity->json();
    }
}