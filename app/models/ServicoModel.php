<?php

	/*
		Código gerado automáticamente.
		Não modifique, pois o arquivo será apagado e gerado novamente
		cada vez que ocorrer uma transformação de modelo.	
	*/

	class ServicoModel extends Model{

		private $id;
		private $acao;
		private $modulo;
		private $nome;
		private $hasMenuItem;

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
		// Getter and Setter of hasMenuItem
		function getHasMenuItem()
		{
			return $this->hasMenuItem;
		}
		function setHasMenuItem($hasMenuItem)
		{
			$this->hasMenuItem = $hasMenuItem;
		}
		// Getter and Setter of acao
		function getAcao()
		{
			return $this->acao;
		}
		function setAcao($acao)
		{
			$this->acao = $acao;
		}
		// Getter and Setter of modulo
		function getModulo()
		{
			return $this->modulo;
		}
		function setModulo($modulo)
		{
			$this->modulo = $modulo;
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
		// Getter and Setter of usuarios
		function getUsuarios()
		{
			return $this->usuarios;
		}
		function setUsuarios($usuarios)
		{
			$this->usuarios = $usuarios;
		}

		public function getModelName()
		{
			return "Servico";
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
