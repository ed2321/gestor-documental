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
		 * Metodo que inserta un documento de la DB y del servidor
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
		/**
		 * Metodo que actualiza un documento de la DB y del servidor
		 * @return obj JSON con informacion de la transaccion
		 */
		function update_documentos_categorias() {
			$id = htmlspecialchars($_POST['id_doc_cat']);
			$nombre = htmlspecialchars($_POST['nombre_categoria']);
			$json;
			if (!empty($id) && !empty($nombre)) {
				$res = MetadataDAO::update_documentos_categorias($id,$nombre);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
		}

		/**
		 * Metodo que trae las lista de la metadata que hay en el sistema
		 * @return obj JSON con informacion de la transaccion
		 */
		function get_metatada_of_categorie() {
			$id = htmlspecialchars($_POST['id_doc_cat']);
			$json;
			if (!empty($id)) {
				$json = [
					// "data_select" => MetadataDAO::list_metadata_not_used($id),
					"data_asign" => MetadataDAO::list_metadata_used_doct($id)
				];
			} else {
				$json = [
					// "data_select" => [],
					"data_asign" => []
				];
			}
			print(json_encode($json));

		}
		/**
		 * Metodo que trae las lista de la metadata que hay en el sistema
		 * @return obj JSON con informacion de la transaccion
		 */
		function add_metatada_of_categorie() {
			$id_cat = htmlspecialchars($_POST['id_cat']);
			$name_metadata = htmlspecialchars($_POST['name_metadata']);
			$id_meta_type = htmlspecialchars($_POST['id_meta_type']);
			$json;
			if (!empty($id_cat) && !empty($name_metadata) && !empty($id_meta_type)) {
				$res = MetadataDAO::add_metatada_of_categorie($id_cat,$name_metadata,$id_meta_type);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
			
		}
		/**
		 * Metodo que borra un metadata de una categoria de documentos
		 * @return obj JSON con informacion de la transaccion
		 */
		function delete_documentos_categorias_metadata() {
			$id = htmlspecialchars($_POST['id_doc_cat_meta']);
			$json;
			if (!empty($id)) {
				$res = MetadataDAO::delete_documentos_categorias_metadata($id);
				$json = $res;
				
			} else {
				$json = ['ok' => false, 'error' => 'Faltan datos'];
			}
			print(json_encode($json));
		}
		
	}

?>