<?php

/**
 * Clase encargada de hacer consultas y peticiones a la base de datos.
 * 
 * @author Jaime Molina
 *
 */
class ManagerActivity {
    
    const TABLA = 'actividad';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }

    /**
     * Funcion privada que permite a partir de un objeto crear un array ordenado con todos sus campos.
     * 
     * @param objeto que se convertira en array
     * @return array con los valores del objeto.
     */ 
    private static function _getCampos($objeto) {
        $campos = $objeto->get();
        return $campos;
    }
    
    /**
     * Devuelve una lista en formato json de los objetos Group en formato js
     * 
     */
    function json($id){
        $l = $this->getList($id);
        $s = '';
        foreach ($l as $value) {
            $s .= $value->json() . ',';
        }
        
        $s = substr($s, 0, $s.legth-1);
        
        return '{ "r" : [' . $s . '] }';
    }

    /**
     * Metodo que recibe una activity ya tratada y este metodo se encarga de generar un consulta a traves de
     * una instancia de DataBase. En caso de crear la activity tambien crea una edicion. Si no llega a insertar
     * la activity devuelve -1.
     * 
     * @param objeto activity a insertar
     * 
     * @return int id.
     */
    function add(Activity $objeto) {
        $campos = self::_getCampos($objeto);
        unset($campos['idActivity']);
        
        $r = $this->db->insertParameters(self::TABLA, $campos, false);

        return $r;
    }
    
    
    /**
     * Metodo que a partir de una activity se encarga de editarla en la base de datos. En caso de editar la 
     * activity tambien crea una edicion. Si no llega a editar la activity devuelve -1.
     * 
     * @param activitys activity que se va a editar.
     * 
     * @return int 1=>editada -1=>error 0=>no editada
     * 
     */ 
    function save(Activity $objeto) {
        $campos =self::_getCampos($objeto);
        
        $id = $campos['idActivity'];
        
        $r = $this->db->updateParameters(self::TABLA, $campos, array('idActivity' => $id) );

        return $r;
    }
    
    /**
     * Metodo que a partir del id del usuario y el id de la activity la borra.
     * 
     * @param idUsuario Es el identificador numerico del usuario.
     * @param id Es el identificador numerico de la activity.
     * 
     * @return int id de la fila borrada. 
     */ 
    function delete($id) {
        return $this->db->deleteParameters(self::TABLA, array('idActivity' => $id));
    }
    
    function deleteByTeacher($id) {
        return $this->db->deleteParameters(self::TABLA, array('idTeacher' => $id));
    }

    /**
     * Metodo que a partir del id del usuario y el id de la activity la busca en la base de datos y la devuelve.
     * 
     * @param idUsuario Es el identificador numerico del usuario.
     * @param id Es el identificador numerico de la activity.
     * 
     * @return activitys activity.
     */ 
    function get($id, $idTeacher = null) {
        
        $arg = array('idActivity' => $id);
        
        if($idTeacher != null ){
            $arg['idTeacher'] =  $idTeacher;
        }
        
        $this->db->getCursorParameters(self::TABLA, '*', $arg);
        if ($fila = $this->db->getRow()) {
            $objeto = new Activity();
            $objeto->set($fila);
            return $objeto;
        }
    }

    /**
     * Metodo que a partir del id del usuario busca en la base de datos todas las activitys asociadas.
     * 
     * @param idUsuario Es el identificador numerico del usuario.
     * 
     * @return array de activitys
     */ 
    function getList($id = '') {
        //if(is_empty($id)){
        //    $array = array('idTeacher' => $id);
        //}
        $this->db->getCursorParameters(self::TABLA, '*');
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Activity();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        return $respuesta;
    }
}