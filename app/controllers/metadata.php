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
			$metadata = MetadataDAO::select_documentos_categorias();
			View::set("list_doc_cat", $metadata);
			View::render("admin". DS . "metadata");
		}

		/**
		 * Metodo que borra un documento de la DB y del servidor
		 * @return obj JSON con informacion de la transaccion
		 */
		function delete_documentos_categorias() {
			$id = htmlspecialchars($_POST['id_doc_cat']);
			$json;
			if (!empty($id)) {
				$res = MetadataDAO::delete_documentos_categorias($id);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
		}
		/**
		 * Metodo que borra un documento de la DB y del servidor
		 * @return obj JSON con informacion de la transaccion
		 */
		function insert_documentos_categorias() {
			$nombre_categoria = htmlspecialchars($_POST['nombre_categoria']);
			$json;
			if (!empty($nombre_categoria)) {
				$data = new MetadataDTO($nombre_categoria);
				$res = MetadataDAO::insert_documentos_categorias($data);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
		}
		
	}

?>