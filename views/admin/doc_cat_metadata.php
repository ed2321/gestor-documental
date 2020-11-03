<div class="modal fade modal-info" id="add_metadata_doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Formulario para el registro de cagorias de documentos</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <select class="custom-select" id="id_doc_meta" aria-label="Example select with button addon">
                        <!-- <option selected>Elegir...</option> -->
                        <?php 
		                if (!empty($data_doc_metada)) {
		                	foreach ($data_doc_metada['data_select'] as $doc_meta) {
		                		print('<option value="'.$doc_meta['id_doc_meta'].'" >'.$doc_meta['name_meta'].'</option>');
				            }
			            }?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="add_doc_metadata" type="button">Button</button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>