<?php

	/*
		CÃ³digo gerado automÃ¡ticamente.
		NÃ£o modifique, pois o arquivo serÃ¡ apagado e gerado novamente
		cada vez que ocorrer uma transformaÃ§Ã£o de modelo.	
	*/

	class ServicoManutencaoModel{

		private $id;
		private $nome;
		private $descricao;
		private $situacao;
		private $imovel;
		private $eventoAcompanhamento;
		private $tipoManutencao;
		private $orcamentos;
		private $dataAbertura;

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
				case "descricao": return $this->descricao; break;
				case "situacao": return $this->situacao; break;
				case "imovel": return $this->imovel; break;
				case "eventoAcompanhamento": return $this->eventoAcompanhamento; break;
				case "tipoManutencao": return $this->tipoManutencao; break;
				default: return ""; break;
			}
		}

		function set($parameter,$value)
		{
			switch($parameter)
			{
				case "id": $this->id = $value; break;
				case "nome": $this->nome = $value; break;
				case "descricao": $this->descricao = $value; break;
				case "situacao": $this->situacao = $value; break;
				case "imovel": $this->imovel = $value; break;
				case "eventoAcompanhamento": $this->eventoAcompanhamento = $value; break;
				case "tipoManutencao": $this->tipoManutencao = $value; break;
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
		// Getter and Setter of dataAbertura
		function getDataAbertura()
		{
			return $this->dataAbertura;
		}
		function setDataAbertura($data)
		{
			$this->dataAbertura = $data;
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
		// Getter and Setter of situacao
		function getSituacao()
		{
			return $this->situacao;
		}
		function setSituacao($situacao)
		{
			$this->situacao = $situacao;
		}
		// Getter and Setter of imovel
		function getImovel()
		{
			return $this->imovel;
		}
		function setImovel($imovel)
		{
			$this->imovel = $imovel;
		}
		// Getter and Setter of eventoAcompanhamento
		function getEventoAcompanhamento()
		{
			return $this->eventoAcompanhamento;
		}
		function setEventoAcompanhamento($eventoAcompanhamento)
		{
			$this->eventoAcompanhamento = $eventoAcompanhamento;
		}
		// Getter and Setter of tipoManutencao
		function getTipoManutencao()
		{
			return $this->tipoManutencao;
		}
		function setTipoManutencao($tipoManutencao)
		{
			$this->tipoManutencao = $tipoManutencao;
		}
		// Getter and Setter of tipoManutencao
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
			return "ServicoManutencao";
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
