<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class ArticulosController
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
        require 'models/ArticulosModel.php';

        //Creamos una instancia de nuestro "modelo"
        $articulos = new ArticulosModel();

        //Le pedimos al modelo todos los items
        $listado = $articulos->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['items'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarArticulos.php", $data);
    }


    public function index()
    {
        //Incluye el modelo que corresponde
        require_once 'models/ArticulosModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new ArticulosModel();

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
        require 'models/ArticulosModel.php';
        require 'models/CategoriaModel.php';
        $item = new ArticulosModel();
        $categorias = new CategoriaModel();
        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if($_REQUEST['submit']=='Aceptar'){
                if (!isset($_REQUEST['art_nombre']) || empty($_REQUEST['art_nombre']))
                $errores['item'] = "* Descripción: Error";
                if (!isset($_REQUEST['art_cantidad']) || empty($_REQUEST['art_cantidad']))
                    $errores['item'] = "* Cantidad: Error";

                if (empty($errores)) {
                    $item->setArticuloNombre($_REQUEST['art_nombre']);
                    $item->setCategoria($_REQUEST['Categoria']);
                    $item->setArticuloCantidad($_REQUEST['art_cantidad']);
                    $item->save();

                    // Finalmente llama al método listar para que devuelva vista con listado
                    header("Location: index.php?controlador=Articulos&accion=listar");
                }
            }else{
                header("Location: index.php?controlador=Articulos&accion=listar");
            };
           
        }
        $listado = $categorias->getAll();
        $data['data'] = $listado;
        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("nuevoArticulo.php",array('datas' => $listado,'item' => $item, 'errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar()
    {
        require 'models/CategoriaModel.php';
        require 'models/ArticulosModel.php';
        $items = new ArticulosModel();
        $categorias = new CategoriaModel();

        // Recuperar el item con el código recibido
        $item = $items->getById($_REQUEST['codigo']);

        if ($item == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {
            if($_REQUEST['submit']=='Aceptar'){
                    if (!isset($_REQUEST['art_nombre']) || empty($_REQUEST['art_nombre']))
                        $errores['item'] = "* Descripción: Error";
                    if (!isset($_REQUEST['art_cantidad']) || empty($_REQUEST['art_cantidad']))
                    $errores['item'] = "* Cantidad: Error";

                    if (empty($errores)) {
                        // Cambia el valor del item y lo guarda en BD
                        $item->setArticuloNombre($_REQUEST['art_nombre']);
                        $item->setCategoria($_REQUEST['Categoria']);
                        $item->setArticuloCantidad($_REQUEST['art_cantidad']);
                        $item->save();

                        // Reenvía a la aplicación a la lista de items
                        header("Location: index.php?controlador=Articulos&accion=listar");
                    }
            }else{
                header("Location: index.php?controlador=Articulos&accion=listar");
            };
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("editarArticulo.php", array('item' => $item, 'errores' => $errores));



    }

    // Método para borrar un item 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/ArticulosModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new ArticulosModel();

        // Recupera el item con el código recibido por GET o por POST
        $item = $items->getById($_REQUEST['codigo']);

        if ($item == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $item->delete();
            header("Location: index.php");
        }
    }

}
?>