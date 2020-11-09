<?php  

	namespace App\Models;

	use \Core\Database as DB;


	/**
	*  Clase que controla la gestion a la DB de las categorias de los distintos modelos
	*/
	class CategoriaDAO {
		

		/**
		 *  Metodo que obtiene todas las categorias registradas en la DB
		 * @return array con las categorias
		 */
		public static function select() {
			try {

				$conn = DB::instance();
				$query = "SELECT c.id as id_cat_prin, c.nombre as nom_cat_prin,ifnull(co.`texto`,'') 'descripcion',ifnull(co.`imagen`,'') 'imagen' FROM categorias c 
				LEFT JOIN contenido co on (co.`id`=c.`id` and co.`tipo_cat`=1)";
				$res = $conn->prepare($query);
				$res->execute();
				$rows = $res->rowCount();
				$conn->close();
				if ($rows > 0) {
					return $res->fetchAll();					
				}
				return null;

			} catch (\PDOException $e) {
				return null;
			}
		}


		public static function inser_cat($cat_name,$name, $text, $user,$type) {
			try {
				$conn = DB::instance();
				$insert = "INSERT INTO `categorias` SET nombre='$cat_name' ";
				$result = $conn->execute($insert);
				$stmt = $conn->execute("SELECT LAST_INSERT_ID()");
				$id_cat = $stmt->fetchColumn();
				$query = "INSERT INTO `contenido` SET `id` = '$id_cat',`imagen`='$name', `texto`='$text', `id_admin`='$user', `tipo_cat`='$type' ";
				$result = $conn->execute($query);
				$conn->close();
				return ['ok' => true];
			} catch(\PDOException $e) {
				return ['ok' => true, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
		public static function inser_subcat($cat_name,$name, $text, $user,$id_catate,$type) {
			try {
				$conn = DB::instance();
				$insert = "INSERT INTO `sub_categoria` SET nombre='$cat_name', id_categoria='$id_catate' ";
				$result = $conn->execute($insert);
				$stmt = $conn->execute("SELECT LAST_INSERT_ID()");
				$id_cat = $stmt->fetchColumn();
				$query = "INSERT INTO `contenido` SET `id` = '$id_cat',`imagen`='$name', `texto`='$text', `id_admin`='$user', `tipo_cat`='$type' ";
				$result = $conn->execute($query);
				$conn->close();
				return ['ok' => true];
			} catch(\PDOException $e) {
				return ['ok' => true, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}
		public static function inser_sub_subcat($cat_name,$name, $text, $user,$id_catate,$type) {
			try {
				$conn = DB::instance();
				$insert = "INSERT INTO `sub_categoria2` SET nombre='$cat_name', id_subcategoria='$id_catate' ";
				$result = $conn->execute($insert);
				$stmt = $conn->execute("SELECT LAST_INSERT_ID()");
				$id_cat = $stmt->fetchColumn();
				$query = "INSERT INTO `contenido` SET `id` = '$id_cat',`imagen`='$name', `texto`='$text', `id_admin`='$user', `tipo_cat`='$type' ";
				$result = $conn->execute($query);
				$conn->close();
				return ['ok' => true];
			} catch(\PDOException $e) {
				return ['ok' => true, 'error' => 'Error:! ' . $e->getMessage()];
			}
		}

		/**
		 *  Metodo que obtiene todas las categorias registradas en la DB
		 * @return array con las categorias
		 */
		public static function get_categori($id_cat) {
			try {

				$conn = DB::instance();
				$query = "SELECT c.id as id_cat_prin, c.nombre as nom_cat_prin,ifnull(co.`texto`,'') 'descripcion',ifnull(co.`imagen`,'') 'imagen' FROM categorias c 
				LEFT JOIN contenido co on (co.`id`=c.`id` and co.`tipo_cat`=1) WHERE c.id = $id_cat ";
				$res = $conn->prepare($query);
				$res->execute();
				$rows = $res->rowCount();
				$conn->close();
				if ($rows > 0) {
					return $res->fetchAll();					
				}
				return null;

			} catch (\PDOException $e) {
				return null;
			}
		}
		/**
		 *  Metodo que obtiene todas las categorias registradas en la DB
		 * @return array con las categorias
		 */
		public static function get_sub_categori($id_sub_cat) {
			try {

				$conn = DB::instance();
				$query = "SELECT c.id as id_sub, c.nombre as nom_sub, c.id_categoria,ifnull(co.`texto`,'') 'descripcion',ifnull(co.`imagen`,'') 'imagen'  FROM sub_categoria c
				LEFT JOIN contenido co on (co.`id`=c.`id` and co.`tipo_cat`=2) WHERE c.id = $id_sub_cat ";
				$res = $conn->prepare($query);
				$res->execute();
				$rows = $res->rowCount();
				$conn->close();
				if ($rows > 0) {
					return $res->fetchAll();					
				}
				return null;

			} catch (\PDOException $e) {
				return null;
			}
		}
		/**
		 *  Metodo que obtiene todas las categorias registradas en la DB
		 * @return array con las categorias
		 */
		public static function get_sub_subcategori($id_sub_sub_cat) {
			try {

				$conn = DB::instance();
				$query = "SELECT c.id as id_sub, c.nombre as nom_sub, c.id_subcategoria,ifnull(co.`texto`,'') 'descripcion',ifnull(co.`imagen`,'') 'imagen' FROM sub_categoria2 c
				LEFT JOIN contenido co on (co.`id`=c.`id` and co.`tipo_cat`=3) WHERE c.id = $id_sub_sub_cat ";
				$res = $conn->prepare($query);
				$res->execute();
				$rows = $res->rowCount();
				$conn->close();
				if ($rows > 0) {
					return $res->fetchAll();					
				}
				return null;

			} catch (\PDOException $e) {
				return null;
			}
		}

		
	}

?>