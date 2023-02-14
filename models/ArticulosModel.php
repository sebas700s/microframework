<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class ArticulosModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $art_id;
    private $art_nombre;
    private $art_categoria;
    private $art_cantidad;
    private $categorias=[];

    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    public function getArticulo()
    {
        return $this->art_id;
    }
    public function setArticulo($art_id)
    {
        return $this->art_id = $art_id;
    }
    public function getArticuloNombre()
    {
        return $this->art_nombre;
    }
    public function setArticuloNombre($art_nombre)
    {
        return $this->art_nombre = $art_nombre;
    }
    public function getArticuloCantidad()
    {
        return $this->art_cantidad;
    }
    public function setArticuloCantidad($art_cantidad)
    {
        return $this->art_cantidad = $art_cantidad;
    }
    public function getCategoria()
    {
        return $this->art_categoria;
    }
    public function setCategoria($art_categoria)
    {
        return $this->art_categoria = $art_categoria;
    }

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM ARTICULO');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "ArticulosModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }
    public function getAllCategoria()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM CATEGORIA');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "CategoriaModel");

        //devolvemos la colección para que la vista la presente.
        return $this->categorias = $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($art_id)
    {
        $gsent = $this->db->prepare('SELECT * FROM ARTICULO where ART_ID = ?');
        $gsent->bindParam(1, $art_id);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "ArticulosModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if (!isset($this->art_id)) {
            $consulta = $this->db->prepare('INSERT INTO ARTICULO (art_nombre,art_categoria,art_cantidad ) values ( ?,?,? )');
            $consulta->bindParam(1, $this->art_nombre);
            $consulta->bindParam(2, $this->art_categoria);
            $consulta->bindParam(3, $this->art_cantidad);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE ARTICULO SET ART_NOMBRE = ?,ART_CATEGORIA= ?,ART_CANTIDAD = ? WHERE ART_ID =  ? ');
            $consulta->bindParam(1, $this->art_nombre);
            $consulta->bindParam(2, $this->art_categoria);
            $consulta->bindParam(3, $this->art_cantidad);
            $consulta->bindParam(4, $this->art_id);
            $consulta->execute();
        }
    }
    //art_id,$art_nombre,$art_categoria,$art_cantidad;
    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM ARTICULO WHERE ART_ID =  ?');
        $consulta->bindParam(1, $this->art_id);
        $consulta->execute();
    }
}
?>