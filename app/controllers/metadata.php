<?php  
	
	namespace App\Controller;

	use \Core\View;
	use \App\Models\MetadataDAO as MetadataDAO;
	use \App\Models\DTO\Metadata as MetadataDTO;



	/**
	*  Clase controladora que gestiona la administración de los documentos cargados en el sistema
	*/
	class Metadata {
		
		function index() {
			$metadata = MetadataDTO::select_documentos_categorias();
			View::set("categorias", $metadata);
			View::render("admin". DS . "metadata");
		}

		
	}

?>