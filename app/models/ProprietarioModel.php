<?php

	/*
		Código gerado automáticamente.
		Não modifique, pois o arquivo será apagado e gerado novamente
		cada vez que ocorrer uma transformação de modelo.	
	*/

	class ProprietarioModel{

		private $id;
		private $nome;
		private $cpf;
		private $dataDeNascimento;
		private $telefone1;
		private $telefone2;
		private $email;
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
				case "cpf": return $this->cpf; break;
				case "dataDeNascimento": return $this->dataDeNascimento; break;
				case "telefone1": return $this->telefone1; break;
				case "telefone2": return $this->telefone2; break;
				case "email": return $this->email; break;
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
				case "cpf": $this->cpf = $value; break;
				case "dataDeNascimento": $this->dataDeNascimento = $value; break;
				case "telefone1": $this->telefone1 = $value; break;
				case "telefone2": $this->telefone2 = $value; break;
				case "email": $this->email = $value; break;
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
		// Getter and Setter of cpf
		function getCpf()
		{
			return $this->cpf;
		}
		function setCpf($cpf)
		{
			$this->cpf = $cpf;
		}
		// Getter and Setter of dataDeNascimento
		function getDataDeNascimento()
		{
			return $this->dataDeNascimento;
		}
		function setDataDeNascimento($dataDeNascimento)
		{
			$this->dataDeNascimento = $dataDeNascimento;
		}
		// Getter and Setter of telefone1
		function getTelefone1()
		{
			return $this->telefone1;
		}
		function setTelefone1($telefone1)
		{
			$this->telefone1 = $telefone1;
		}
		// Getter and Setter of telefone2
		function getTelefone2()
		{
			return $this->telefone2;
		}
		function setTelefone2($telefone2)
		{
			$this->telefone2 = $telefone2;
		}
		// Getter and Setter of email
		function getEmail()
		{
			return $this->email;
		}
		function setEmail($email)
		{
			$this->email = $email;
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
			return "Proprietario";
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
