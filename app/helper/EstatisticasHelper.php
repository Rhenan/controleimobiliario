<?php


class EstatisticasHelper {
	
	public static final function getEstatisticaManutencoes()
	{
		$estatistica = Array();
		
		// Estatísticas de Serviços de Manutenção
		$sql = "select count(*) from servicomanutencao";
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["manutencoes_totais"] = $result;
		
		$sql = "select count(*) from servicomanutencao where situacao!='REPROVADO' and situacao!='CONCLUIDO'";		
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["manutencoes_ativas"] = $result;
		
		$sql = "select count(*) from servicomanutencao where situacao='CONCLUIDO'";
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["manutencoes_concluidas"] = $result;
		
		$sql = "select count(*) from servicomanutencao where situacao='REPROVADO'";
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["manutencoes_reprovadas"] = $result;
		
		// Estatísticas de Imóveis
		$sql = "select count(*) from imovel";
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["imoveis"] = $result;

		// Estatísticas de Usuários
		$sql = "select count(*) from usuario where status='ATIVO'";
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["usuarios"] = $result;
		
		$sql = "select count(*) from usuario where perfil='".ServicoHelper::GERENTE."' and status='ATIVO'";
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["usuarios_gerentes"] = $result;
		
		$sql = "select count(*) from usuario where perfil='".ServicoHelper::PROPRIETARIO."' and status='ATIVO'";
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["usuarios_proprietarios"] = $result;
		
		$sql = "select count(*) from usuario where perfil='".ServicoHelper::INQUILINO."' and status='ATIVO'";
		$result = DaoEntity::doQuery($sql)->fetchColumn();
		$estatistica["usuarios_inquilinos"] = $result;
		
		return $estatistica;
	}
}

?>