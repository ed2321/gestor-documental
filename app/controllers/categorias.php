<?php

	namespace App\Controller;

	use \App\Models\DTO\Contenido as ContDTO;
	use \App\Models\DTO\Sub_categorias as SubCatDTO;
	use \App\Models\DTO\Sub_categorias2 as SubCatDTO2;
	use \App\Models\DTO\Categoria as CatDTO;
	use \App\Models\CategoriaDAO as CatDAO;
	use \App\Models\Sub_CategoriaDAO as SubCatDAO;
	use \App\Models\Sub_CategoriaDAO2 as SubCatDAO2;
	use \Core\View;


	/**
	*  Clase controladora que gestiona las peticiones realizadas sobre las distintas categorias de los modelos
	*/
	class Categorias {


		/**
		 * Metodo que muestra el formulario de registro de nuevas categorias
		 */
		function show() {
			$categorias = CatDAO::select();
			$subCat = SubCatDAO::select();
			$subCat2 = SubCatDAO2::select();
			$data = $this->pushSubCategories($categorias, $subCat, $subCat2);
			View::set("categorias", $data);
			View::render('admin' . DS . 'categorias');
		}

		/**
		 *  Metodo que crea los objetos de las categorias y asigna las sub-categorias a cada categoria
		 */
		private function pushSubCategories($cat, $subCat, $subCat2) {
			$obj = [];
			if (!empty($cat) and !empty($subCat)) {
				foreach ($cat as $value) {
					$id = $value[0];
					$newCat = new CatDTO($value[1]);
					$newCat->setId($id);
					$array = [];
					for ($i=0; $i < count($subCat); $i++) {
						if ($id == $subCat[$i][2]) {
							$sub = new SubCatDTO($subCat[$i][1], $subCat[$i][2]);
							$sub->setId($subCat[$i][0]);
							$arraySub = [];
							if (!empty($subCat2)) {
								foreach ($subCat2 as $s) {
									if ($subCat[$i][0] == $s[2]) {
										$sc = new SubCatDTO2($s[1], $s[2]);
										$sc->setId($s[0]);
										$arraySub[] = $sc;
									}
								}
							}
							$sub->setSubCategorias($arraySub);
							$array[] = $sub;
						}
					}
					$newCat->setSubCategorias($array);
					$obj[] = $newCat;
				}
			}
			return $obj;
		}

		/**
		 *  Metodo que captura los datos de la vista y los envia al DAO
		 */
		function insert() {
			$cat = $_POST['id_categoria'];
			$sub = $_POST['sub_categoria'];
			if (!empty($cat) and !empty($sub)) {
				$obj = new SubCatDTO($sub, $cat);
				$json = SubCatDAO::insert($obj);
			}
			else {
				$json = ['ok' => false, 'error' => 'Faltan datos por ingresar'];
			}

			print(json_encode($json));
		}

		/**
		 *  Metodo que captura los datos de la vista y los envia al DAO
		 */
		function insertSubCat () {
			$cat = $_POST['id_subcategoria'];
			$sub = $_POST['subcategoria'];
			if (!empty($cat) and !empty($sub)) {
				$obj = new SubCatDTO2($sub, $cat);
				$json = SubCatDAO2::insert($obj);
			}
			else {
				$json = ['ok' => false, 'error' => 'Faltan datos por ingresar'];
			}

			print(json_encode($json));
		}

		/**
		 *  Metodo que obtiene el id de la categoria hacer elminada y la envia al DAO
		 */
		function delete() {
			$id = $_POST['id'];
			if (!empty($id)) {
				$json = SubCatDAO::delete($id);
			}
			else {
				$json = ['ok' => false, 'error' => 'Falta el id de la subcategoria'];
			}

			print(json_encode($json));
		}
		/**
		 *  Metodo que obtiene el id de la categoria hacer elminada y la envia al DAO
		 */
		function delete_cat() {
			$id = $_POST['id_cat'];
			if (!empty($id)) {
				$json = SubCatDAO::delete_cat($id);
			}
			else {
				$json = ['ok' => false, 'error' => 'Falta el id de la subcategoria'];
			}

			print(json_encode($json));
		}

		/**
		 *  Metodo que obtiene el id de la subcategoria hacer elminada y la envia al DAO
		 */
		function deleteSubCat() {
			$id = $_POST['id'];
			if (!empty($id)) {
				$json = SubCatDAO2::delete($id);
			}
			else {
				$json = ['ok' => false, 'error' => 'Falta el id de la subcategoria'];
			}

			print(json_encode($json));
		}

		/**
		 * Metodo que obtiene el id de la categoria y la envia la modelo
		 */
		 function getForCategories () {
			 if (!empty($_POST['id'])) {
				 $id = $_POST['id'];
			 	 $json = SubCatDAO::getCategoriesForId($id);
			}
			else {
				$json = ['ok' => false, 'error' => 'Falta el id de la categoria '];
			}
			 print(json_encode($json));
		 }

		 /**
 		 * Metodo que obtiene el id de la subcategoria y la envia la modelo
 		 */
 		 function getForSubCategories () {
 			 if (!empty($_POST['id'])) {
 				 $id = $_POST['id'];
 			 	 $json = SubCatDAO::getSubCategoriesForId($id);
 			}
 			else {
 				$json = ['ok' => false, 'error' => 'Falta el id de la categoria '];
 			}
 			 print(json_encode($json));
		  }
		  

		  /**
		 * Metodo que guarda o actualiza la informacion de las distintas categorias en la DB,
		 * sube la imagen relacionada con la categoria a la ruta especificada en la
		 * variable $patch
		 * @var $trs Indica el tipo de operacion a realizar: Insertar o Actualizar
		 * @return objeto json con la respuesta de guardar la informacion de la
		 * categoria del modelo documental
		 */
		function registro_categoria() {
			if (!empty($_POST['texto']) && !empty($_POST['categoria-principal'])) {
				$res = array();
				$text = htmlspecialchars($_POST['texto']);
				$cat_name = htmlspecialchars($_POST['cat_name']);
				$name = '';
				if (isset($_FILES['archivo'])) {
					$name = $_FILES['archivo']['name'];
					$arr = explode(".", $name);
					$type = end($arr);
					if ($type == 'jpeg' || $type == 'png' || $type == 'jpg' || $type == 'jpeg' || $type == 'zip' || $type == 'doc' || $type == 'docx' || $type == 'xls'
					|| $type == 'xlsx' || $type == 'ppt' || $type == 'pptx' || $type == 'pdf') {
						if (!$_FILES['archivo']['error']) {
							$patch = PROJECTPATH . DS .'uploads' . DS;
							$tmp = $_FILES['archivo']['tmp_name'];
							$mov = move_uploaded_file($tmp, $patch . $_FILES['archivo']['name']);
							if (!$mov) {
								print(json_encode(['ok' => false, 'error' => $_FILES['archivo']]));
								exit();
							}
						} else {
							print(json_encode(['ok' => false, 'error' => $_FILES['archivo']['error']]));
							exit();
						}
					}
					else {
						print(json_encode(['ok' => false, 'error' => 'Formato de imagen no valido' . $type]));
						exit();
					}
				}
				else {
					print(json_encode(['ok' => false, 'error' => 'Debe cargar una imagen']));
					exit();
				}
				$response = CatDAO::inser_cat($cat_name,$name, $text, $_SESSION['admin']['id'],1);
				print(json_encode($response));
				exit();
			}
			else {
				print(json_encode(['ok' => false, 'error' => 'Faltan campos por ingresar']));
			}
		}
		  /**
		 * Metodo que guarda o actualiza la informacion de las distintas categorias en la DB,
		 * sube la imagen relacionada con la categoria a la ruta especificada en la
		 * variable $patch
		 * @var $trs Indica el tipo de operacion a realizar: Insertar o Actualizar
		 * @return objeto json con la respuesta de guardar la informacion de la
		 * categoria del modelo documental
		 */
		function registro_subcategoria() {
			$cat = $_POST['id_categoria'];
			$sub = $_POST['sub_categoria'];
			if (!empty($_POST['texto']) && !empty($cat) && !empty($sub)) {
				$res = array();
				$text = htmlspecialchars($_POST['texto']);
				$cat_name = htmlspecialchars($_POST['sub_categoria']);
				$name = '';
				if (isset($_FILES['archivo'])) {
					$name = $_FILES['archivo']['name'];
					$arr = explode(".", $name);
					$type = end($arr);
					if ($type == 'jpeg' || $type == 'png' || $type == 'jpg' || $type == 'jpeg' || $type == 'zip' || $type == 'doc' || $type == 'docx' || $type == 'xls'
					|| $type == 'xlsx' || $type == 'ppt' || $type == 'pptx' || $type == 'pdf') {
						if (!$_FILES['archivo']['error']) {
							$patch = PROJECTPATH . DS .'uploads' . DS;
							$tmp = $_FILES['archivo']['tmp_name'];
							$mov = move_uploaded_file($tmp, $patch . $_FILES['archivo']['name']);
							if (!$mov) {
								print(json_encode(['ok' => false, 'error' => $_FILES['archivo']]));
								exit();
							}
						} else {
							print(json_encode(['ok' => false, 'error' => $_FILES['archivo']['error']]));
							exit();
						}
					}
					else {
						print(json_encode(['ok' => false, 'error' => 'Formato de imagen no valido' . $type]));
						exit();
					}
				}
				else {
					print(json_encode(['ok' => false, 'error' => 'Debe cargar una imagen']));
					exit();
				}
				$response = CatDAO::inser_subcat($cat_name,$name, $text, $_SESSION['admin']['id'],$cat,2);
				print(json_encode($response));
				exit();
			}
			else {
				print(json_encode(['ok' => false, 'error' => 'Faltan campos por ingresar']));
			}
		}
	}

?>
