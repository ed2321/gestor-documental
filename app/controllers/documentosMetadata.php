<?php  
	
	namespace App\Controller;

	use \Core\View;
	use \App\Models\documentosMetadataDAO as documentosMetadataDAO;
	use \App\Models\DTO\documentosMetadata as documentosMetadataDTO;



	/**
	*  Clase controladora que gestiona la administración de los documentos cargados en el sistema
	*/
	class documentosMetadata {
		
		function index() {
			$metadata = documentosMetadataDAO::select_documentos_metadata();
			View::set("list_documentos_metadata", $metadata);
			View::render("admin". DS . "documentosMetadata");
		}

		/**
		 * Metodo que borra un documento de la DB y del servidor
		 * @return obj JSON con informacion de la transaccion
		 */
		function delete_documentos_metadata() {
			$id = htmlspecialchars($_POST['id_doc_meta']);
			$json;
			if (!empty($id)) {
				$res = documentosMetadataDAO::delete_documentos_metadata($id);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
		}
		/**
		 * Metodo que inserta un documento de la DB y del servidor
		 * @return obj JSON con informacion de la transaccion
		 */
		function insert_documentos_metadata() {
			$name_meta = htmlspecialchars($_POST['name_meta']);
			$json;
			if (!empty($name_meta)) {
				$data = new documentosMetadataDTO($name_meta);
				$res = documentosMetadataDAO::insert_documentos_metadata($data);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
		}
		/**
		 * Metodo que actualiza un documento de la DB y del servidor
		 * @return obj JSON con informacion de la transaccion
		 */
		function update_documentos_metadata() {
			$id = htmlspecialchars($_POST['id_doc_meta']);
			$nombre = htmlspecialchars($_POST['name_meta']);
			$json;
			if (!empty($id) && !empty($nombre)) {
				$res = documentosMetadataDAO::update_documentos_metadata($id,$nombre);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
		}
		
	}

?>