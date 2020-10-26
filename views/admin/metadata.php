<?php include VIEWSPATH . DS .'admin'. DS .'includes'. DS .'section-top.php'; ?>
<section class="content-header no-index">
    <div class="info-box p-rel">
    	<span class="info-box-icon"><i class="fa fa-book"></i></span>
    	<div class="info-box-content">
          	<h2 class="info-box-text"><b>Control de Documentosttttttttttt</b></h2>
          	<span class="info-box-number">A continuación podra consultar el listado de los documentos cargados en el sistema</span>
        </div>
    </div>
</section>
<section class="content">
	<!-- Your Page Content Here -->
	<div class="box box-danger">
		<div class="box-header with-border text-center">
			<h3 class="box-title"><b>Listado de documentos</b></h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<table id="list_doc_cat" class="display table table-bordered table-striped dataTable" cellspacing="0" width="100%">
		                <thead>
		                	<tr>
			                  <th>Nombre Categoria Documento</th>
			                  <th style="width: 90px">Update</th>
			                  <th style="width: 100px">Delete</th>
		                	</tr>
		               	</thead>
		                <?php 
		                if (!empty($list_doc_cat)) {
		                	foreach ($list_doc_cat as $doc_cat) {
		                		print('<tr>
				                  <td>'.$doc->nombre_categoria.'</td>
				                  <td style="text-align: center;">
				                  	<button data-id="'.$doc_cat->id_doc_cat.'" data-name="'.$doc->nombre_categoria.'" class="btn btn-danger btn-sm btn-delete-doc"><i class="fa fa-trash"></i></button>
				                  </td>
				                  <td style="text-align: center;">
				                  	<button data-id="'.$doc_cat->id_doc_cat.'" data-name="'.$doc->nombre_categoria.'" class="btn btn-danger btn-sm btn-delete-doc"><i class="fa fa-trash"></i></button>
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

<?php include VIEWSPATH . DS .'admin'. DS .'includes'. DS .'section-footer.php'; ?>