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
				$query = "SELECT * FROM categorias";
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
		public static function list_metadata_not_used($id_doc_meta) {
			try {
				$result = [];
				$conn = DB::instance();
				$query = "SELECT dm.id_doc_meta, dm.name_meta FROM documentos_metadata dm
				LEFT JOIN doc_cat_metadata dc ON (dc.`id_doc_meta`=dm.`id_doc_meta` AND dc.`id_doc_cat` = ?)
				WHERE dc.`id_doc_cat_meta` IS NULL";
				$res = $conn->prepare($query);
				$res->bindParam(1, $id_doc_meta, \PDO::PARAM_INT);
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
				return ['ok' => false, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
		public static function list_metadata_used_doct($id_doc_meta) {
			try {
				$result = [];
				$conn = DB::instance();
				$query = "SELECT ct.id,ct.nombre,dm.name_meta,dm.type FROM categorias ct
				INNER JOIN doc_cat_metadata dc ON (dc.`id_doc_cat`= ct.`id`)
				INNER JOIN documentos_metadata dm ON (dc.`id_doc_meta` = dm.`id_doc_meta`)
				WHERE   dc.`id_doc_cat` = ?";
				$res = $conn->prepare($query);
				$res->bindParam(1, $id_doc_meta, \PDO::PARAM_INT);
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
				return ['ok' => false, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}

		public static function add_metatada_of_categorie($id_cat,$name_metadata,$id_meta_type) {
			try {
				$conn = DB::instance();
				$insert = "INSERT INTO `documentos_metadata` SET name_meta='$name_metadata', `type`='$id_meta_type'";
				$result = $conn->execute($insert);
				$stmt = $conn->execute("SELECT LAST_INSERT_ID()");
				$id_doc_meta = $stmt->fetchColumn();
				$query = "INSERT INTO `doc_cat_metadata` SET `id_doc_cat` = '$id_cat', `id_doc_meta`='$id_doc_meta' ";
				$res = $conn->prepare($query);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch(\PDOException $e) {
				return ['ok' => true, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
		public static function delete_documentos_categorias_metadata($id_doc_cat_meta) {
			try {
				$conn = DB::instance();
				$query = "DELETE FROM documentos_metadata WHERE id_doc_cat_meta = ?";
				$res = $conn->prepare($query);
				$res->bindParam(1, $id_doc_cat_meta, \PDO::PARAM_INT);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch (\PDOException $e) {
				return ['ok' => false, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
	}

?>