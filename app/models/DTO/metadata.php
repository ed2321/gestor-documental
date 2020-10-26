<?php  

	namespace App\Models\DTO;

	class Metadata {
		
		
		private $_id_doc_cat;

		private $_nombre_categoria;


		function __construct($id_doc_cat, $nombre_categoria) {
			$this->_id_doc_cat = $id_doc_cat;
			$this->_nombre_categoria = $nombre_categoria;
		}
		
		function set_id_doc_cat($id_doc_cat) {
			$this->_id_doc_cat = $id_doc_cat;
		}

		function get_id_doc_cat() {
			return $this->_id_doc_cat;
		}

		function set_nombre_categoria($nombre_categoria) {
			$this->_nombre_categoria = $nombre_categoria;
		}

		function get_nombre_categoria() {
			return $this->_nombre_categoria;
		}
	}

?>