<?php

class ControllerGroup extends Controller{
    
    function get(){
        $id= Request::read('idGroup');
        //$name= Request::read('name');
        
        $result = $this->getModel()->get($id);
        
        //echo $result;
        
        //$this->_getByName($name);
    }
    
    function _getByName($name){
        return $this->getModel()->getByName($name);
    }
    
    function _getByDegree($degree){
        return $this->getModel()->getByDegree($degree);
    }

    function doinsert(){
        $group = new Group();
        $group->read();
        $r = $this->getModel()->insert($group);
        $this->getListJson();
    }
    
    function dodelete(){
        $array = $_POST['id'];
        $ids = $array['id'];
        
        
        $r = $this->getModel()->remove($ids);
        
        $listGroup = $this->getListJson();
    }
    
    function doedit(){
        $group = new Group();
        $group->read();
        
        $this->getModel()->edit($group);
        
        $lista = $this->getListJson();
    }
    
    function getList(){
        $this->getListJson(false);
    }
    
    function getListJson($json = true){
        $listGroup = $this->getModel()->getList($json);
        $this->getModel()->setData('listGroup', $listGroup);
    }
    
    function getatributes(){
        $group = new Group();
        echo $group->json();
    }
}