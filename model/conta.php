<?php
	require_once "controller/conn.php";

	class Conta{

		private $agencia;
		private $conta;
		private $estabelecimento;

		function setAgencia($agencia){$this->agencia = $agencia;}
		function getAgencia(){return $this->agencia;}

		function setConta($conta){$this->conta = $conta;}
		function getConta(){return $this->conta;}

		function setEstabelecimento($estabelecimento){$this->estabelecimento = $estabelecimento;}
		function getEstabelecimento(){return $this->estabelecimento;}

		function alterarContas(){
			if ($this->agencia && is_array($this->agencia) && $this->conta && is_array($this->conta)) {
				$sql_delContas = "DELETE FROM fit_contas WHERE idEstabelecimento = :estabelecimento";

				global $conn;
				$que_delContas = $conn->prepare($sql_delContas);
				$que_delContas->bindParam('estabelecimento', $this->estabelecimento, PDO:: PARAM_INT);

				if ($que_delContas->execute()) {
					$sql_addConta = "INSERT INTO fit_contas (
															idEstabelecimento,
															agencia,
															conta
														)
													VALUES 	(
																:estabelecimento,
																:agencia,
																:conta
															)";

					$que_addConta = $conn->prepare($sql_addConta);
					$que_addConta->bindParam('estabelecimento', $this->estabelecimento, PDO:: PARAM_INT);

					foreach ($this->conta as $k => $v) {
						$que_addConta->bindParam('agencia', $this->agencia[$k], PDO:: PARAM_STR);
						$que_addConta->bindParam('conta', $this->conta[$k], PDO:: PARAM_STR);

						if (!$que_addConta->execute()) {
							die("Erro ao cadastrar contas");
						}
					}

					return 1;
				}
				else{
					die("Erro ao cadastrar contas");
				}
			}
		}

		function listarContas(){
			$sql_selContas = "SELECT 	id,
										agencia,
										conta
									FROM fit_contas 
									WHERE idEstabelecimento = :id";

			global $conn;
			$que_selContas = $conn->prepare($sql_selContas);
			$que_selContas->bindParam('id', $this->estabelecimento, PDO:: PARAM_INT);

			if ($que_selContas->execute()) {
				return $que_selContas->fetchAll();
			}
		}
	}
?>