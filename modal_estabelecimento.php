<?php
	require_once "controller/estabelecimento.php";
	require_once "controller/estado.php";
	require_once "controller/categoria.php";
	require_once "controller/conta.php";
	$estabelecimento = New EstabelecimentoController();
	$id = (isset($_POST['id']) && is_numeric($_POST['id']) ? $_POST['id'] : 0);
	$d = $estabelecimento->buscarDados($id);

	if (!$d) {
		die("<h3 align=\"center\">Erro ao buscar estabelecimento</h3>");
	}
?>
<form id="frmEstabelecimento">
	<input type="hidden" name="acao" value="2">
	<input type="hidden" name="idEstabelecimento" value="<?= $id ?>">
	<div>
		<label for="selEstado">Estado</label>
		<select id="selEstado" name="selEstado">
			<?= EstadoController::listarEstados($d->siglaEstado) ?>
		</select>
	</div>
	<div>
		<label for="txtRazao">Razao Social</label>
		<input type="text" name="txtRazao" id="txtRazao" value="<?= $d->razaoSocial ?>">
	</div>
	<div>
		<label for="txtFantasia">Nome Fantasia</label>
		<input type="text" name="txtFantasia" id="txtFantasia" value="<?= $d->nomeFantasia ?>">
	</div>
	<div>
		<label for="txtCNPJ">CNPJ</label>
		<input type="text" name="txtCNPJ" id="txtCNPJ" value="<?= $d->cnpj ?>">
	</div>
	<div>
		<label for="selCategoria">Categoria</label>
		<select id="selCategoria" name="selCategoria">
			<?= CategoriaController::listarCategorias($d->idCategoria) ?>
		</select>
	</div>
	<div>
		<label for="txtEmail">E-mail</label>
		<input type="email" name="txtEmail" id="txtEmail" value="<?= $d->email ?>">
	</div>
	<div>
		<label for="txtRua">Rua</label>
		<input type="text" name="txtRua" id="txtRua" value="<?= $d->rua ?>">
	</div>
	<div>
		<label for="txtNumero">Numero</label>
		<input type="text" name="txtNumero" id="txtNumero" value="<?= $d->numero ?>">
	</div>
	<div>
		<label for="txtComplemento">Complemento</label>
		<input type="text" name="txtComplemento" id="txtComplemento" value="<?= $d->complemento ?>">
	</div>
	<div>
		<label for="txtCidade">Cidade</label>
		<input type="text" name="txtCidade" id="txtCidade" value="<?= $d->cidade ?>">
	</div>
	<hr>
	<div id="listaContas">
		<?php
			if ($id != 0) {
				echo ContaController::listarContas($id);
			}
		?>
	</div>
	<button type="button" id="btnConta">+ Conta</button>
	<button type="button" id="btnSalvar"><?= ($id == 0 ? "Cadastrar" : "Alterar") ?></button>
	<?php
		if ($id != 0) { ?>
			<button type="button" id="btnAlterarStatus"><?= ($d->ativo ? "Deletar" : "Reativar") ?></button>
	<?php
		}
	?>
</form>
<div id="modeloConta" hidden="">
	<?php
		$htmlConta = file_get_contents('modelo_agencia_conta.html');
		$htmlConta = str_replace('@id', 0, $htmlConta);
		$htmlConta = str_replace('@agencia', '', $htmlConta);
		$htmlConta = str_replace('@conta', '', $htmlConta);

		echo $htmlConta;
	?>
</div>
<?php
	if ($d->dataCadastro && $d->horaCadastro) { ?>
		<div>Cadastrado: <?= date('d/m/Y', strtotime($d->dataCadastro)) ?> às <?= date('H:i:s', strtotime($d->horaCadastro)) ?></div>
<?php
	}
?>

<script type="text/javascript">
	$('#btnSalvar').click(function(){
		$.ajax({
			type: 'post',
			url: 'ajax_estabelecimento.php',
			data: $('#frmEstabelecimento').serialize(),
			success: (erro) => {
				if (erro == 1) {
					$('#modal').html('');
					atualizarEstabelecimentos();
				}
				else{
					alert(erro)
				}
			}
		})
	});

	$('#btnAlterarStatus').click(function(){
		$.ajax({
			type: 'post',
			url: 'ajax_estabelecimento.php',
			data: 'acao=5&id=' + <?= $id ?>,
			success: (erro) => {
				if (erro == 1) {
					$('#modal').html('');
					atualizarEstabelecimentos();
				}
				else{
					alert(erro)
				}
			}
		})
	})

	$('#btnConta').click(() => addConta());
	addConta = () => $('#listaContas').append($('#modeloConta').html());

	$('body').on('click', '.btnRemover', function(){
		$(this).parent('.remover').remove();
	})
</script>