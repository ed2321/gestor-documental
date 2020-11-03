<?php  

	namespace App\Models;

	use \Core\Database as DB;

	class gestionUsuariosDAO {

		public static function insert_user($obj) {
			try {
				$conn = DB::instance();
				$query = "INSERT INTO administradores(name_meta) VALUES(?)";
				$res = $conn->prepare($query);
				$res->bindValue(1, $obj->get_name_meta(), \PDO::PARAM_STR);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch(\PDOException $e) {
				return ['ok' => true, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
		public static function select_user() {
			try {
				$result = [];
				$conn = DB::instance();
				$query = "SELECT * FROM administradores a 
				INNER JOIN roles r ON a.`id_rol` = r.`id_rol`";
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
				print($e->getMessage());
				return null;
			}
		}

		public static function delete_user($id_doc_meta) {
			try {
				$conn = DB::instance();
				$query = "DELETE FROM administradores WHERE id_doc_meta = ?";
				$res = $conn->prepare($query);
				$res->bindParam(1, $id_doc_meta, \PDO::PARAM_INT);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch (\PDOException $e) {
				return ['ok' => false, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}

		public static function update_user($id_doc_meta,$name_meta) {
			try {
				$conn = DB::instance();
				$query = "UPDATE administradores SET name_meta = ? WHERE id_doc_meta = ?";
				$res = $conn->prepare($query);
				$res->bindParam(1, $name_meta,\PDO::PARAM_STR);
				$res->bindParam(2, $id_doc_meta, \PDO::PARAM_INT);
				$res->execute();
				$conn->close();
				return ['ok' => true];
			} catch (\PDOException $e) {
				return ['ok' => false, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
	}

?>