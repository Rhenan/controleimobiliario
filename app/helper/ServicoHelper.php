<?php
class ServicoHelper {
	
	private $nome_servicos;
	
	const INQUILINO = "Inquilino";
	const PROPRIETARIO = "Proprietario";
	const GERENTE = "Gerencia";
	const ACESSO = "Acesso";
	const ADMINISTRADOR = "Admin";
	
	const USUARIO_ATIVO = "ATIVO";
	const USUARIO_DESATIVADO = "DESATIVADO";

	const SENHA_PADRAO = "123456";
	const SENHA_PADRAO_ENC = "e10adc3949ba59abbe56e057f20f883e";
	
	const MODULO_PRINCIPAL = "Principal";
	const MODULO_GERENCIA = "Gerencia";
	const MODULO_INQUILINO = "Inquilino";
	const MODULO_PROPRIETARIO = "Proprietario";
	const MODULO_ACESSO = "Acesso";
	
	private $_ACOES = [
		// Administrador
		0=>Array("listar_tipo_manutencao",ServicoHelper::GERENTE,"Tipos de Manutenção",1),
		1=>Array("listar_servico_manutencao",ServicoHelper::GERENTE,"Serviços de Manutenção",1),
		2=>Array("detalhar_tipo_manutencao",ServicoHelper::GERENTE,"",0),
		3=>Array("editar_tipo_manutencao",ServicoHelper::GERENTE,"",0),
		4=>Array("salvar_tipo_manutencao",ServicoHelper::GERENTE,"",0),
		5=>Array("excluir_tipo_manutencao",ServicoHelper::GERENTE,"",0),
		6=>Array("salvar_servico_manutencao",ServicoHelper::GERENTE,"",0),
		7=>Array("detalhar_servico_manutencao",ServicoHelper::GERENTE,"",0),
		8=>Array("listar_imovel",ServicoHelper::GERENTE,"Imóveis",1),
		9=>Array("detalhar_imovel",ServicoHelper::GERENTE,"",0),
		10=>Array("editar_imovel",ServicoHelper::GERENTE,"",0),
		11=>Array("salvar_imovel",ServicoHelper::GERENTE,"",0),
		12=>Array("excluir_imovel",ServicoHelper::GERENTE,"",0),
		13=>Array("imovel_associar_inquilino_editar",ServicoHelper::GERENTE,"",0),
		14=>Array("imovel_associar_inquilino_salvar",ServicoHelper::GERENTE,"",0),
		15=>Array("imovel_associar_proprietario_editar",ServicoHelper::GERENTE,"",0),
		16=>Array("imovel_associar_proprietario_salvar",ServicoHelper::GERENTE,"",0),
		17=>Array("imovel_desassociar_usuario",ServicoHelper::GERENTE,"",0),
		
		// Inquilinos
		28=>Array("abrir_servico_manutencao",ServicoHelper::INQUILINO,"Abrir Novo Serviço",1),
		29=>Array("salvar_novo_servico_manutencao",ServicoHelper::INQUILINO,"",0),
		30=>Array("listar_servicos_em_aberto",ServicoHelper::INQUILINO,"Serviços em Aberto",1),
		31=>Array("listar_servicos_fechados",ServicoHelper::INQUILINO,"Serviços Fechados",1),
		32=>Array("detalhar_servicos_em_aberto",ServicoHelper::INQUILINO,"",0),
		33=>Array("listar_imovel_inquilino",ServicoHelper::INQUILINO,"Imóveis",1),
		34=>Array("detalhar_imovel_inquilino",ServicoHelper::INQUILINO,"",0),
		35=>Array("servico_manutencao_concluir",ServicoHelper::INQUILINO,"",0),
		
		// Funcionarios Imobiliária
		44=>Array("servico_manutencao_orcamento",ServicoHelper::GERENTE,"",0),
		45=>Array("servico_manutencao_orcamento_salvar",ServicoHelper::GERENTE,"",0),
		46=>Array("servico_manutencao_aprovacao",ServicoHelper::GERENTE,"",0),
		47=>Array("servico_manutencao_aprovacao_salvar",ServicoHelper::GERENTE,"",0),
		48=>Array("servico_manutencao_reprovar",ServicoHelper::GERENTE,"",0),
		
		// Proprietario
		60=>Array("listar_imovel_proprietario",ServicoHelper::PROPRIETARIO,"Imóveis",1),
		61=>Array("detalhar_imovel_proprietario",ServicoHelper::PROPRIETARIO,"",0),
		62=>Array("listar_servicos_em_aberto_prop",ServicoHelper::PROPRIETARIO,"Serviços em Aberto",1),
		63=>Array("listar_servicos_fechados_prop",ServicoHelper::PROPRIETARIO,"Serviços Fechados",1),
		64=>Array("detalhar_servico_prop",ServicoHelper::PROPRIETARIO,"",0),
		65=>Array("servico_manutencao_analisar",ServicoHelper::PROPRIETARIO,"",0),
		66=>Array("servico_manutencao_analisar_salvar",ServicoHelper::PROPRIETARIO,"",0),
		
		// Acesso
		90=>Array("usuario_trocar_senha",ServicoHelper::ACESSO,"Alterar Senha",1),
		91=>Array("usuario_trocar_senha_salvar",ServicoHelper::ACESSO,"",0),
		92=>Array("usuario_lista",ServicoHelper::ACESSO,"Listar Usuários",1),
		93=>Array("usuario_resetar_senha",ServicoHelper::ACESSO,"",0),
		94=>Array("usuario_desativar",ServicoHelper::ACESSO,"",0),
		95=>Array("criar_usuario",ServicoHelper::ACESSO,"",0),
		96=>Array("criar_usuario_salvar",ServicoHelper::ACESSO,"",0),
		
		// Dashboards
		120=>Array("dashboard_Acesso",ServicoHelper::ACESSO,"Dashboard",0),
		121=>Array("dashboard_Gerencia",ServicoHelper::GERENTE,"Dashboard",0),
		122=>Array("dashboard_Inquilino",ServicoHelper::INQUILINO,"Dashboard",0),
		123=>Array("dashboard_Proprietario",ServicoHelper::PROPRIETARIO,"Dashboard",0),
	];
	
