<?php
abstract class EnumHelper {
	
	const NOVO = "NOVO";
	const AGUARDANDO = "AGUARDANDO";
	const ORCAMENTO = "ORCAMENTO";
	const APROVACAO = "APROVACAO";
	const ANDAMENTO = "ANDAMENTO";
	const CONCLUIDO = "CONCLUIDO";
	const REPROVADO = "REPROVADO";
	
	const ORCAMENTO_ABERTO = "ABERTO";
	const ORCAMENTO_REPROVADO = "REPROVADO";
	const ORCAMENTO_APROVADO = "APROVADO";
	
	public static final function getCategoriasDeManutencao()
	{
		return Array(
			"Hidraulico"=>"Hidráulico",
			"Marcenaria"=>"Marcenaria",
			"Eletrico"=>"Elétrico",
			"Alvenaria"=>"Alvenaria",
			"Outro"=>"Outro"
		);	
	}
	
	public static function getSituacoes()
	{
		return Array(
			"NOVO"=>"A solicitação de Manutenção foi criada",
			"AGUARDANDO"=>"Aguardando Aprovação da Imobiliária",
			"ORCAMENTO"=>"Em Orçamento",
			"APROVACAO"=>"Aguardando Aprovação do Proprietário",
			"ANDAMENTO"=>"Em Andamento",
			"CONCLUIDO"=>"Concluído",
			"REPROVADO"=>"Reprovado"
		);
	}
}

?>
