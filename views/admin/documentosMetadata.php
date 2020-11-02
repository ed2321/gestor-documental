<?php include VIEWSPATH . DS .'admin'. DS .'includes'. DS .'section-top.php'; ?>
<section class="content-header no-index">
    <div class="info-box p-rel">
    	<span class="info-box-icon"><i class="fa fa-book"></i></span>
    	<div class="info-box-content">
          	<h2 class="info-box-text"><b>Control de Categorias de Documentos</b></h2>
          	<span class="info-box-number">A continuación podra consultar el listado de las categorias de documentos cargados en el sistema</span>
        </div>
    </div>
</section>
<section class="content">
	<!-- Your Page Content Here -->
	<div class="box box-danger">
		<div class="box-header with-border text-center">
			<h3 class="box-title"><b>Listado de documentos de metadata</b></h3>
			<button class="btn btn-danger btn-fixed" data-toggle="modal" data-target="#myModalDocCategori"><i class="fa fa-plus"></i></button>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<table id="list_doc_cat" class="display table table-bordered table-striped dataTable" cellspacing="0" width="100%">
		                <thead>
		                	<tr>
			                  <th>Categoria</th>
			                  <th style="width: 90px">Update</th>
			                  <th style="width: 100px">Delete</th>
		                	</tr>
		               	</thead>
						<?php 
		                if (!empty($list_documentos_metadata)) {
		                	foreach ($list_documentos_metadata as $met_data) {
		                		print('<tr>
				                  <td>'.$met_data['name_meta'].'</td>
				                  <td style="text-align: center;">
				                  	<button data-id="'.$met_data['id_doc_meta'].'" data-name="'.$met_data['name_meta'].'" class="btn btn-danger btn-sm btn-update-doc-cat"><i class="fa fa-pencil"></i></button>
				                  </td>
				                  <td style="text-align: center;">
				                  	<button data-id="'.$met_data['id_doc_meta'].'" data-name="'.$met_data['name_meta'].'" class="btn btn-danger btn-sm btn-delete-doc-cat"><i class="fa fa-trash"></i></button>
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
					<input type="text" class="form-control" name="title_doc" id="name_meta" placeholder="Nombre de Metadata">
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