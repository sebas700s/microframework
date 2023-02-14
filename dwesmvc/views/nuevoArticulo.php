<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
</head>

<body>

	<h4 style="text-align: center;">Nuevo Articulo</h4>
	<form action="index.php">
		<br>

		<input type="hidden" name="controlador" value="Articulos">
		<input type="hidden" name="accion" value="nuevo">
		<div class="row">
			<div class="col-md-4"><label>Descripción</label>
				<input class="form-control" type="text" name="art_nombre">
			</div>
			<div class="col-md-2"><label>Categoria</label>
				<select class="form-control" name="Categoria">
					<?php
					foreach ($datas as $data) {
							?>
						<option value="<?php echo $data->getCategoria(); ?>"><?php echo $data->getCategoriaNombre(); ?>
						</option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2"><label>Cantidad</label>
				<input class="form-control" type="number" name="art_cantidad">
			</div>
		</div>


		</br>
		</br>
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