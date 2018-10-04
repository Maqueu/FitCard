<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Testeeeee</title>
	</head>
	<body>
		<h1>Dados</h1>
		<?php
			require_once "controller/estabelecimento.php";
			require_once "controller/estado.php";
		?>

		<button type="button" id="btnNovo">Novo</button>
		<div id="listaEstabelecimento">
			<?= EstabelecimentoController::listarEstabelecimentos() ?>
		</div>

		<hr>

		<h1>Modal</h1>
		<div id="modal"></div>


		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			$('body').on('click', '[id^=trEstabelecimento]', function(){
				exibirEstabelecimento($(this).attr('id').substring($(this).attr('id').lastIndexOf('o') + 1));
			})

			$('#btnNovo').click(() => exibirEstabelecimento(0));

			function exibirEstabelecimento(id){
				$.ajax({
					type: 'post',
					url: 'ajax_estabelecimento.php',
					data: 'acao=1&id=' + id,
					success: (modal) => $('#modal').html(modal)
				})
			}

			function atualizarEstabelecimentos(){
				$.ajax({
					type: 'post',
					url: 'ajax_estabelecimento.php',
					data: 'acao=3',
					success: (html) => $('#listaEstabelecimento').html(html)
				})	
			}
		</script>
	</body>
</html>