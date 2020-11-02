<?php  

	namespace App\Models;

	use \Core\Database as DB;

	class documentosMetadataDAO {

		public static function insert_documentos_metadata($obj) {
			try {
				$conn = DB::instance();
				$query = "INSERT INTO documentos_metadata(name_meta) VALUES(?)";
				$res = $conn->prepare($query);
				$res->bindValue(1, $obj->get_name_meta(), \PDO::PARAM_STR);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch(\PDOException $e) {
				return ['ok' => true, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
		public static function select_documentos_metadata() {
			try {
				$result = [];
				$conn = DB::instance();
				$query = "SELECT * FROM documentos_metadata";
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

		public static function update_documentos_categorias($id_doc_cat,$nombre_categoria) {
			try {
				$conn = DB::instance();
				$query = "UPDATE documentos_categorias SET nombre_categoria = ? WHERE id_doc_cat = ?";
				$res = $conn->prepare($query);
				$res->bindParam(1, $nombre_categoria,\PDO::PARAM_STR);
				$res->bindParam(2, $id_doc_cat, \PDO::PARAM_INT);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch (\PDOException $e) {
				return ['ok' => false, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
	}

?>