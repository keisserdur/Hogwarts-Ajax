<?php

class ViewAjax extends View{
    
    function render() {
        foreach($this->getModel()->getData() as $key => $value){
            //if( Util::isJSON($value) ){
                echo $value;
            // }else{
            //     echo json_encode(array($key => $value));
            // }
        }
    }
    
    /*
    
    $tam = count($this->getModel()->getData());
        $count = 0;
        echo '{';
        foreach($this->getModel()->getData() as $key => $value){
            echo '"data' . $count . '" : ';
            if( Util::isJSON($value) ){
                echo $value;
            }else{
                echo json_encode(array($key => $value));
            }
            
            if($count != $tam-1){
                echo ' , ';
            }
            
            $count += 1;
        }
        echo '}';
    
    
    
    */
    
}