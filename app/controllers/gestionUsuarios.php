<?php  
	
	namespace App\Controller;

	use \Core\View;
	use \App\Models\gestionUsuariosDAO as gestionUsuariosDAO;
	use \App\Models\DTO\gestionUsuarios as gestionUsuariosDTO;



	/**
	*  Clase controladora que gestiona la administración de los documentos cargados en el sistema
	*/
	class gestionUsuarios {
		
		function index() {
			$metadata = gestionUsuariosDAO::select_user();
			View::set("list_user", $metadata);
			View::render("admin". DS . "gestionUsuarios");
		}

		/**
		 * Metodo que borra un documento de la DB y del servidor
		 * @return obj JSON con informacion de la transaccion
		 */
		function delete_documentos_metadata() {
			$id = htmlspecialchars($_POST['id_doc_meta']);
			$json = null;
			if (!empty($id)) {
				$res = gestionUsuariosDAO::delete_documentos_metadata($id);
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
			$json = null;
			if (!empty($name_meta)) {
				$data = new gestionUsuariosDTO($name_meta);
				$res = gestionUsuariosDAO::insert_documentos_metadata($data);
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
			$json = null;
			if (!empty($id) && !empty($nombre)) {
				$res = gestionUsuariosDAO::update_documentos_metadata($id,$nombre);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
		}
		
	}

?>