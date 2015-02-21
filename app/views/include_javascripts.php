		<script type="text/javascript" src="app/views/js/jquery-1.8.0.min.js"></script>
		<script type="text/javascript" src="app/views/js/jquery-ui-1.8.23.custom.min.js"></script>
		<script type="text/javascript" src="app/views/js/jquery.dataTables.js"></script>
		
		<script type="text/javascript">
			function confirmar()
			{
				return window.confirm("Deseja realmente fazer isto?");
			}
		
			function select(tr)
			{
				if(tr.className!="selected") tr.className = "selected";
				else tr.className = "";
			}
			
			$(document).ready(function() {
				$('.tbl').dataTable(
					{
						<?php if(array_key_exists("sorting",$this->data)) echo "'aaSorting': [[".$this->data["sorting"]["column"].",'".$this->data["sorting"]["order"]."']],"; ?>
						'oLanguage': {
							'sUrl' : 'app/views/js/dataTables.pt-br.txt'
						}
					}
				);
			} );
		</script>