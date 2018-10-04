<?php
	if(!isset($_POST['acao']) || !is_numeric($_POST['acao'])){
		die;
	}

	require_once "controller/estabelecimento.php";

	switch ($_POST['acao']) {
		case 1: // modal estabelecimento
			require_once "modal_estabelecimento.php";
		break;

		case 2: // Altera ou cadastra o estabelecimento
			if (!isset($_POST['idEstabelecimento']) || !is_numeric($_POST['idEstabelecimento'])) {
				die(-1);
			}

			$estabelecimento = New EstabelecimentoController();
			echo $estabelecimento->verificarAlterarCadastrar();
		break;

		case 3:
			echo EstabelecimentoController::listarEstabelecimentos();
		break;

		case 4: // Buscar dados
			if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
				die(-1);
			}

			$estabelecimento = New EstabelecimentoController();
			echo json_encode($estabelecimento->buscarDados($_POST['id']));
		break;
	}
?>