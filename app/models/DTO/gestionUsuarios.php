<?php  

	namespace App\Models\DTO;

	class gestionUsuarios {
		
		
		private $_id;

		private $_nombre;

		private $_email;

		private $_id_rol;


		function __construct($nombre, $email, $id_rol) {
			$this->_nombre = $nombre;
			$this->_email = $email;
			$this->_id_rol = $id_rol;
		}
		
		function set_id($id) {
			$this->_id = $id;
		}

		function get_id() {
			return $this->_id;
		}

		function set_nombre($nombre) {
			$this->_nombre = $nombre;
		}

		function get_nombre() {
			return $this->_nombre;
		}

		function set_email($email) {
			$this->_email = $email;
		}

		function get_email() {
			return $this->_email;
		}

		function set_id_rol($id_rol) {
			$this->_id_rol = $id_rol;
		}

		function get_id_rol() {
			return $this->_id_rol;
		}
	}

?>