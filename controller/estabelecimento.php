<?php
	require_once "model/estabelecimento.php";
	require_once "controller/conta.php";

	class EstabelecimentoController{

		static function listarEstabelecimentos(){
			$estabelecimento = New Estabelecimento();

			$html = 	"<table width=\"100%\">
							<thead>
								<tr>
									<th align=\"left\">Razão Social</th>
									<th align=\"left\">Nome fantasia</th>
									<th align=\"left\">CNPJ</th>
									<th align=\"left\">Categoria</th>
									<th align=\"left\">Ag Cc</th>
								</tr>
							</thead>
							<tbody>";
			$e = $estabelecimento->listarEstabelecimentos();
			if ($e) {
				foreach ($e as $v) {
					$html .=	"<tr id=\"trEstabelecimento".$v['id']."\">
									<td>".$v['razaoSocial']."</td>
									<td>".$v['nomeFantasia']."</td>
									<td>".$v['cnpj']."</td>
									<td>".$v['categoria']."</td>
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
				$d->razaoSocial = $d->nomeFantasia = $d->cnpj = $d->email = $d->rua = $d->numero = 
				$d->complemento = $d->cidade = $d->dataCadastro = $d->horaCadastro = "";
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

			if (isset($_POST['txtAgencia']) && isset($_POST['txtConta'])) {
				$conta = New ContaController();
				return $conta->alterarContas($estabelecimento->getId(), $_POST['txtAgencia'], $_POST['txtConta']);
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