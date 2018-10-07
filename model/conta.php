<?php
	require_once "controller/conn.php";

	class Conta{

		private $id;
		private $agencia;
		private $conta;
		private $estabelecimento;

		function setId($id){$this->id = $id;}
		function getId(){return $this->id;}

		function setAgencia($agencia){$this->agencia = $agencia;}
		function getAgencia(){return $this->agencia;}

		function setConta($conta){$this->conta = $conta;}
		function getConta(){return $this->conta;}

		function setEstabelecimento($estabelecimento){$this->estabelecimento = $estabelecimento;}
		function getEstabelecimento(){return $this->estabelecimento;}

		function alterarContas(){
			if ($this->agencia && is_array($this->agencia) && 
				$this->conta && is_array($this->conta) && 
				$this->id && is_array($this->id)) {

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

				$sql_updConta = "UPDATE fit_contas 
									SET agencia = :agencia,
										conta = :conta
									WHERE id = :id AND idEstabelecimento = :estabelecimento";

				global $conn;
				$que_addConta = $conn->prepare($sql_addConta);
				$que_addConta->bindParam('estabelecimento', $this->estabelecimento, PDO:: PARAM_INT);

				$que_updConta = $conn->prepare($sql_updConta);
				$que_updConta->bindParam('estabelecimento', $this->estabelecimento, PDO:: PARAM_INT);


				foreach ($this->conta as $k => $v) {
					if ($this->id[$k] == 0) {
						$que_addConta->bindParam('agencia', $this->agencia[$k], PDO:: PARAM_STR);
						$que_addConta->bindParam('conta', $this->conta[$k], PDO:: PARAM_STR);

						if (!$que_addConta->execute()) {
							die("Erro ao cadastrar contas");
						}
					}
					else{
						$que_updConta->bindParam('agencia', $this->agencia[$k], PDO:: PARAM_STR);
						$que_updConta->bindParam('conta', $this->conta[$k], PDO:: PARAM_STR);
						$que_updConta->bindParam('id', $this->id[$k], PDO:: PARAM_INT);

						if (!$que_updConta->execute()) {
							die("Erro ao alterar contas");
						}
					}
				}

				return 1;
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

		function deletar(){
			$sql_delConta = "DELETE FROM fit_contas WHERE idEstabelecimento = :estabelecimento AND id = :id";

			global $conn;
			$que_delConta = $conn->prepare($sql_delConta);
			$que_delConta->bindParam('estabelecimento', $this->estabelecimento, PDO:: PARAM_INT);
			$que_delConta->bindParam('id', $this->id, PDO:: PARAM_INT);

			if ($que_delConta->execute()) {
				return 1;
			}
		}
	}
?>