<?php
	require_once "model/categoria.php";

	class CategoriaController{

		static function listarCategorias($marcar = null){
			$categoria = New Categoria();

			$options = "<option value=\"0\">Selecione</option>";

			foreach ($categoria->listarCategorias() as $v) {
				$options .=	"<option value=\"".$v['id']."\" ".($v['id'] == $marcar ? "selected=\"\"" : "").">".$v['categoria']."</option>";
			}

			return $options;
		}
	}
?>