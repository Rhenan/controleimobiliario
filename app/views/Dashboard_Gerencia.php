<div id="app-window-2" class="left">	
	<h1>Avisos</h1>
	<div id="app-panel-detail-panel">
		<?php
			$temAvisos = false;
		
			if(!empty($this->data["manutencoes_pendentes"]))
			{
				echo "<h3>Manutenções Novas</h3>";
				foreach($this->data["manutencoes_novas"] as $manut)
					echo "<p>".$this->helper->link("?module=Gerencia&action=detalhar_servico_manutencao&id=".$manut->getId(),$manut->getNome())."<p>";
					
				echo "<hr/>";
				
				$temAvisos = true;
			}
			
			if(!empty($this->data["manutencoes_aguardando"]))
			{
				echo "<h3>Manutenções Aguardando Início</h3>";
				foreach($this->data["manutencoes_aguardando"] as $manut)
					echo "<p>".$this->helper->link("?module=Gerencia&action=detalhar_servico_manutencao&id=".$manut->getId(),$manut->getNome())."<p>";
				
				$temAvisos = true;
			}
			if(!empty($this->data["manutencoes_orcamento"]))
			{
				echo "<h3>Manutenções Aguardando Orçamento</h3>";
				foreach($this->data["manutencoes_orcamento"] as $manut)
					echo "<p>".$this->helper->link("?module=Gerencia&action=detalhar_servico_manutencao&id=".$manut->getId(),$manut->getNome())."<p>";

				$temAvisos = true;
			}
			
			if(!$temAvisos)
			{
				echo "<p>Nenhum novo aviso.</p>";
			}
		?>
	</div>
</div>
<?php
	if(!empty($this->data["estatisticas"]))
	{
?>
		
		<div id="app-window-2" class="right">	
			<h1>Estatísticas</h1>
			<div id="app-panel-detail-panel">
				<h3>Manutenções no Sistema</h3>
				<ul>
					<li>Total de Manutenções: <?php echo $this->data["estatisticas"]["manutencoes_totais"]?></li>
					<li>Manutenções Ativas: <?php echo $this->data["estatisticas"]["manutencoes_ativas"]?></li>
					<li>Manutenções Concluídas: <?php echo $this->data["estatisticas"]["manutencoes_concluidas"]?></li>
					<li>Manutenções Reprovadas: <?php echo $this->data["estatisticas"]["manutencoes_reprovadas"]?></li>
				</ul>
				<br/><br/>
				<h3>Imóveis Cadastrados no Sistema</h3>
				<ul>
					<li>Total: <?php echo $this->data["estatisticas"]["imoveis"]?></li>
				</ul>
				<br/><br/>
				<h3>Usuários Ativos no Sistema</h3>
				<ul>
					<li>Total de Usuários: <?php echo $this->data["estatisticas"]["usuarios"]?></li>
					<li>Gerentes: <?php echo $this->data["estatisticas"]["usuarios_gerentes"]?></li>
					<li>Inquilinos: <?php echo $this->data["estatisticas"]["usuarios_inquilinos"]?></li>
					<li>Proprietários: <?php echo $this->data["estatisticas"]["usuarios_proprietarios"]?></li>
				</ul>
			</div>
		</div>
		
		<?php
	}
?>
