<div id="MODALPRODUCTO" class="modal fade" aria-hidden="true" data-backdrop="static" data-keyboard="false">>
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">Eliminar elemento</h4>
			</div>
			<div class="venta-modal-tramite">			
				<p>Desea borrar el siguiente elemento: <input type="text" name="codigo_titulo" id="codigo_titulo"></p>
			</div>
			<button type="button" class="btn btn-dark"><a
                  href="index.php?controlador=Categoria&accion=borrar&codigo=<?php echo $item->getCategoria()?>">Aceptar</a></button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
		</div>
	</div>
</div>