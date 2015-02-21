<?php
	/*
		Classe de conexão padrão.
		Não modifique os métodos já existentes.
	*/
	
	class Connection{
	
		private $usuario;
		private $senha;
		private $host;
		private $banco;
		private $conn;	
		
		public function __construct()
		{
			
			require_once(CONF."db_config.php");
			
			try
			{
				ErrorConsole::info("Starting Database connection");
				$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->banco,$this->usuario,$this->senha);
			}
			catch(PDOException $e)
			{
				ErrorConsole::critical($e->getMessage());
			}
			
		}
		
		public function getConnection(){
			return $this->conn;
		}
		
		public function __destruct(){
			$conn = null;
		}
		
		/**
		 * Check if a table exists in the current database.
		 *
		 * @param PDO $pdo PDO instance connected to a database.
		 * @param string $table Table to search for.
		 * @return bool TRUE if table exists, FALSE if no table found.
		 */
		function tableExists($table) {
			// Try a select statement against the table
			// Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
			$results = $this->conn->query("SHOW TABLES LIKE '$table'");
			if(!$results) {
				return false;
			}
			if($results->rowCount()>0)
			{
				return true;
			}
			
			return false;
		}
	}
?>
