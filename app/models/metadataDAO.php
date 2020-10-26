<?php  

	namespace App\Models;

	use \Core\Database as DB;


	/**
	*  Clase que controla la gestion con la DB para los documentos de cada categoria del modelo documental
	*/
	class MetadataDAO {

		public static function insert_documentos_categorias($obj) {
			try {
				$conn = DB::instance();
				$query = "INSERT INTO documentos_categorias(nombre_categoria) VALUES(?)";
				$res = $conn->prepare($query);
				$res->bindValue(1, $obj->get_nombre_categoria(), \PDO::PARAM_STR);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch(\PDOException $e) {
				return ['ok' => true, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
		public static function select_documentos_categorias() {
			try {
				$result = [];
				$conn = DB::instance();
				$query = "SELECT * FROM documentos_categorias";
				$res = $conn->prepare($query);
				$res->execute();
				$conn->close();
				if ($res->rowCount() > 0) {
					foreach ($res->fetchAll() as $row ) {
						$result[] = $row;
					}
					return $result;
				}
				return $result;
			} catch (\PDOException $e) {
				print($e-getMessage());
				return null;
			}
		}

		public static function delete_documentos_categorias($id_doc_cat) {
			try {
				$conn = DB::instance();
				$query = "DELETE FROM documentos_categorias WHERE id_doc_cat = ?";
				$res = $conn->prepare($query);
				$res->bindParam(1, $id_doc_cat, \PDO::PARAM_INT);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch (\PDOException $e) {
				return ['ok' => false, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
	}

?>