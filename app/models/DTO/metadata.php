<?php  

	namespace App\Models\DTO;

	/**
	*  Clase DTO que representa los documentos cargados en el sistema
	*/
	class Metadata {
		
		/**
		 * @var $id representa el identificador unico del documento
		 */
		private $_id_doc_cat;

		/**
		 * @var $titulo contiene el titulo del documento
		 */
		private $_nombre_categoria;


		function __construct($id_doc_cat, $nombre_categoria)	{
			$this->_id_doc_cat = $id_doc_cat;
			$this->_nombre_categoria = $nombre_categoria;
		}

		/**
		 * Metodos Getters y Setters
		 */
		function set_id_doc_cat($desc)
		{
			$this->_descripcion = $desc;
		}

		function get_id_doc_cat()
		{
			return $this->_documento;
		}

		function setDocumento($doc)
		{
			$this->_documento = $doc;
		}

		function getIdContenido()
		{
			return $this->_id_contenido;
		}

		function setIdContenido($id_con)
		{
			$this->_id_contenido = $id_con;
		}
	}

?>