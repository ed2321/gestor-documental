<?php  

	namespace App\Models\DTO;

	class documentosMetadataDAO {
		
		
		private $_id_doc_meta;

		private $_name_meta;


		function __construct($name_meta) {
			$this->_name_meta = $name_meta;
		}
		
		function set_id_doc_meta($id_doc_meta) {
			$this->_id_doc_meta = $id_doc_meta;
		}

		function get_id_doc_meta() {
			return $this->_id_doc_meta;
		}

		function set_name_meta($name_meta) {
			$this->_name_meta = $name_meta;
		}

		function get_name_meta() {
			return $this->_name_meta;
		}
	}

?>