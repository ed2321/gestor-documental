<?php include VIEWSPATH . DS .'admin'. DS .'includes'. DS .'section-top.php'; ?>
<section class="content-header no-index">
    <div class="info-box p-rel">
    	<span class="info-box-icon"><i class="fa fa-book"></i></span>
    	<div class="info-box-content">
          	<h2 class="info-box-text"><b>Control de Usuarios</b></h2>
          	<span class="info-box-number">A continuación podra consultar el listado de los Usuarios cargados en el sistema</span>
        </div>
    </div>
</section>
<section class="content">
	<!-- Your Page Content Here -->
	<div class="box box-danger">
		<div class="box-header with-border text-center">
			<h3 class="box-title"><b>Listado de Usuarios</b></h3>
			<button class="btn btn-danger btn-fixed" data-toggle="modal" data-target="#myModalDocCategori"><i class="fa fa-plus"></i></button>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<table id="list_doc_cat" class="display table table-bordered table-striped dataTable" cellspacing="0" width="100%">
		                <thead>
		                	<tr>
			                  <th>nombre</th>
			                  <th>email</th>
			                  <th>id_rol</th>
			                  <th style="width: 90px">Update</th>
			                  <th style="width: 100px">Delete</th>
		                	</tr>
		               	</thead>
						<?php 
		                if (!empty($list_user)) {
		                	foreach ($list_user as $user) {
		                		print('<tr>
				                  <td>'.$user['nombre'].'</td>
				                  <td>'.$user['email'].'</td>
				                  <td>'.$user['rol_nombre'].'</td>
				                  <td style="text-align: center;">
				                  	<button data-id="'.$user['id'].'" data-name="'.$user['nombre'].'" data-email="'.$user['email'].'" data-id_rol="'.$user['id_rol'].'" class="btn btn-danger btn-sm btn-update-doc-meta"><i class="fa fa-pencil"></i></button>
				                  </td>
				                  <td style="text-align: center;">
				                  	<button data-id="'.$user['id'].'" data-name="'.$user['nombre'].'" data-email="'.$user['email'].'" data-id_rol="'.$user['id_rol'].'" class="btn btn-danger btn-sm btn-delete-doc-meta"><i class="fa fa-trash"></i></button>
				                  </td>
				                </tr>');
				            }
			            }?>
		              </tbody>
		            </table>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal Crear categorias archivos -->
<div class="modal fade modal-danger" id="myModalDocCategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Formulario para el registro de documentos de metadata</h4>
	      </div>
			<div class="modal-body">
				<div class="form-group">
					<label for="titulo">Nombre de la Metadata</label>
					<input type="text" class="form-control" name="title_doc" id="nombre" placeholder="Nombre de Metadata">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="btn-load-doc-meta">Save</button>
			</div>
	    </div>
	  </div>
</div>

<?php include VIEWSPATH . DS .'admin'. DS .'includes'. DS .'section-footer.php'; ?>