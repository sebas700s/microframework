<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>MVC - Modelo, Vista, Controlador - Jourmoly</title>

  <style>
    a {
      text-decoration: none;
      color: white
    }
  </style>
</head>


<body>
  <h1 style="text-align: center">Listado de Articulos</h1><br>
  <div class="col-8">
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>COD ARTICULO</th>
          <th>COD CATEGORIA</th>
          <th>NOMBRE</th>
          <th>CANTIDAD</th>
          <th>ACCIONES</th>
        </tr>
      </thead>
      <?php
      foreach ($items as $item) {
        ?>
        <tbody>
          <tr>
            <td>
              <?php echo $item->getArticulo() ?>
            </td>
            <td>
              <?php echo $item->getCategoria() ?>
            </td>
            <td>
              <?php echo $item->getArticuloNombre() ?>
            </td>
            <td>
              <?php echo $item->getArticuloCantidad() ?>
            </td>
            <td><button type="button" class="btn btn-dark"><a
                  href="index.php?controlador=Articulos&accion=editar&codigo=<?php echo $item->getArticulo() ?>">Editar</a></button>
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#MODALPRODUCTO"
                    data-codigo_titulo="<?php echo $item->getArticuloNombre(); ?>">Borrar
                  </button>
            </td>

          </tr>
          <?php
      }
      ?>
      </tbody>
    </table>
    <button type="button" class="btn btn-dark"><a href="index.php?controlador=Articulos&accion=nuevo">Nuevo
        Articulo</a><br></button>
    <button type="button" class="btn btn-dark"><a href="index.php?controlador=Categoria&accion=listar">Ver
        Categorias</a></button>
  </div>

  <?php include("modalArticuloConfirmar.php"); ?>

  <script>
      $('#MODALPRODUCTO').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget)
          var codigo_titulo = button.data('codigo_titulo')
          $('#codigo_titulo').val(codigo_titulo)
      })
  </script>
  
</body>

</html>