<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class CategoriaModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $cat_id;
    private $cat_nombre;


    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    public function getCategoria()
    {
        return $this->cat_id;
    }
    public function setCategoria($cat_id)
    {
        return $this->cat_id = $cat_id;
    }
    public function getCategoriaNombre()
    {
        return $this->cat_nombre;
    }
    public function setCategoriaNombre($cat_nombre)
    {
        return $this->cat_nombre = $cat_nombre;
    }
    
    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM CATEGORIA');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "CategoriaModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($art_id)
    {
        $gsent = $this->db->prepare('SELECT * FROM CATEGORIA where CAT_ID = ?');
        $gsent->bindParam(1, $art_id);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "CategoriaModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if (!isset($this->cat_id)) {
            $consulta = $this->db->prepare('INSERT INTO CATEGORIA (CAT_NOMBRE) values ( ?)');
            $consulta->bindParam(1, $this->cat_nombre);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE CATEGORIA SET CAT_NOMBRE = ? WHERE CAT_ID =  ? ');
            $consulta->bindParam(1, $this->cat_nombre);
            $consulta->bindParam(2, $this->cat_id);
            $consulta->execute();
        }
    }
    //art_id,$art_nombre,$art_categoria,$art_cantidad;
    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM CATEGORIA WHERE CAT_ID =  ?');
        $consulta->bindParam(1, $this->cat_id);
        $consulta->execute();
    }
}
?>