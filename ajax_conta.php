<?php
	if(!isset($_POST['acao']) || !is_numeric($_POST['acao'])){
		die;
	}

	require_once "controller/conta.php";

	switch ($_POST['acao']) {
		case 1: // Deletar conta
			$conta = New ContaController();
			echo $conta->deletar($_POST['estabelecimento'], $_POST['conta']);
		break;
	}
?>