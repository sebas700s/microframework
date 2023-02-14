<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
</head>

<body>

	<h4 style="text-align: center;">Nueva Categoria</h4>
	<form action="index.php">
		<br>
		<input type="hidden" name="controlador" value="Categoria">
		<input type="hidden" name="accion" value="nuevo">
		<div class="row">
			<div class="col-md-3"><label for="">Nombre</label>
				<input class="form-control" type="text" name="cat_nombre" maxlength="50">
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