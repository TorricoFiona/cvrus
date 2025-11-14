<?php 


	/**
	 * 
	 */
	class DBAbstract
	{

		protected $db;
		
		function __construct()
		{
			$this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			// Asegurar codificación correcta
			if ($this->db) {
				$this->db->set_charset('utf8mb4');
			}
		}


		/* solo funciona para hacer select a futuro lo haremos para todas las dml: SELECT, INSERT, UPDATE, DELETE */
		public function consultar($sql){

			$response = $this->db->query($sql);

			return $response->fetch_all(MYSQLI_ASSOC);
		}

		public function ejecutar($sql) {
		    return $this->db->query($sql);
		}

		// Verifica si una columna existe en una tabla del esquema actual
		public function hasColumn($table, $column) {
			$stmt = $this->db->prepare("SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=? AND COLUMN_NAME=?");
			if(!$stmt){
				return false;
			}
			$dbName = DB_NAME;
			$stmt->bind_param("sss", $dbName, $table, $column);
			$stmt->execute();
			$stmt->store_result();
			$exists = $stmt->num_rows > 0;
			$stmt->close();
			return $exists;
		}

	}


 ?>
