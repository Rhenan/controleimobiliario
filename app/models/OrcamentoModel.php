<?php
	class OrcamentoModel extends Model{
	
		// ID
		private $id;
		
		public function getId()
		{
			return $this->id;
		}
		public function setId($id)
		{
			$this->id = $id;
		}
		
		// Parametros
		private $titulo, $valor, $pdf, $situacao;
		
		public function getTitulo()
		{
			return $this->titulo;
		}
		
		public function getValor()
		{
			return $this->valor;
		}
		
		public function getPdf()
		{
			return $this->pdf;
		}

		public function getSituacao()
		{
			return $this->situacao;
		}
		
		public function setTitulo($var)
		{
			$this->titulo = $var;
		}
		
		public function setValor($var)
		{
			$this->valor = $var;
		}
		
		public function setPdf($var)
		{
			$this->pdf = $var;
		}
		
		public function setSituacao($var)
		{
			$this->situacao = $var;
		}
		
		
		public function getModelName()
		{
			return "Orcamento";
		}
		
		function get_class_vars()
		{
			return array_keys(get_class_vars(get_class($this)));
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