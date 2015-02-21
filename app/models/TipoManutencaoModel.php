<?php

	/*
		CÃ³digo gerado automÃ¡ticamente.
		NÃ£o modifique, pois o arquivo serÃ¡ apagado e gerado novamente
		cada vez que ocorrer uma transformaÃ§Ã£o de modelo.	
	*/

	class TipoManutencaoModel{

		private $id;
		private $nome;
		private $categoria;
		private $servicoManutencao;

		function get_class_vars()
		{
			return array_keys(get_class_vars(get_class($this)));

		}
		function get($parameter)
		{
			switch($parameter)
			{
				case "id": return $this->id; break;
				case "nome": return $this->nome; break;
				case "categoria": return $this->categoria; break;
				case "servicoManutencao": return $this->servicoManutencao; break;
				default: return ""; break;
			}
		}

		function set($parameter,$value)
		{
			switch($parameter)
			{
				case "id": $this->id = $value; break;
				case "nome": $this->nome = $value; break;
				case "categoria": $this->categoria = $value; break;
				case "servicoManutencao": $this->servicoManutencao = $value; break;
			}	
		}
		// Getter and Setter of id
		function getId()
		{
			return $this->id;
		}
		function setId($id)
		{
			$this->id = $id;
		}
		// Getter and Setter of nome
		function getNome()
		{
			return $this->nome;
		}
		function setNome($nome)
		{
			$this->nome = $nome;
		}
		// Getter and Setter of categoria
		function getCategoria()
		{
			return $this->categoria;
		}
		function setCategoria($categoria)
		{
			$this->categoria = $categoria;
		}
		// Getter and Setter of servicoManutencao
		function getServicoManutencao()
		{
			return $this->servicoManutencao;
		}
		function setServicoManutencao($servicoManutencao)
		{
			$this->servicoManutencao = $servicoManutencao;
		}

		public function getModelName()
		{
			return "TipoManutencao";
		}

		public function __construct($param=null)
		{
			if(is_object($param) && get_class($param)==get_class($this))
			{
				foreach(get_class_vars($this) as $var)
				{
					$setName = "set".ucfirst($var);
					$getName = "get".ucfirst($var);
					$this->$setName($param->$getName($var));
				}
			}
			else if(is_array($param)){
				foreach(array_keys($param) as $var)
				{
					foreach($this->get_class_vars() as $att)
					{
						$setName = "set".ucfirst($var);
						if($att == $var) $this->$setName($param[$var]);
					}
				}
			}
		}
	}
?>
