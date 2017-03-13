<?php

class ModelGroup extends Model{
        
        function get($id,$json){
            $manager = new ManagerGroup();
            $group = $manager->get($id);
            if($json){
                 return $group->json();
            }else{
                return $group;
            }
           
        }
        
        function getList($json = true){
            $manager = new ManagerGroup();
            $list =  $manager->getList();
            
            if($json){
                return $this->_json($list);
            }else{
                return $list;
            }
        }
        
        function getByName($name){
            if($name!=null && $name!="")
            {
                $manager = new ManagerGroup();
                $group=$manager->getByName($name);
                return $group->json();
            }
                
        }
        
        function getByDegree($degree){
            if($degree!=null && $degree!="")
            {
                $manager = new ManagerGroup();
                $group=$manager->getByLevel($degree);
                return $group->json();
            }
                
        }
        
        function insert(Group $group){
            if( $group !== null ){
                $manager = new ManagerGroup();
                $r = $manager->add($group);
                
                // if($r <= 0){
                //     return $r;
                // }else{
                //     return $this->get($r);
                // }
            }
        }
        
        function edit(Group $group){
             if($group!=null)
             {
                $manager = new ManagerGroup();
                return $manager->save($group);
             }
            
        }
        
        function remove($ids){
            $manager= new ManagerGroup();
            return $manager->delete($ids);
        }
        
}