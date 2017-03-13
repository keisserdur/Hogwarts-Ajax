<?php
/*
create table Group (
    idGroup int auto_increment primary key,
    name varchar(150) not null,
    degree varchar(100)
*/
class Group {
    
    private $idGroup, $name, $degree;
    
    function __construct($idGroup = null, $name = null, $degree = null) {
        $this->idGroup = $idGroup;
        $this->name = $name;
        $this->degree= $degree;
    }
    
    function getIdGroup() {
        return $this->idGroup;
    }

    function getName() {
        return $this->name;
    }
    function getDegree() {
        return $this->degree;
    }

    function setIdGroup($idGroup) {
        $this->idGroup = $idGroup;
    }

    function setName($name) {
        $this->name = $name;
    }
    function setDegree($degree) {
        $this->degree = $degree;
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
        $this->idGroup = $array[0 + $inicio];
        $this->name = $array[1 + $inicio];
        $this->degree = $array[2 + $inicio];
    }
    
}