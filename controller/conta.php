<?php
	require_once "model/conta.php";

	class ContaController{

		function alterarContas($estabelecimento){
			$conta = New Conta();
			$conta->setAgencia($_POST['txtAgencia']);
			$conta->setConta($_POST['txtConta']);
			$conta->setEstabelecimento($estabelecimento)

			return $conta->alterarContas();
		}
	}
?>