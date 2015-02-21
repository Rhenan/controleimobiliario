<div id="app-window-1">	
	<h1>Abrir novo pedido de Serviço de Manutenção</h1>
	<div id="app-panel-detail-panel">
	<?php
		echo $this->helper->open_form("edit","index.php");
		echo $this->helper->hidden("module","Inquilino");
		echo $this->helper->hidden("action","salvar_novo_servico_manutencao");
		
		echo "<p>Título: ".$this->helper->input("nome","text")."</p>";
		echo "<p>Tipo: ".$this->helper->combo("idTipo",$this->data["listaTipos"])."</p>";
		echo "<p>Descrição: ".$this->helper->textarea("descricao")."</p>";
		
	
		echo "<p>Imóvel: ".$this->helper->combo("idImovel",$this->data["listaImoveis"])."</p><br/>";
		echo "<p>".$this->helper->submit("Enviar")."</p>";

		$this->helper->close_form();
	?>
	</div>
</div>