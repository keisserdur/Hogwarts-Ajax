<?php

class Model {
    
    private $data = array();
    
    function getData(){
        return $this->data;
    }
    
    function setData($name, $value){
        $this->data[$name] = $value;
    }
    function _json($list){
        $s = '';
        foreach ($list as $value) {
            $s .= $value->json() . ',';
        }
        $s = substr($s, 0, $s.legth-1);
        return '{ "data" : [' . $s . '] }';
    }
}