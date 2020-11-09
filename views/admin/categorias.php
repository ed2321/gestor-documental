<?php include VIEWSPATH . DS .'admin'. DS .'includes'. DS .'section-top.php'; ?>

<section class="content-header no-index">
    <div class="info-box p-rel">
    	<span class="info-box-icon"><i class="fa fa-book"></i></span>
    	<div class="info-box-content">
          	<h2 class="info-box-text"><b>Panel de Administracion de Categorias</b></h2>
          	<span class="info-box-number">A continuación podra gestionar las categorias existentes</span>
        </div>
    </div>
</section>
<section class="content">
	<!-- Your Page Content Here -->
   <div class="col-md-4">
   	<div class="box box-danger">
   		<div class="box-header with-border text-center">
   			<h3 class="box-title"><b>Listado de Categorias</b></h3>
			<button  class="btn btn-danger center-block" data-toggle="modal" data-target="#modal-categorias-super"><i class="fa fa-plus"></i></button>
   		</div>
   		<div class="box-body">
   			<table class="table table-bordered">
   				<thead>
   					<tr>
						   <th>Categoria</th>
						   <th width="50">Delete</th>
						   <th width="50">Update</th>
   					</tr>
   				</thead>
   				<tbody id="tbl-cat">
   					<?php
   						if (!empty($categorias)) {
   							foreach ($categorias as $c) {
									print('
										<tr style="cursor:pointer" data-id="'.$c->getId().'" class="row-cat">
											<td colspan="2" >'.$c->getNombre().'</td>
											<td style="text-align: center;">
				                  			<button data-id_cat="'.$c->getId().'" class="btn btn-danger btn-sm btn-delete-cat"><i class="fa fa-trash"></i></button>
				                  			</td>
											<td style="text-align: center;">
											<button  data-id_cat="'.$c->getId().'" class="btn btn-danger center-block" id="modal-categorias-super-b"><i class="fa fa-pencil"></i></button>
											</td>
										</tr>');
   							}
   						}
   					?>
   				</tbody>
   			</table>
         </div>
   	</div>
   </div>
   <div class="col-md-4">
   	<div class="box box-danger">
   		<div class="box-header with-border text-center">
   			<h3 class="box-title"><b>Categorias listadas</b></h3>
			<button class="btn btn-danger btn_modal_categorias" data-toggle="modal" data-target="#modal-categorias" data-categoria="0" id="btn-subcat" style="visibility:hidden"><i class="fa fa-plus"></i></button>
   		</div>
   		<div class="box-body">
   			<table class="table table-bordered">
   				<thead>
   					<tr>
   						<th>Categoria</th>
   						<th width="50"></th>
   						<th width="50"></th>
   					</tr>
   				</thead>
   				<tbody id="tbl-subcat">
                  <tr>
                     <td>No hay categorias seleccionadas</td>
                     <td></td>
                  </tr>
   				</tbody>
   			</table>
         </div>
   	</div>
   </div>
   <div class="col-md-4">
   	<div class="box box-danger">
   		<div class="box-header with-border text-center">
   			<h3 class="box-title"><b>Subcategorias listadas</b></h3>
			<button class="btn btn-danger" data-toggle="modal" data-target="#modal-subcategorias" data-categoria="0" data-supercat="0" id="btn-subcat2" style="visibility:hidden"><i class="fa fa-plus"></i></button>
   		</div>
   		<div class="box-body">
   			<table class="table table-bordered">
   				<thead>
   					<tr>
   						<th>Subcategorias</th>
   						<th width="50"></th>
   					</tr>
   				</thead>
   				<tbody id="tbl-subcat2">
                  <tr>
                     <td>No hay subcategorias seleccionadas</td>
                     <td></td>
                  </tr>
   				</tbody>
   			</table>
         </div>
   	</div>
   </div>
   <div class="clearfix"></div>
</section>
<!-- Modal registrar categorias -->
<div class="modal fade modal-danger" id="modal-categorias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formulario de registro de categorias</h4>
      </div>
       	<form method="post" enctype="multipart/form-data" id="form-save-subcat">
	       	<input type="hidden" name="id_cat" value="">
      		<div class="modal-body">
  				<div class="form-group">
                  	<label for="titulo">Nueva subcategoria</label>
                  	<select name="id_categoria" id="categoria-id" class="form-control">
                  		<?php
                  			foreach ($categorias as $val) {
                  				print('<option value="'.$val->getId().'">'.$val->getNombre().'</option>');
                  			}
                  		?>
                  	</select>
                </div>
  				<div class="form-group">
                  	<label for="titulo">Nueva subcategoria</label>
                  	<input type="text" class="form-control" name="sub_categoria" placeholder="Subcategoria" id="sub_categoria">
				</div>
				<input type="hidden" name="MAX_FILE_SIZE" VALUE="2000000">
				<div class="form-group">
					<input class="btn btn-danger" type="file" id="image_secondary" name="archivo">
				</div>      
				<div class="form-group">
					<label>Contenido</label>
					<textarea class="form-control" rows="6" id="cont-category-secondary" name="texto" placeholder="Ingrese el contenido." required="true"></textarea>
				</div>
      		</div>
      		<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        	<button type="button" class="btn btn-primary" id="btn-subcategoria-save">Guardar</button>
	      	</div>
  		</form>
    </div>
  </div>
</div>
<!-- Modal registrar subcategorias -->
<div class="modal fade modal-danger" id="modal-subcategorias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registro de subcategorias</h4>
      </div>
       	<form method="post" enctype="multipart/form-data" id="form-save-subcat2">
	       	<input type="hidden" name="id_cat" value="">
      		<div class="modal-body">
     				<div class="form-group">
               	<label for="titulo">Super Categoria</label>
               	<select name="id_categoria" id="supercategoria-id" class="form-control">
               		<?php
               			foreach ($categorias as $val) {
               				print('<option value="'.$val->getId().'">'.$val->getNombre().'</option>');
               			}
               		?>
               	</select>
               </div>
     				<div class="form-group">
               	<label for="titulo">categoria</label>
                  <select name="id_subcategoria" id="subcategoria-id" class="form-control">

               	</select>
               </div>
               <div class="form-group">
               	<label for="titulo">subcategoria</label>
                  <input type="text" class="form-control" name="subcategoria" placeholder="Subcategoria">
			   </div>
			   <input type="hidden" name="MAX_FILE_SIZE" VALUE="2000000">
				<div class="form-group">
					<input class="btn btn-danger" type="file" id="image_tercer" name="archivo">
				</div>      
				<div class="form-group">
					<label>Contenido</label>
					<textarea class="form-control" rows="6" id="cont-category-tercer" name="texto" placeholder="Ingrese el contenido." required="true"></textarea>
				</div>
      		</div>
      		<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        	<button type="button" class="btn btn-primary" id="btn-subcategoria-save2">Guardar</button>
	      	</div>
  		</form>
    </div>
  </div>
</div>
<div class="modal fade modal-danger" id="modal-categorias-super" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formulario de registro de categorias</h4>
      </div>
       	<form method="post" enctype="multipart/form-data" id="form-save-categoria-principal">
      		<div class="modal-body">
  				<div class="form-group">
                  	<label for="titulo">Nueva categoria</label>
                  	<input type="text" class="form-control" id="categoria-principal" name="categoria-principal" placeholder="Categoria">
                </div>
				<input type="hidden" name="MAX_FILE_SIZE" VALUE="2000000">
				<div class="form-group">
					<input class="btn btn-danger" type="file" id="image_principal" name="archivo">
				</div>      
				<div class="form-group">
					<label>Contenido</label>
					<textarea class="form-control" rows="6" id="cont-category-principal" name="texto" placeholder="Ingrese el contenido." required="true"></textarea>
				</div>
				<div class="">
					<button type="button" class="btn btn-info" id="btn-category-principal"><i class="fa fa-refresh"></i> Cargar Información</button>
				</div>
      		</div>
      		<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        	<!-- <button type="button" class="btn btn-primary" id="btn-subcategoria-save">Guardar</button> -->
	      	</div>
  		</form>
    </div>
  </div>
</div>

<?php include VIEWSPATH . DS .'admin'. DS .'includes'. DS .'section-footer.php'; ?>
