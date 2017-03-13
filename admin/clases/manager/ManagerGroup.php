<?php

/**
 * Clase encargada de hacer consultas y peticiones a la base de datos.
 * 
 * @author Jaime Molina
 *
 */
class ManagerGroup {
    
    const TABLA = 'grupo';
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
     * Metodo que recibe un grupo ya tratada y este metodo se encarga de generar un consulta a traves de
     * una instancia de DataBase. Si no llega a insertar el grupo devuelve -1.
     * 
     * @param objeto grupo a insertar
     * 
     * @return int id.
     */
    function add(Group $objeto) {
        $campos = self::_getCampos($objeto);
        unset($campos['idGroup']);
        return $this->db->insertParameters(self::TABLA, $campos);
    }
    
    
    /**
     * Metodo que a partir de un grupo se encarga de editarla en la base de datos. Si no llega a editar 
     * el grupo devuelve -1.
     * 
     * @param Group grupo que se va a editar.
     * 
     * @return int 1=>editada -1=>error 0=>no editada
     * 
     */ 
    function save(Group $objeto) {
        $campos =self::_getCampos($objeto);
        $id = $campos['idGroup'];
        
        $r = $this->db->updateParameters(self::TABLA, $campos, array('idGroup' => $id) );

        return $r;
    }
    
    /**
     * Metodo que a partir del id del usuario y el id de la grupo la borra.
     * 
     * @param id Es el identificador numerico del grupo.
     * 
     * @return int id de la fila borrada. 
     */ 
    function delete($id) {
        return $this->db->deleteParameters(self::TABLA, array('idGroup' => $id));
    }

    /**
     * Metodo que a partir del id del usuario y el id de la grupo la busca en la base de datos y la devuelve.
     * 
     * @param id Es el identificador numerico del grupo.
     * 
     * @return Group grupo.
     */ 
    function get($id) {
        $this->db->getCursorParameters(self::TABLA, '*', array('idGroup' => $id));
        if ($fila = $this->db->getRow()) {
            $objeto = new Group();
            $objeto->set($fila);
            return $objeto;
        }
    }

    /**
     * Metodo que a partir del id del usuario busca en la base de datos todas las grupos asociadas.
     *  
     * @return array de Grupos
     */ 
    function getList() {
        $this->db->getCursorParameters(self::TABLA, '*');
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Group();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        
        return $respuesta;
    }
}