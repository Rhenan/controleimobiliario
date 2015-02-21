<div id="app-window-2" class="left">	
	<h1>Avisos</h1>
	<div id="app-panel-detail-panel">
		<?php
			if(!empty($this->data["manutencoes_aprovacao"]))
			{
				echo "<h3>Manutenções aguardando a sua aprovação</h3>";
				foreach($this->data["manutencoes_aprovacao"] as $manut)
					echo "<p>".$this->helper->link("?module=Proprietario&action=detalhar_servico_prop&id=".$manut->getId(),$manut->getNome())."<p>";				
			}
			else
			{
				echo "<p>Nenhum novo aviso.";
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
				<h3>Manutenções Ativas no Sistema</h3>
				<div id='grafico'></div>
			</div>
		</div>
<?php
	}
?>
