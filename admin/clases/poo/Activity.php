<?php

class Activity {
    
    private $idActivity, $idTeacher, $idGroup, $shortTitle, $description, $day, $place, $startTime, $endTime, $photo;
    
    function __construct($idActivity = null, $idTeacher = null, $idGroup = null, 
                        $shortTitle = null, $description = null, $day = null, $place = null,
                        $startTime = null, $endTime = null, $photo = null) {
        
        $this->idActivity = $idActivity;
        $this->idTeacher = $idTeacher;
        $this->idGroup = $idGroup;
        $this->shortTitle = $shortTitle;
        $this->description = $description;
        $this->day = $day;
        $this->place = $place;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->photo = $photo;
        
    }
    
    function getIdActivity() {
        return $this->idActivity;
    }
    function getIdTeacher() {
        return $this->idTeacher;
    }
    function getIdGroup() {
        return $this->idGroup;
    }
    function getShortTitle() {
        return $this->shortTitle;
    }
    function getDescription() {
        return $this->description;
    }
    function getDate() {
        return $this->day;
    }
    function getPlace() {
        return $this->place;
    }
    function getStartTime() {
        return $this->startTime;
    }
    function getEndTime() {
        return $this->endTime;
    }
    function getPhoto() {
        return $this->photo;
    }
    

    function setIdActivity($value) {
        $this->idActivity = $value;
    }
    function setIdTeacher($value) {
        $this->idTeacher = $value;
    }
    function setIdGroup($value) {
        $this->idGroup = $value;
    }
    function setShortTitle($value) {
        $this->shortTitle = $value;
    }
    function setDescription($value) {
        $this->description = $value;
    }
    function setDate($value) {
        $this->day = $value;
    }
    function setPlace($value) {
        $this->place = $value;
    }
    function setStartTime($value) {
        $this->startTime = $value;
    }
    function setEndTime($value) {
        $this->endTime = $value;
    }
    function setPhoto($value) {
        $this->photo = $value;
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
        $this->idActivity = $array[0 + $inicio];
        $this->idTeacher = $array[1 + $inicio];
        $this->idGroup = $array[2 + $inicio];
        $this->shortTitle = $array[3 + $inicio];
        $this->description = $array[4 + $inicio];
        $this->day = $array[5 + $inicio];
        $this->place = $array[6 + $inicio];
        $this->startTime = $array[7 + $inicio];
        $this->endTime = $array[8 + $inicio];
        $this->photo = $array[9 + $inicio];
        
    }
}