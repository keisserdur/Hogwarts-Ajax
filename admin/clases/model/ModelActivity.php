<?php

class ModelActivity extends Model{

    
    function get($id, $json = true){
        $manager = new ManagerActivity();
        $activity = $manager->get($id);
        if($json){
            return $activity->json();
        }else{
            return $activity;
        }
    }

    function getList($json = true){
        $manager = new ManagerActivity();
        $list =  $manager->getList($id);
        
        $modelTeacher = new ModelTeacher();
        $modelGroup = new ModelGroup();
        
        $count = 0;
        
        foreach($list as $activity){
            $profesor = $modelTeacher->get($activity->getIdTeacher(), false);
            if($profesor == null){
                unset($list[$count]);
            }else{
                $nombreProfesor = $profesor->getNick();
                $activity->setIdTeacher($nombreProfesor);
                
                $group = $modelGroup->get($activity->getIdGroup(), false);
                if($group == null){
                    unset($list[$count]);
                }else{
                    $nombreGroup = (string)$group->getName();
                    $degreeeGroup = (string)$group->getDegree();
                    
                    $grupo = $nombreGroup . ' - ' . $degreeeGroup;
                    $activity->setIdGroup($grupo);
                }
            }
            $count++;
        }
        
        if($json){
            return $this->_json($list);
        }else{
            return $list;
        }
    }
    
    function remove($ids){
        $manager= new ManagerActivity();
        return $manager->delete($ids);
    }
    
    function removeByTeacher($ids){
        $manager= new ManagerActivity();
        return $manager->deleteByTeacher($ids);
    }
    
    /*Le pasas el ID de la actividad y te devuelve el profesore que la lleva a cabo*/
    function getTeacherByActivity($id){
        if($id!=null && $id!=""){
            $managerActivity = new ManagerActivity();
            $teacherID = $managerActivity->get($id);
            if($teacherID != -1){
                $teacherID=$teacherID->getIdTeacher();
            }
            $managerTeacher = new ManagerTeacher();
            return $managerTeacher->get($teacherID);
        }
    }
    /*Le pasas un titulo como paramaetro te pide a la base de datos la actividad por titulo*/
    function getByTitle($title){
        if($title!=null && $title!=""){
            $manager = new ManagerActivity();
            return $activity=$manager->getByTitle($title);
        }
    }
    
    function getByDescription($description){
        if($description!=null && $description!=""){
            $manager = new ManagerActivity();
            return $description=$manager->getByDescription($description);
        }
    }
    
    function getDate($date){
        if($date!=null && $date!=""){
            $manager = new ManagerActivity();
            return $date=$manager->getDate($date);
        }
    }
    
    function getByPlace($place){
        if($place!=null && $place!=""){
            $manager = new ManagerActivity();
            return $place=$manager->getPlace($place);
        }
    }
    function getByinitialTime($activity){
        if($activity!=null && $activity!=""){
            $manager = new ManagerActivity();
            return $activity=$manager->getInitialTime($activity);
        }
    }
    function getByEndTime($activity){
        if($activity!=null && $activity!=""){
            $manager = new ManagerActivity();
            return $activity=$manager->getEndTime($activity);
        }
    
    }
    
    function getPhoto($activity){
        if($activity!=null && $activity!=""){
            $manager = new ManagerActivity();
            return $activity=$manager->getPhoto($activity);
        }
    }
    
    function getactivities(){
        $manager = new ManagerActivity();
        return $manager->getList();
    }
    
    function insert($activity){
        if($activity!=null){
            $manager = new ManagerActivity();
            $manager->add($activity);
        }
    }
    
    function edit($activity){
        if($activity!=null){
            $manager = new ManagerActivity();
            $managerTeacher = new ManagerTeacher();
            $managerGroup = new ManagerGroup();
            
            $activity->setIdTeacher($managerTeacher->getIdByName($activity->getIdTeacher()));
            
            return $manager->save($activity);
        }
    }

}