<?php

	/*
		CÃ³digo gerado automÃ¡ticamente.
		NÃ£o modifique, pois o arquivo serÃ¡ apagado e gerado novamente
		cada vez que ocorrer uma transformaÃ§Ã£o de modelo.	
	*/

	class ImovelModel{

		private $id;
		private $nome;
		private $endereco;
		private $cep;
		private $identificador;
		private $servicoManutencao;
		private $usuario;

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
				case "endereco": return $this->endereco; break;
				case "cep": return $this->cep; break;
				case "identificador": return $this->identificador; break;
				case "servicoManutencao": return $this->servicoManutencao; break;
				case "usuario": return $this->usuario; break;
				default: return ""; break;
			}
		}

		function set($parameter,$value)
		{
			switch($parameter)
			{
				case "id": $this->id = $value; break;
				case "nome": $this->nome = $value; break;
				case "endereco": $this->endereco = $value; break;
				case "cep": $this->cep = $value; break;
				case "identificador": $this->identificador = $value; break;
				case "servicoManutencao": $this->servicoManutencao = $value; break;
				case "usuario": $this->usuario = $value; break;
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
		// Getter and Setter of endereco
		function getEndereco()
		{
			return $this->endereco;
		}
		function setEndereco($endereco)
		{
			$this->endereco = $endereco;
		}
		// Getter and Setter of cep
		function getCep()
		{
			return $this->cep;
		}
		function setCep($cep)
		{
			$this->cep = $cep;
		}
		// Getter and Setter of identificador
		function getIdentificador()
		{
			return $this->identificador;
		}
		function setIdentificador($identificador)
		{
			$this->identificador = $identificador;
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
		// Getter and Setter of usuario
		function getUsuario()
		{
			return $this->usuario;
		}
		function setUsuario($usuario)
		{
			$this->usuario = $usuario;
		}

		public function getModelName()
		{
			return "Imovel";
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
