<?php

	/*
		CÃ³digo gerado automÃ¡ticamente.
		NÃ£o modifique, pois o arquivo serÃ¡ apagado e gerado novamente
		cada vez que ocorrer uma transformaÃ§Ã£o de modelo.	
	*/

	class EventoModel extends Model{

		private $id;
		private $descricao;
		private $estadoAnterior;
		private $estadoModificado;
		private $dataDeModificacao;
		private $valor;
		private $servicoManutencao;
		private $usuario;
		private $orcamentos;

		function get_class_vars()
		{
			return array_keys(get_class_vars(get_class($this)));

		}
		function get($parameter)
		{
			switch($parameter)
			{
				case "id": return $this->id; break;
				case "descricao": return $this->descricao; break;
				case "estadoAnterior": return $this->estadoAnterior; break;
				case "estadoModificado": return $this->estadoModificado; break;
				case "dataDeModificacao": return $this->dataDeModificacao; break;
				case "valor": return $this->valor; break;
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
				case "descricao": $this->descricao = $value; break;
				case "estadoAnterior": $this->estadoAnterior = $value; break;
				case "estadoModificado": $this->estadoModificado = $value; break;
				case "dataDeModificacao": $this->dataDeModificacao = $value; break;
				case "valor": $this->valor = $value; break;
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
		// Getter and Setter of descricao
		function getDescricao()
		{
			return $this->descricao;
		}
		function setDescricao($descricao)
		{
			$this->descricao = $descricao;
		}
		// Getter and Setter of estadoAnterior
		function getEstadoAnterior()
		{
			return $this->estadoAnterior;
		}
		function setEstadoAnterior($estadoAnterior)
		{
			$this->estadoAnterior = $estadoAnterior;
		}
		// Getter and Setter of estadoModificado
		function getEstadoModificado()
		{
			return $this->estadoModificado;
		}
		function setEstadoModificado($estadoModificado)
		{
			$this->estadoModificado = $estadoModificado;
		}
		// Getter and Setter of dataDeModificacao
		function getDataDeModificacao()
		{
			return $this->dataDeModificacao;
		}
		function setDataDeModificacao($dataDeModificacao)
		{
			$this->dataDeModificacao = $dataDeModificacao;
		}
		// Getter and Setter of valor
		function getValor()
		{
			return $this->valor;
		}
		function setValor($valor)
		{
			$this->valor = $valor;
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
		
		// Getter and Setter of orcamentos
		function getOrcamentos()
		{
			return $this->orcamentos;
		}
		function setOrcamentos($orcamentos)
		{
			if(is_array($orcamentos))
				$this->orcamentos = $orcamentos;
		}

		public function getModelName()
		{
			return "Evento";
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
