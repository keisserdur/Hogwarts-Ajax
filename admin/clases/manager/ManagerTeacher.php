<?php

/**
 * Clase encargada de hacer consultas y peticiones a la base de datos.
 * 
 * @author Jaime Molina
 *
 */
class ManagerTeacher {
    
    const TABLA = 'profesor';
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
     * Metodo que recibe una teacher ya tratada y este metodo se encarga de generar un consulta a traves de
     * una instancia de DataBase. En caso de crear la teacher tambien crea una edicion. Si no llega a insertar
     * la teacher devuelve -1.
     * 
     * @param objeto teacher a insertar
     * 
     * @return int id.
     */
    function add(Teacher $objeto) {
        $campos = self::_getCampos($objeto);
        unset($campos['idTeacher']);
        
        $r = $this->db->insertParameters(self::TABLA, $campos, false);

        return $r;
    }
    
    
    /**
     * Metodo que a partir de una teacher se encarga de editarla en la base de datos. En caso de editar la 
     * teacher tambien crea una edicion. Si no llega a editar la teacher devuelve -1.
     * 
     * @param teachers teacher que se va a editar.
     * 
     * @return int 1=>editada -1=>error 0=>no editada
     * 
     */ 
    function save(Teacher $objeto) {
        $campos =self::_getCampos($objeto);
        $id = $campos['idTeacher'];
        
        $r = $this->db->updateParameters(self::TABLA, $campos, array('idTeacher' => $id) );

        return $r;
    }
    
    /**
     * Metodo que a partir del id del usuario y el id de la teacher la borra.
     * 
     * @param idUsuario Es el identificador numerico del usuario.
     * @param id Es el identificador numerico de la teacher.
     * 
     * @return int id de la fila borrada. 
     */ 
    function delete($id) {
        return $this->db->deleteParameters(self::TABLA, array('idTeacher' => $id));
    }

    /**
     * Metodo que a partir del id del usuario y el id de la teacher la busca en la base de datos y la devuelve.
     * 
     * @param idUsuario Es el identificador numerico del usuario.
     * @param id Es el identificador numerico de la teacher.
     * 
     * @return teachers teacher.
     */ 
    function get($id) {
        $this->db->getCursorParameters(self::TABLA, '*', array('idTeacher' => $id));
        if ($fila = $this->db->getRow()) {
            $objeto = new Teacher();
            $objeto->set($fila);
            return $objeto;
        }
    }
    
    function getByName($nick) {
        $this->db->getCursorParameters(self::TABLA, '*', array('nick' => $nick));
        if ($fila = $this->db->getRow()) {
            $objeto = new Teacher();
            $objeto->set($fila);
            return $objeto;
        }
    }

    /**
     * Metodo que a partir del id del usuario busca en la base de datos todas las teachers asociadas.
     * 
     * @param idUsuario Es el identificador numerico del usuario.
     * 
     * @return array de teachers
     */ 
    function getList($id = null) {
        $arg = array();
        if($id != null){
            $arg = array('idTeacher' => $id);
        }
        $this->db->getCursorParameters(self::TABLA, '*', $arg);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Teacher();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        return $respuesta;
    }
    
    function getIdByName($name = null){
        if($name != null){
            $this->db->getCursorParameters(self::TABLA, '*', array('nick' => $name));
            if ($fila = $this->db->getRow()) {
                $objeto = new Teacher();
                $objeto->set($fila);
                return $objeto->getIdTeacher();
            }
        }
    }
}