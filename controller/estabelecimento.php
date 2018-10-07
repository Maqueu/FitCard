<?php
	require_once "model/estabelecimento.php";
	require_once "controller/conta.php";

	class EstabelecimentoController{

		static function listarEstabelecimentos($status = 1){
			$estabelecimento = New Estabelecimento();
			$estabelecimento->setAtivo($status);

			$html = 	"<table width=\"100%\" id=\"tblEstabelecimento\">
							<thead>
								<tr>
									<th align=\"left\" width=\"50%\" class=\"tresPontinhos\">Razão Social</th>
									<th align=\"left\" width=\"50%\" class=\"tresPontinhos\">Nome fantasia</th>
									<th align=\"left\" width=\"160\" class=\"tresPontinhos\">CNPJ</th>
									<th align=\"left\" width=\"130\" class=\"tresPontinhos\">Categoria</th>
									<th align=\"left\" width=\"130\">Ag Cc</th>
								</tr>
							</thead>
							<tbody>";
			$e = $estabelecimento->listarEstabelecimentos();
			if ($e) {
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td class=\"tresPontinhos\">".$v['razaoSocial']."</td>
									<td class=\"tresPontinhos\">".$v['nomeFantasia']."</td>
									<td class=\"tresPontinhos\">".$v['cnpj']."</td>
									<td class=\"tresPontinhos\">".$v['categoria']."</td>
									<td>".$v['contas']."</td>
								</tr>";
				}
			}
			else{
				$html .= 		"<tr>
									<td colspan=\"5\" align=\"center\">Nenhum estabelecimento encontrado</td>
								</tr>";
			}

			$html .= 		"</tbody>
						</table>";

			return $html;
		}

		function buscarDados($id = 0){
			if ($id == 0) {
				$d = New StdClass();
				$d->siglaEstado = "0";
				$d->ativo = 1;
				$d->idCategoria = null;
				$d->razaoSocial = $d->nomeFantasia = $d->cnpj = $d->email = $d->rua = $d->numero = 
				$d->complemento = $d->cidade = $d->dataCadastro = $d->horaCadastro = $d->telefone = "";
			}
			else{
				$estabelecimento = New Estabelecimento();
				$estabelecimento->setId($id);
				$d = $estabelecimento->buscarDados();
			}

			return $d;
		}

		function verificarAlterarCadastrar(){
			if (trim($_POST['txtRazao']) == '' || trim($_POST['txtCNPJ']) == '') {
				die("Falta dados");
			}

			require_once 'controller/cnpj.php';
			if (!CNPJ::validar($_POST['txtCNPJ'])) {
				die("CNPJ inválido");
			}

			$razao = strtolower(trim($_POST['txtRazao']));
			$fantasia = strtolower(trim($_POST['txtFantasia']));

			$erro = $this->validarDuplicados($_POST['idEstabelecimento'], $_POST['txtCNPJ'], $razao, $fantasia);
			if ($erro) {
				die($erro);
			}

			$email = strtolower(trim($_POST['txtEmail']));
			$rua = strtolower(trim($_POST['txtRua']));
			$numero = strtolower(trim($_POST['txtNumero']));
			$complemento = strtolower(trim($_POST['txtComplemento']));
			$cidade = strtolower(trim($_POST['txtCidade']));
			$telefone = (strlen($_POST['txtTelefone']) < 14 ? null : $_POST['txtTelefone']);

			$estabelecimento = New Estabelecimento();
			$estabelecimento->setEstado(($_POST['selEstado'] ? $_POST['selEstado'] : null));
			$estabelecimento->setCategoria(($_POST['selCategoria'] ? $_POST['selCategoria'] : null));
			$estabelecimento->setCNPJ($_POST['txtCNPJ']);
			if ($razao) {
				$estabelecimento->setRazao($razao);
			}
			if ($fantasia) {
				$estabelecimento->setFantasia($fantasia);
			}
			if ($email) {
				$estabelecimento->setEmail($email);
			}
			if ($rua) {
				$estabelecimento->setRua($rua);
			}
			if ($numero) {
				$estabelecimento->setNumero($numero);
			}
			if ($complemento) {
				$estabelecimento->setComplemento($complemento);
			}
			if ($cidade) {
				$estabelecimento->setCidade($cidade);
			}
			if ($telefone) {
				$estabelecimento->setTelefone($telefone);
			}

			if ($_POST['idEstabelecimento'] == 0) {
				$estabelecimento->cadastrar();
				$id = $estabelecimento->buscarId();
				if (!isset($id->id)) {
					die("Erro ao cadastrar contas");
				}
				$estabelecimento->setId($id->id);
			}
			else{
				$estabelecimento->setId($_POST['idEstabelecimento']);
				$estabelecimento->alterar();

			}

			if (isset($_POST['txtAgencia']) && isset($_POST['txtConta']) && isset($_POST['idConta'])) {
				$conta = New ContaController();
				return 	$conta->alterarContas(
							$estabelecimento->getId(),
							$_POST['idConta'],
							$_POST['txtAgencia'],
							$_POST['txtConta']
						);
			}
			return 1;

		}

		function validarDuplicados($id, $cnpj, $razao, $fantasia){
			$estabelecimento = New Estabelecimento();
			$estabelecimento->setId($id);
			$estabelecimento->setCNPJ($cnpj);
			if ($razao) {
				$estabelecimento->setRazao($razao);
			}
			if ($fantasia) {
				$estabelecimento->setFantasia($fantasia);
			}

			$erro = $estabelecimento->validarDuplicados();
			if (!$erro) {
				return 0;
			}
			else{
				if (isset($erro->erro)) {
					switch ($erro->erro) {
						case 1:
							return "CNPJ duplicado";
						break;

						case 2:
							return "Razão social e Nome fantasia duplicados";
						break;
						
						default:
							return "Erro ao validar dados";
						break;
					}
				}
			}
		}

		function alterarStatus($id){
			$estabelecimento = New Estabelecimento();
			$estabelecimento->setId($id);

			return $estabelecimento->alterarStatus();
		}
	}
?>