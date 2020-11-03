<?php include VIEWSPATH . DS . 'admin' . DS . 'includes' . DS . 'section-top.php'; ?>
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
			<h3 class="box-title"><b>Listado de categorias de documentos</b></h3>
			<button class="btn btn-danger btn-fixed" data-toggle="modal" data-target="#myModalDocCategori"><i class="fa fa-plus"></i></button>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<table id="list_doc_cat" class="display table table-bordered table-striped dataTable" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Categoria</th>
								<th style="width: 90px">add meta</th>
								<th style="width: 90px">Update</th>
								<th style="width: 100px">Delete</th>
							</tr>
						</thead>
						<?php
						if (!empty($list_doc_cat)) {
							foreach ($list_doc_cat as $doc_cat) {
								print('<tr>
				                  <td>' . $doc_cat['nombre_categoria'] . '</td>
				                  <td style="text-align: center;">
				                  	<button data-id="' . $doc_cat['id_doc_cat'] . '" class="btn btn-danger btn-sm btn-add-doc-cat"><i class="fa fa-plus"></i></button>
				                  </td>
				                  <td style="text-align: center;">
				                  	<button data-id="' . $doc_cat['id_doc_cat'] . '" data-name="' . $doc_cat['nombre_categoria'] . '" class="btn btn-danger btn-sm btn-update-doc-cat"><i class="fa fa-pencil"></i></button>
				                  </td>
				                  <td style="text-align: center;">
				                  	<button data-id="' . $doc_cat['id_doc_cat'] . '" data-name="' . $doc_cat['nombre_categoria'] . '" class="btn btn-danger btn-sm btn-delete-doc-cat"><i class="fa fa-trash"></i></button>
				                  </td>
				                </tr>');
							}
						} ?>
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
				<h4 class="modal-title" id="myModalLabel">Formulario para el registro de cagorias de documentos</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="titulo">Titulo de la categoria</label>
					<input type="text" class="form-control" name="title_doc" id="nombre_categoria" placeholder="Nombre de categoria">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="btn-load-cat">Save Categoria</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-danger" id="add_metadata_doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Formulario para el registro de metadata a categorias de documentos</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">add category</label>
						<div class="col-sm-9">
							<select class="form-control" id="id_doc_meta">
								<!-- <option selected>Elegir...</option> -->
								<?php
								if (!empty($data_doc_metada)) {
									foreach ($data_doc_metada['data_select'] as $doc_meta) {
										print('<option value="' . $doc_meta['id_doc_meta'] . '" >' . $doc_meta['name_meta'] . '</option>');
									}
								} ?>
							</select>
						</div>
					</div>
				</div>
				<table id="list_doc_metadata_asing" class="display table table-bordered " cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Metadata</th>
							<th style="width: 90px">delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// if (!empty($data_doc_metada)) {
						// 	foreach ($data_doc_metada['data_asign'] as $doc_meta) {
						// 		print('<tr>
				        //           <td>' . $doc_cat['name_meta'] . '</td>
				        //           <td style="text-align: center;">
				        //           	<button data-id_doc_cat_meta="' . $doc_cat['id_doc_cat_meta'] . '"  class="btn btn-danger btn-sm btn-delete-doc-cat_metadata"><i class="fa fa-trash"></i></button>
				        //           </td>
				        //         </tr>');
						// 	}
						// } 
						?>

					</tbody>
				</table>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn_add_doc_cat_meta">add metadata</button>
			</div>
		</div>
	</div>
</div>

<?php include VIEWSPATH . DS . 'admin' . DS . 'includes' . DS . 'section-footer.php'; ?>