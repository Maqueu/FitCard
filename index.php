<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Testeeeee</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	</head>
	<body>
		<style type="text/css">
			body{
				margin: 8px;
			}

			#tblEstabelecimento thead th, .titulo, .topoFixo thead th{
				color: #159957;
				font-style: italic;
				font-weight: 900;
				padding-bottom: 5px;
			}

			#tblEstabelecimento thead th, .topoFixo thead th{
				border-bottom: 1px solid #159957;
			}

			#tblEstabelecimento tr{
				cursor: pointer !important;
			}

			.col-md-6, .col-md-5{
				margin-bottom: 15px;
			}

			#tblEstabelecimento tr td{
				/*border-bottom: 1px solid black;*/
				border-bottom: 1px solid rgba(165, 35, 26);
				padding-bottom: 5px;
			}

			#tblEstabelecimento tr td:first-child, #tblEstabelecimento tr td:first-child + td{
				max-width: 1px;
			}

			#tblEstabelecimento tr{
				transition: background-color 0.7s, color 0.7s;
				-webkit-transition: background-color 0.7s, color 0.7s;
				-moz-transition: background-color 0.7s, color 0.7s;
				-ms-transition: background-color 0.7s, color 0.7s;
				-o-transition: background-color 0.7s, color 0.7s;
			}

			#tblEstabelecimento tbody tr:hover{
			    background-color: rgba(255, 79, 78, 0.5);
			    color: white;
			    /*background-color: rgba(165, 35, 26, 0.2);*/
			}

			.agenciaConta{
				/*border-bottom: 1px solid rgba(0, 0, 0, 0.4);*/
				border-bottom: 1px solid rgba(165, 35, 26, 0.3);
			    max-width: 130px;
			    transition: border-bottom 0.7s;
				-webkit-transition: border-bottom 0.7s;
				-moz-transition: border-bottom 0.7s;
				-ms-transition: border-bottom 0.7s;
				-o-transition: border-bottom 0.7s;
			}

			tr:hover .agenciaConta{
				border-bottom: 1px solid white;
			}

			.agenciaConta:last-child{
				border: none;
			}

			.tresPontinhos{
				text-overflow: ellipsis;
			    white-space: nowrap;
			    overflow-x: hidden;
			}

			#listaEstabelecimento{
				overflow-x: auto;
			}

			.modal-header{
			    background-color: #a5231a;
			    background: linear-gradient(120deg, #ff4f4f, #b57979);
			    -webkit-background: linear-gradient(120deg, #ff4f4f, #b57979);
			    -moz-background: linear-gradient(120deg, #ff4f4f, #b57979);
			    -ms-background: linear-gradient(120deg, #ff4f4f, #b57979);
			    -o-background: linear-gradient(120deg, #ff4f4f, #b57979);
			    color: white;
			}

			#filtro{
				margin: 15px 0;
			}

			.topoFixo table{
				table-layout: fixed;
			}
			.topoFixo{
				overflow-x: scroll;
				position: fixed;
				top: 0;
				right: 8px;
				left: 8px;
				background-color: white;
			    box-shadow: 0 3px 2px 0 #074828;
			}



.topoFixo::-webkit-scrollbar {
	height: 0px !important;
}
.topoFixo::-moz-scrollbar {
	height: 0px !important;
}
.topoFixo::-ms-scrollbar {
	height: 0px !important;
}
.topoFixo::-o-scrollbar {
	height: 0px !important;
}





::-webkit-scrollbar {
    width: 10px;
    height: 12px;
}
::-webkit-scrollbar-thumb {
    background-color: #159957;
    border-radius: 20px;
    box-shadow: 1px -2px 0 black, 1px 2px 0 black;
}
::-webkit-scrollbar-track {
    background-color: #074023;
}
::-webkit-scrollbar-button{
	background: #159957;
}



::-moz-scrollbar {
    width: 10px;
    height: 12px;
}
::-moz-scrollbar-thumb {
    background-color: #159957;
    border-radius: 20px;
    box-shadow: 1px -2px 0 black, 1px 2px 0 black;
}
::-moz-scrollbar-track {
    background-color: #074023;
}
::-moz-scrollbar-button{
	background: #159957;
}



::-ms-scrollbar {
    width: 10px;
    height: 12px;
}
::-ms-scrollbar-thumb {
    background-color: #159957;
    border-radius: 20px;
    box-shadow: 1px -2px 0 black, 1px 2px 0 black;

}
::-ms-scrollbar-track {
    background-color: #074023;
}
::-ms-scrollbar-button{
	background: #159957;
}



::-o-scrollbar {
    width: 10px;
    height: 12px;
}
::-o-scrollbar-thumb {
    background-color: #159957;
    border-radius: 20px;
    box-shadow: 1px -2px 0 black, 1px 2px 0 black;
}
::-o-scrollbar-track {
    background-color: #074023;
}
::-o-scrollbar-button{
	background: #159957;
}


		</style>
		<h1 align="center" class="titulo">Controle de estabelecimentos</h1>
		<?php
			require_once "controller/estabelecimento.php";
			require_once "controller/estado.php";
		?>

		<div align="right" id="filtro">
			<label for="selStatus">Listar: </label>
			<select id="selStatus" name="selStatus" class="form-control" style="width: auto; display: inline-block;">
				<option value="1">Ativos</option>
				<option value="0">Inativos</option>
				<option value="-1">Todos</option>
			</select>
			<button type="button" id="btnNovo" class="btn btn-success">Novo</button>
		</div>

		<div id="listaEstabelecimento">
			<?= EstabelecimentoController::listarEstabelecimentos() ?>
		</div>

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/sweetalert2.js"></script>
		<script type="text/javascript" src="js/jquery.mask.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

		<script type="text/javascript">
			$(() => copiarTopo());
			$(window).resize(() => corrigirTopoFixo())

			function corrigirTopoFixo(){
				i = 1;
				$('#tblEstabelecimento thead th').each(function(){
					$('.topoFixo thead th:nth-child('+i+')').css({width: $(this).width() + 2});
					i ++;
				})
			}

			function copiarTopo(){
				$('.topoFixo').remove();
				$('#tblEstabelecimento').before("<div class=\"topoFixo\" hidden=\"\">"+
													"<table width=\"100%\">"+
														"<thead>"+
															$('#tblEstabelecimento thead').clone().html()+
														"</thead>"+
													"</table>"+
												"</div>");
				corrigirTopoFixo();
			}

			$('body').on('click', '[id^="trEstabelecimento"]', function(){
				exibirEstabelecimento($(this).attr('id').substring($(this).attr('id').lastIndexOf('o') + 1));
			})

			$('#btnNovo').click(() => exibirEstabelecimento(0));
			$('#selStatus').change(() => atualizarEstabelecimentos());

			function mascaraAgenciaConta(){
				$('[name^="txtAgencia"]').mask('999-9');
				$('[name^="txtConta"]').mask('99.999-9');
			}

			function exibirEstabelecimento(id){
				$('#titleModal').html('Dados estabelecimento')
				$('#footerModal').html('');
				$('#modal').modal('show');
				$.ajax({
					type: 'post',
					url: 'ajax_estabelecimento.php',
					data: 'acao=1&id=' + id,
					success: (modal) => {
						$('#bodyModal').html(modal);
						$('#footerModal').html(	"<button type=\"button\" class=\"btn\" id=\"btnAlterarStatus\"></button>" + 
												"<button type=\"button\" class=\"btn btn-primary\" id=\"btnSalvar\"></button>")
						mascaraAgenciaConta();
					}
				})
			}

			function atualizarEstabelecimentos(){
				$.ajax({
					type: 'post',
					url: 'ajax_estabelecimento.php',
					data: 'acao=3&' + $('#selStatus').serialize(),
					success: (html) => {
						$('#listaEstabelecimento').html(html)
						setTimeout(function() {
							copiarTopo();
						}, 100);
					}
				})	
			}

			$(window).scroll(function(){
				if ($(this).scrollTop() >= $('#tblEstabelecimento').offset().top) {
					$('.topoFixo').removeAttr('hidden');
				}
				else{
					$('.topoFixo').attr('hidden', '');
				}
			});

			$('#listaEstabelecimento').on('scroll', function(){
				$('.topoFixo').scrollLeft($(this).scrollLeft());
			});
		</script>
	</body>

	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" align="center" id="titleModal"></h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true" style="color: white;">&times;</span>
		        	</button>
		      	</div>
		      	<div class="modal-body" id="bodyModal"></div>
		      	<div class="modal-footer" id="footerModal">
		      		
		      	</div>
	    	</div>
	  	</div>
	</div>
</html>