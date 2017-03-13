<?php
/*
    idTeacher int auto_increment primary key,
    nick varchar(100) unique,
    password varchar(256) not null,
    department varchar(150) default 'Sin department',
    admin tinyint not null
*/
class Teacher {
    
    private $idTeacher,$nick, $password,$department,$admin;
    
    function __construct( $idTeacher = null, $nick = null, $password = null, $department = null, $admin = 0 ) {
        $this->idTeacher=$idTeacher;
        $this->nick = $nick;
        $this->password = $password;
        $this->department = $department;
        $this->admin = $admin;
    }
    function getIdTeacher(){
        return $this->idTeacher;
    }
    function getNick() {
        return $this->nick;
    }

    function getPassword() {
        return $this->password;
    }
    function getDepartment() {
        return $this->department;
    }
    function getAdmin() {
        return $this->admin;
    }
    
    function setIdTeacher($idTeacher){
        $this->idTeacher=$idTeacher;
    }
    
    function setNick($nick) {
        $this->nick = $nick;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    function setDepartment($department) {
        $this->department = $department;
    }
    function setAdmin($admin) {
        $this->admin = $admin;
    }

    function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$key => $valor - ";
        }
        return $r;
    }
    
    function json() {
        return json_encode($this->get());
    }
    
    function read(ObjectReader $reader = null){
        if($reader===null){
            $reader = 'Request';
        }
        foreach($this as $key => $valor) {
            $this->$key = $reader::read($key);
        }
    }
    
    function get(){
        $nuevoArray = array();
        foreach($this as $key => $valor) {
            $nuevoArray[$key] = $valor;
        }
        return $nuevoArray;
    }
    
    function set(array $array, $inicio = 0) {
        $this->idTeacher=$array[0+$idTeacher];
        $this->nick = $array[1 + $inicio];
        $this->password = $array[2 + $inicio];
        $this->department = $array[3 + $inicio];
        $this->admin = $array[4 + $inicio];
    }
    
}