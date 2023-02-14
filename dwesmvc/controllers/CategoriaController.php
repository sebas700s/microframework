<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class CategoriaController
{
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los items almacenados
    public function listar()
    {
        //Incluye el modelo que corresponde
        require 'models/CategoriaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $categorias = new CategoriaModel();

        //Le pedimos al modelo todos los items
        $listado = $categorias->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['items'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarCategorias.php", $data);
    }


    public function index()
    {
        //Incluye el modelo que corresponde
        require_once 'models/CategoriaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new CategoriaModel();

        //Le pedimos al modelo todos los items
        $listado = $items->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['items'] = $listado;

        //Finalmente presentamos nuestra plantilla
        $this->view->show("listarArticulos.php", $data);
    }

    // Método del controlador para crear un nuevo item
    public function nuevo()
    {
        require 'models/CategoriaModel.php';
        $item = new CategoriaModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if($_REQUEST['submit']=='Aceptar'){
                    if (!isset($_REQUEST['cat_nombre']) || empty($_REQUEST['cat_nombre']))
                        $errores['item'] = "* Rellena el nombre de la categoría: Error";
                    if (empty($errores)) {
                        $item->setCategoriaNombre($_REQUEST['cat_nombre']);
                        $item->save();

                        // Finalmente llama al método listar para que devuelva vista con listado
                        header("Location: index.php?controlador=Categoria&accion=listar");
                    }
            }else{
                header("Location: index.php?controlador=Categoria&accion=listar");
            };

        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("nuevoCategoria.php", array('item' => $item, 'errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar()
    {

        require 'models/CategoriaModel.php';
        $items = new CategoriaModel();

        // Recuperar el item con el código recibido
        $item = $items->getById($_REQUEST['codigo']);

        if ($item == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {
            if($_REQUEST['submit']=='Aceptar'){
                if (!isset($_REQUEST['codigo']) || empty($_REQUEST['codigo']))
                    $errores['item'] = "* codigo: Error";

                if (empty($errores)) {
                    // Cambia el valor del item y lo guarda en BD
                    $item->setCategoriaNombre($_REQUEST['cat_nombre']);
                    $item->save();

                    // Reenvía a la aplicación a la lista de items
                    header("Location: index.php?controlador=Categoria&accion=listar");
                }
            }else{
                header("Location: index.php?controlador=Categoria&accion=listar");
            };
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("editarCategoria.php", array('item' => $item, 'errores' => $errores));
    }

    // Método para borrar un item 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/CategoriaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new CategoriaModel();

        // Recupera el item con el código recibido por GET o por POST
        $item = $items->getById($_REQUEST['codigo']);

        if ($item == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $item->delete();
            header("Location: index.php?controlador=Categoria&accion=listar");
        }
    }

}
?>