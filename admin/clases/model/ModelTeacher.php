<?php

class ModelTeacher extends Model{
        
        function get($id,$json = true){
            $manager = new ManagerTeacher();
            $teacher=$manager->get($id);
            if($json){
                return $teacher->json();
            }else{
              return $teacher;
            }
        }
        
         function getList($json = true){
            $manager = new ManagerTeacher();
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
                $manager = new ManagerTeacher();
                $teacher=$manager->getByName($name);
                return $teacher;
            }
                
        }
        
        function getByDepartment($department){
            $manager = new ManagerTeacher();
            $teachers =$manager->getForDepartment($department);
             if($department!=null)
             {
                if(is_array($teachers))
                    {
                         foreach($teachers as $teacher)
                         {
                            $result[] = $teacher;
                         }
                }else{
                    $result=$teachers;
                }
                 
             }
            return $result;
            
        }
        
        function getTeachers(){
            $manager = new ManagerTeacher();
            return $manager->getList();
         }
        
        function insert($teacher){
             if($teacher!=null)
             {
                $manager = new ManagerTeacher();
                $manager->add($teacher);
             }
        }
        
        function edit($teacher){
             if($teacher!=null)
             {
                $manager = new ManagerTeacher();
                return $manager->save($teacher);
             }
            
        }
         function remove($ids){
            $manager= new ManagerTeacher();
            return $manager->delete($ids);
        }
        
        function doLogin($teacher){
            $result= false;
            $manager = new ManagerTeacher;
            $teacherDB = $manager->getByName($teacher->getNick());
            
            if($teacherDB != null){
                $result = ($teacherDB->getPassword() == $teacherDB->getPassword() ? 'true' : 'false');
            }
            
            if($result){
                $session = Session::getInstance(Constants::SESSIONNAME);
                $session->setUser($teacherDB);
                
                
            }
            return $result;
            
        }
}