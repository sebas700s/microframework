<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
</head>

<body>

	<h4 style="text-align: center;">Editar Articulo</h4>
	<form action="index.php">

		<input type="hidden" name="controlador" value="Articulos">
		<input type="hidden" name="accion" value="editar">
		<div class="row">
			<div class="col-md-2"><label for="codigo">Codigo</label>
				<input class="form-control" type="text" name="codigo" value="<?php echo $item->getArticulo(); ?>"
					disabled>
			</div>
			<div class="col-md-3"><label for="art_nombre">Descripción</label>
				<input class="form-control" type="text" name="art_nombre" maxlength="50"
					value="<?php echo $item->getArticuloNombre(); ?>">
			</div>
			<div class="col-md-3"><label for="Categoria">Categoria</label>
				<select class="form-control" name="Categoria">
					<?php
					$categorias = $item->getAllCategoria();
					foreach ($categorias as $categoria) {
						?>
						<option value="<?php echo $categoria->getCategoria(); ?>"><?php echo $categoria->getCategoriaNombre(); ?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2"><label for="art_cantidad">Cantidad</label>
				<input class="form-control" type="text" name="art_cantidad"
					value="<?php echo $item->getArticuloCantidad(); ?>">
			</div>

			<?php echo isset($errores["item"]) ? "*" : "" ?>
			<input type="hidden" name="codigo" value="<?php echo $item->getArticulo(); ?>">
			</br>

		</div>
		<input class="btn btn-dark" type="submit" name="submit" value="Aceptar">
		<input class="btn btn-dark" type="submit" name="submit" value="Cancelar">
	</form>
	</br>
	<?php
	if (isset($errores)):
		foreach ($errores as $key => $error):
			echo $error . "</br>";
		endforeach;
	endif;
	?>

</body>

</html>