	public function __construct(){
		$this->nome_servicos = Array(
			ServicoHelper::MODULO_GERENCIA =>"Gerência",
			ServicoHelper::MODULO_PRINCIPAL =>"Principal",
			ServicoHelper::MODULO_PROPRIETARIO =>"Proprietário",
			ServicoHelper::MODULO_INQUILINO =>"Inquilino",
			ServicoHelper::MODULO_ACESSO =>"Acesso"
		);
	}	
	
	public function maskServico($servico)
	{
		if(isset($this->nome_servicos[$servico]))
			return $this->nome_servicos[$servico];
		else
			return "";
	}
	
	public function renderMenuModulo($modulo,$data)
	{
		if(is_array($data["menu_services"]))
		{
			if($modulo==ServicoHelper::MODULO_PRINCIPAL)
			{
				echo '<nav id="menu-left">';
				echo '<h1>Dashboard</h1>';
				echo '</nav>';
			}
			else if(array_key_exists($modulo,$data["menu_services"]) && !empty($data["menu_services"][$modulo]))
			{
				$srv_list = $data["menu_services"][$modulo];
				if(!empty($srv_list))
				{
					echo '<nav id="menu-left">';
					echo '<h1>'.$this->maskServico($modulo).'</h1>';
					echo '<ul>';
					
					foreach($srv_list as $srv)
					{
						echo '<li><a href="?action='.$srv["acao"].'&module='.$modulo.'">'.$srv["nome"].'</a></li>';
					}
					
					echo '</ul></nav>';
				}
			}
		}
	}
	
