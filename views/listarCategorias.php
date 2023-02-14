<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
    <style>
        a{text-decoration: none;color:white}
    </style>
</head>

<body>
<h1>Listado de Categorias</h1>
<div class="col-8">  
    <table class="table table-dark table-striped">
        <tr>
            <th>COD CATEGORIA</th>
            <th>NOMBRE</th>
            <th>ACCIONES</th>
        </tr>
        <?php
        foreach ($items as $item) {
        ?>
        <tr>
            <td><?php echo $item->getCategoria() ?></td>
            <td><?php echo $item->getCategoriaNombre() ?></td>
            <td><button type="button" class="btn btn-dark"><a href="index.php?controlador=Categoria&accion=editar&codigo=<?php echo $item->getCategoria() ?>">Editar</a></button>

            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#MODALPRODUCTO"
                    data-codigo_titulo="<?php echo $item->getCategoriaNombre(); ?>">Borrar
            </button>

        </tr>
        <?php
        }
        ?>
    </table>
    <button type="button" class="btn btn-dark"><a href="index.php?controlador=Categoria&accion=nuevo">Nueva Categoria</a></button>
    <button type="button" class="btn btn-dark"><a href="index.php?controlador=Articulos&accion=listar">Ver Articulos</a></button>
</div>

<?php include("modalCategoriaConfirmar.php"); ?>

  <script>
      $('#MODALPRODUCTO').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget)
          var codigo_titulo = button.data('codigo_titulo')
          $('#codigo_titulo').val(codigo_titulo)
      })
  </script>
</body>

</html>