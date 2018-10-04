<?php
	require_once "model/estado.php";

	class EstadoController{

		static function listarEstados($marcar = null){
			$estado = New Estado();

			$options = "<option value=\"0\">Selecione</option>";

			foreach ($estado->listarEstados() as $v) {
				$options .=	"<option value=\"".$v['sigla']."\" ".($v['sigla'] == $marcar ? "selected=\"\"" : "").">".$v['estado']."</option>";
			}

			return $options;
		}
	}
?>