<?php
	require_once "model/conta.php";

	class ContaController{

		function alterarContas($estabelecimento, $agencia, $contaP){
			$conta = New Conta();
			$conta->setAgencia($agencia);
			$conta->setConta($contaP);
			$conta->setEstabelecimento($estabelecimento);

			return $conta->alterarContas();
		}

		static function listarContas($id){
			$conta = New Conta();
			$conta->setEstabelecimento($id);

			$contas = $conta->listarContas();
			$html = "";
			if ($contas) {
				foreach ($contas as $v) {
					$modelo = file_get_contents('modelo_agencia_conta.html');
					$modelo = str_replace('@id', $v['id'], $modelo);
					$modelo = str_replace('@agencia', $v['agencia'], $modelo);
					$modelo = str_replace('@conta', $v['conta'], $modelo);

					$html .= $modelo;
				}
			}

			return $html;
		}
	}
?>