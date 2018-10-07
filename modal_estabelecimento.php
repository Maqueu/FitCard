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
	<div class="row">
		<input type="hidden" name="acao" value="2">
		<input type="hidden" name="idEstabelecimento" value="<?= $id ?>">
		<div class="col-md-6">
			<label for="txtRazao">Razao Social</label>
			<input type="text" class="form-control" name="txtRazao" id="txtRazao" value="<?= $d->razaoSocial ?>">
		</div>
		<div class="col-md-6">
			<label for="txtFantasia">Nome Fantasia</label>
			<input type="text" class="form-control" name="txtFantasia" id="txtFantasia" value="<?= $d->nomeFantasia ?>">
		</div>
		<div class="col-md-6">
			<label for="txtCNPJ">CNPJ</label>
			<input type="text" class="form-control" name="txtCNPJ" id="txtCNPJ" value="<?= $d->cnpj ?>">
		</div>
		<div class="col-md-6">
			<label for="selCategoria">Categoria</label>
			<select id="selCategoria" class="form-control" name="selCategoria">
				<?= CategoriaController::listarCategorias($d->idCategoria) ?>
			</select>
		</div>
		<div class="col-md-6">
			<label for="selEstado">Estado</label>
			<select id="selEstado" class="form-control" name="selEstado">
				<?= EstadoController::listarEstados($d->siglaEstado) ?>
			</select>
		</div>
		<div class="col-md-6">
			<label for="txtCidade">Cidade</label>
			<input type="text" class="form-control" name="txtCidade" id="txtCidade" value="<?= $d->cidade ?>">
		</div>
		<div class="col-md-6">
			<label for="txtRua">Rua</label>
			<input type="text" class="form-control" name="txtRua" id="txtRua" value="<?= $d->rua ?>">
		</div>
		<div class="col-md-3">
			<label for="txtNumero">Numero</label>
			<input type="text" class="form-control" name="txtNumero" id="txtNumero" value="<?= $d->numero ?>">
		</div>
		<div class="col-md-3">
			<label for="txtComplemento">Complemento</label>
			<input type="text" class="form-control" name="txtComplemento" id="txtComplemento" value="<?= $d->complemento ?>">
		</div>
		<div class="col-md-6">
			<label for="txtEmail">E-mail</label>
			<input type="email" class="form-control" name="txtEmail" id="txtEmail" value="<?= $d->email ?>">
		</div>
		<div class="col-md-6">
			<label for="txtTelefone">Telefone</label>
			<input type="text" class="form-control" name="txtTelefone" id="txtTelefone" value="<?= $d->telefone ?>">
		</div>
		<hr>
	</div>
	<div id="listaContas">
		<?php
			if ($id != 0) {
				echo ContaController::listarContas($id);
			}
		?>
	</div>
	<button type="button" id="btnConta" class="btn btn-primary">+ Conta</button>
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
		<div align="center" style="font-style: italic;">Cadastrado: <?= date('d/m/Y', strtotime($d->dataCadastro)) ?> às <?= date('H:i:s', strtotime($d->horaCadastro)) ?></div>
<?php
	}
?>

<script type="text/javascript">
	$(() => {
		$('#txtCNPJ').mask('99.999.999/9999-99');
		$('#txtTelefone').mask('(99)99999-9999');
		if (<?= $id ?> == 0) {
			$('#btnAlterarStatus').remove();
			$('#btnSalvar').html("Cadastrar");
		}
		else{
			if (<?= $d->ativo ?>) {
				status = "Deletar";
				btn = "danger"
			}
			else{
				status = "Reativar";
				btn = "success";
			}
			$('#btnAlterarStatus').html(status).addClass('btn-' + btn);
			$('#btnSalvar').html("Alterar");
		}
	});

	function erroFormulario(texto, qual){
		swal({
			title: "Opps...", 
			text: texto,
			type: "error"
		}).then(() => {
			setTimeout(() => qual.focus(), 300);
		})
	}

	function isEmail(email) {
	    var re = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    return re.test(email);
	}

	$('body').off('click', '#btnSalvar').on('click', '#btnSalvar', function(){
		erro = 0;

		if ($('#txtRazao').val().trim() == '') {
			erroFormulario('Preencha a Razão Social', $('#txtRazao'));
			erro = 1;
			return
		}

		if ($('#txtCNPJ').val().length < 18) {
			erroFormulario('Preencha o CNPJ', $('#txtCNPJ'))
			erro = 1;
			return;
		}

		if ($('#txtEmail').val().trim() != '' && !isEmail($('#txtEmail').val().trim())) {
			erroFormulario('E-mail inválido', $('#txtEmail'));
			erro = 1;
			return;
		}

		if ($('#selCategoria').val() == 1 && $('#txtTelefone').val().length < 14) {
			erroFormulario('Preencha o telefone', $('#txtTelefone'));
			erro = 1;
			return;
		}

		$('#listaContas .remover').each(function(){
			if ($(this).find('[name^="txtAgencia"]').val().length < 5) {
				erroFormulario('Preencha a agencia', $(this).find('[name^="txtAgencia"]'));
				erro = 1;
				return;
			}

			if ($(this).find('[name^="txtConta"]').val().length < 8) {
				erroFormulario('Preencha a conta', $(this).find('[name^="txtConta"]'));
				erro = 1;
				return;
			}
		});

		if (erro == 0) {
			$.ajax({
				type: 'post',
				url: 'ajax_estabelecimento.php',
				data: $('#frmEstabelecimento').serialize(),
				success: (erro) => {
					if (erro == 1) {
						// $('#modal').html('');
						$('#modal').modal('hide');
						swal({
							title: "Sucesso",
							text: "Dados " + (<?= $id ?> == 0 ? "cadastrados" : "alterados"),
							type: "success"
						}).then(() => atualizarEstabelecimentos());
					}
					else{
						swal({
							title: "Opps...", 
							text: erro,
							type: "error"
						});
					}
				}
			})
		}
	});

	$('body').off('click', '#btnAlterarStatus').on('click', '#btnAlterarStatus', function(){
		swal({
                title: status,
                text: "Deseja realmente " + status + " este estabelecimento?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não',
            }
        ).then((result) => {
            if (result.value) {
				$.ajax({
					type: 'post',
					url: 'ajax_estabelecimento.php',
					data: 'acao=5&id=' + <?= $id ?>,
					success: (erro) => {
						if (erro == 1) {
							// $('#modal').html('');
							$('#modal').modal('hide')
							atualizarEstabelecimentos();
						}
						else{
							swal({
								title: "Opps...", 
								text: erro,
								type: "error"
							})
						}
					}
				})
            }
        })
	})

	$('#btnConta').click(() => addConta());
	addConta = () => {
		$('#listaContas').append($('#modeloConta').html());
		mascaraAgenciaConta();
	};

	$('body').off('click', '.btnRemover').on('click', '.btnRemover', function(){
		swal({
                title: 'Deletar',
                text: "Deseja realmente deletar esta conta?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não',
            }
        ).then((result) => {
            if (result.value) {
            	idConta = $(this).parents('.remover').find('[name^="idConta"]').val()
            	if (idConta == 0){
					$(this).parents('.remover').remove();
            	}
            	else{
					$.ajax({
						type: 'post',
						url: 'ajax_conta.php',
						data: 'acao=1&estabelecimento=' + <?= $id ?> + '&conta=' + idConta,
						success: (erro) => {
							if (erro == 1) {
								$(this).parents('.remover').remove();
							}
							else{
								swal({
									title: "Opps...", 
									text: erro,
									type: "error"
								})
							}
						}
					})
            	}
            }
        })
	})
</script>