	public function getIconeServico($modulo)
	{
		$img = "<img src='app/views/style/img/";
		
		if($modulo==ServicoHelper::MODULO_PRINCIPAL)
			$img .= "dashboard";
		else if($modulo==ServicoHelper::MODULO_GERENCIA)
			$img .= "management";
		else if($modulo==ServicoHelper::MODULO_INQUILINO)
			$img .= "inq";
		else if($modulo==ServicoHelper::MODULO_PROPRIETARIO)
			$img .= "prop";
		else if($modulo==ServicoHelper::MODULO_ACESSO)
			$img .= "access";
		else
			return "";
			
		$img .= "_icon.png' />";
		
		return $img;
	}
	
	public function generateServiceTable()
	{
		
	
		DaoEntity::doQuery("CREATE TABLE IF NOT EXISTS `servico` ( `id` int(11) NOT NULL AUTO_INCREMENT, `acao` varchar(100) NOT NULL, `modulo` varchar(100) NOT NULL, `nome` varchar(120) NOT NULL, `hasMenuItem` tinyint(1) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `acao` (`acao`)) ;");

		foreach($this->_ACOES as $key=>$servico)
		{
			DaoEntity::doQuery("insert into servico (id,acao,modulo,nome,hasMenuItem) values (".($key+1).",'".$servico[0]."','".$servico[1]."','".$servico[2]."',".$servico[3].");");
		}
		
		return TRUE;
	}
	
	public function createUserWithProfile($userId, $profile, $nomeTabela)
	{
	
		echo "delete from $nomeTabela where id_usuario=$userId;<br/><br/>";
		
		if($profile==ServicoHelper::ADMINISTRADOR)
		{
			foreach($this->_ACOES as $idServico=>$value)
			{
				echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,".($idServico+1).");";
				echo "<br/>";
			}
			
		}
		else if($profile==ServicoHelper::PROPRIETARIO)
		{
			for($i=60;$i<=66;$i++)
				echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,".($i+1).");<br/>";
				
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,121);<br/>";
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,124);<br/>";
			
		}
		
		else if($profile==ServicoHelper::INQUILINO)
		{
			for($i=28;$i<=35;$i++)
				echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,".($i+1).");<br/>";
			
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,121);<br/>";
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,123);<br/>";
			
		}
		else if($profile==ServicoHelper::GERENTE)
		{
			for($i=0;$i<=17;$i++)
				echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,".($i+1).");<br/>";
			for($i=44;$i<=48;$i++)
				echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,".($i+1).");<br/>";
			
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,121);<br/>";
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,122);<br/>";
			
		}
		
		if($profile!=ServicoHelper::ADMINISTRADOR)
		{
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,91);<br/>";
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,92);<br/>";
			echo "insert into $nomeTabela (id_usuario,id_servico) values ($userId,94);<br/>";
		}
	}
	
	public static function associarServicos($usuario)
	{
		Loader::static_load(Array("MODEL"=>"ServicoModel"));
		
		$profile = $usuario->getPerfil();
		
		if($profile==ServicoHelper::PROPRIETARIO)
		{
			for($i=60;$i<=66;$i++)
				DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>$i+1)));
			DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>124)));
		}
		else if($profile==ServicoHelper::INQUILINO)
		{
			for($i=28;$i<=35;$i++)
				DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>$i+1)));
			DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>123)));
		}
		else if($profile==ServicoHelper::GERENTE)
		{
			for($i=0;$i<=17;$i++)
				DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>$i+1)));
			for($i=44;$i<=48;$i++)
				DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>$i+1)));

			for($i=92;$i<=96;$i++)
				DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>$i+1)));
			
			DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>122)));
								
		}
	
		DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>91)));
		DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>92)));

		DaoEntity::associateObjects($usuario, new ServicoModel(Array("id"=>121)));
	}
}
?>
