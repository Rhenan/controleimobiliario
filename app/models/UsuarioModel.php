<?php

	/*
		Código gerado automáticamente.
		Não modifique, pois o arquivo será apagado e gerado novamente
		cada vez que ocorrer uma transformação de modelo.	
	*/

	class UsuarioModel extends Model{

		private $id;
		private $usuario;
		private $senha;
		private $perfil;
		private $nome;
		private $status;
		
		function get_class_vars()
		{
			return array_keys(get_class_vars(get_class($this)));
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
		// Getter and Setter of status
		function getStatus()
		{
			return $this->status;
		}
		function setStatus($status)
		{
			$this->status = $status;
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
		// Getter and Setter of nome
		function getNome()
		{
			return $this->nome;
		}
		function setNome($nome)
		{
			$this->nome = $nome;
		}
		// Getter and Setter of senha
		function getSenha()
		{
			return $this->senha;
		}
		function setSenha($senha)
		{
			$this->senha = $senha;
		}
		// Getter and Setter of proprietario
		function getPerfil()
		{
			return $this->perfil;
		}
		function setPerfil($perfil)
		{
			$this->perfil = $perfil;
		}

		public function getModelName()
		{
			return "Usuario";
		}

		public function __construct($param=null)
		{
			parent::__construct();
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
