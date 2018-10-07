<?php
	require_once "controller/conn.php";

	class Estabelecimento{
		private $id;
		private $razao;
		private $fantasia = null;
		private $email = null;
		private $rua = null;
		private $numero = null;
		private $complemento = null;
		private $telefone = null;
		private $cidade = null;
		private $estado = null;
		private $categoria = null;
		private $cnpj;
		private $ativo;

		function setId($id){$this->id = $id;}
		function getId(){return $this->id;}

		function setRazao($razao){$this->razao = $razao;}
		function getRazao(){return $this->razao;}

		function setFantasia($fantasia){$this->fantasia = $fantasia;}
		function getFantasia(){return $this->fantasia;}

		function setEmail($email){$this->email = $email;}
		function getEmail(){return $this->email;}

		function setRua($rua){$this->rua = $rua;}
		function getRua(){return $this->rua;}

		function setNumero($numero){$this->numero = $numero;}
		function detNumero(){return $this->numero;}

		function setComplemento($complemento){$this->complemento = $complemento;}
		function getComplemento(){return $this->complemento;}

		function setTelefone($telefone){$this->telefone = $telefone;}
		function getTelefone(){return $this->telefone;}

		function setCidade($cidade){$this->cidade = $cidade;}
		function getCidade(){return $this->cidade;}

		function setEstado($estado){$this->estado = $estado;}
		function getEstado(){return $this->estado;}

		function setCategoria($categoria){$this->categoria = $categoria;}
		function getCategoria(){return $this->categoria;}

		function setCNPJ($cnpj){$this->cnpj = $cnpj;}
		function getCNPJ(){return $this->cnpj;}

		function setAtivo($ativo){$this->ativo = $ativo;}
		function getAtivo(){return $this->ativo;}

		function listarEstabelecimentos(){
			$where = ($this->ativo != -1 ? "AND ativo = :ativo" : "");
			$sql_selEstabelecimento = "SELECT 	id,
												razaoSocial,
												nomeFantasia,
										        cnpj,
										        (SELECT categoria FROM fit_categorias c WHERE c.id = e.idCategoria) categoria,
										        (
										        	SELECT 	GROUP_CONCAT(
										        				CONCAT(
										        					'<div class=''agenciaConta tresPontinhos''>', 
										        					agencia, 
										        					' ', 
										        					conta, 
										        					'</div>'
										        				) ORDER BY agencia, conta SEPARATOR ' '
										        			)
										        		FROM fit_contas c 
										        		WHERE c.idEstabelecimento = e.id
										        ) contas
											FROM fit_estabelecimentos e
											WHERE 1 = 1 {$where}
										    ORDER BY razaoSocial";

			global $conn;
			$que_selEstabelecimento = $conn->prepare($sql_selEstabelecimento);
			if ($this->ativo != -1) {
				$que_selEstabelecimento->bindParam('ativo', $this->ativo, PDO:: PARAM_INT);
			}
			$que_selEstabelecimento->execute();

			return $que_selEstabelecimento->fetchAll();
		}

		function buscarDados(){
			$sql_selDados = "SELECT siglaEstado,
									idCategoria,
									razaoSocial,
							        nomeFantasia,
							        cnpj,
							        email,
							        rua,
							        numero,
							        complemento,
							        telefone,
							        cidade,
							        ativo,
							        dataCadastro,
							        horaCadastro
								FROM fit_estabelecimentos
							    WHERE id = :id";

			global $conn;
			$que_selDados = $conn->prepare($sql_selDados);
			$que_selDados->bindParam('id', $this->id, PDO:: PARAM_INT);
			$que_selDados->execute();

			return $que_selDados->fetchObject();
		}

		function alterar(){
			$sql_updEstabelecimento = "UPDATE fit_estabelecimentos SET 	siglaEstado = :estado,
																		idCategoria = :categoria,
																		razaoSocial = :razao,
																		nomeFantasia = :fantasia,
																		cnpj = :cnpj,
																		email = :email,
																		rua = :rua,
																		numero = :numero,
																		complemento = :complemento,
																		telefone = :telefone,
																		cidade = :cidade
																	WHERE id = :id";

			global $conn;
			$que_updEstabelecimento = $conn->prepare($sql_updEstabelecimento);
			$que_updEstabelecimento->bindParam('estado', $this->estado, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('categoria', $this->categoria, PDO:: PARAM_INT);
			$que_updEstabelecimento->bindParam('razao', $this->razao, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('fantasia', $this->fantasia, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('cnpj', $this->cnpj, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('email', $this->email, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('rua', $this->rua, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('numero', $this->numero, PDO:: PARAM_INT);
			$que_updEstabelecimento->bindParam('complemento', $this->complemento, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('telefone', $this->telefone, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('cidade', $this->cidade, PDO:: PARAM_STR);
			$que_updEstabelecimento->bindParam('id', $this->id, PDO:: PARAM_INT);

			if ($que_updEstabelecimento->execute()) {
				return 1;
			}
			return "Erro ao alterar estabelecimento";
		}

		function cadastrar(){
			$dia = date('Y-m-d');
			$hora = date('H:i:s');

			$sql_addEstabelecimento = "INSERT INTO fit_estabelecimentos (
																			siglaEstado,
																			idCategoria,
																			razaoSocial,
																			nomeFantasia,
																			cnpj,
																			email,
																			rua,
																			numero,
																			complemento,
																			telefone,
																			cidade,
																			dataCadastro,
																			horaCadastro
																		) 
																	VALUES 	(
																				:estado,
																				:categoria,
																				:razao,
																				:fantasia,
																				:cnpj,
																				:email,
																				:rua,
																				:numero,
																				:complemento,
																				:telefone,
																				:cidade,
																				:dia,
																				:hora
																			)";

			global $conn;
			$que_addEstabelecimento = $conn->prepare($sql_addEstabelecimento);
			$que_addEstabelecimento->bindParam('estado', $this->estado, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('categoria', $this->categoria, PDO:: PARAM_INT);
			$que_addEstabelecimento->bindParam('razao', $this->razao, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('fantasia', $this->fantasia, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('cnpj', $this->cnpj, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('email', $this->email, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('rua', $this->rua, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('numero', $this->numero, PDO:: PARAM_INT);
			$que_addEstabelecimento->bindParam('complemento', $this->complemento, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('telefone', $this->telefone, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('cidade', $this->cidade, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('dia', $dia, PDO:: PARAM_STR);
			$que_addEstabelecimento->bindParam('hora', $hora, PDO:: PARAM_STR);

			if ($que_addEstabelecimento->execute()) {
				return 1;
			}
			return "Erro ao cadastrar estabelecimento";
		}

		function validarDuplicados(){
			$whereFantasia = ($this->fantasia ? "nomeFantasia = :fantasia" : "nomeFantasia IS NULL");
			$sql_chkDuplicado = "SELECT IF(cnpj = :cnpj, 1, 2) erro
									FROM fit_estabelecimentos
								    WHERE (cnpj = :cnpj OR (razaoSocial = :razao AND {$whereFantasia})) AND id <> :id";

			global $conn;
			$que_chkDuplicado = $conn->prepare($sql_chkDuplicado);
			$que_chkDuplicado->bindParam('cnpj', $this->cnpj, PDO:: PARAM_STR);
			$que_chkDuplicado->bindParam('razao', $this->razao, PDO:: PARAM_STR);
			if ($this->fantasia) {
				$que_chkDuplicado->bindParam('fantasia', $this->fantasia, PDO:: PARAM_STR);
			}
			$que_chkDuplicado->bindParam('id', $this->id, PDO:: PARAM_INT);

			if ($que_chkDuplicado->execute()) {
				return $que_chkDuplicado->fetchObject();
			}
			return -1;
		}

		function buscarId(){
			$sql_selId = "SELECT id FROM fit_estabelecimentos WHERE cnpj = :cnpj";

			global $conn;
			$que_selId = $conn->prepare($sql_selId);
			$que_selId->bindParam('cnpj', $this->cnpj, PDO:: PARAM_STR);

			if ($que_selId->execute()) {
				return $que_selId->fetchObject();
			}
			return -1;
		}

		function alterarStatus(){
			$sql_updStatus = "UPDATE fit_estabelecimentos SET ativo = IF(ativo, 0, 1) WHERE id = :id";

			global $conn;
			$que_updStatus = $conn->prepare($sql_updStatus);
			$que_updStatus->bindParam('id', $this->id, PDO:: PARAM_INT);

			if ($que_updStatus->execute()) {
				return 1;
			}
		}
	}
?>