<?php  
	
	namespace App\Controller;

	use \Core\View;
	use \App\Models\DocumentoDAO as DocDAO;
	use \App\Models\CategoriaDAO as CatDAO;
	use \App\Models\Gestion_DocumentoDAO as GDDAO;
	use \App\Models\Sub_CategoriaDAO as SubCatDAO;
	use \App\Models\DTO\Categoria as CatDTO;
	use \App\Models\DTO\Sub_categorias2 as SubCatDTO2;
	use \App\Models\DTO\Sub_categorias as SubCatDTO;
	use \App\Models\Sub_CategoriaDAO2 as SubCatDAO2;


	/**
	*  Clase controladora que gestiona la administración de los documentos cargados en el sistema
	*/
	class Metadata {
		
		function index() {
			View::render("admin". DS . "metadata");
		}

		
	}

?>