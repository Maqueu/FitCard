<?php
	require_once "controller/conn.php";

	class Estado{
		function listarEstados(){
			$sql_selEstado = "SELECT	sigla,
										estado,
								        IF(sigla = 'NN', 1, 0) ordenar -- Colocar no ultimo
									FROM fit_estados
								    ORDER BY ordenar, estado;";

			global $conn;
			$que_selEstado = $conn->prepare($sql_selEstado);
			$que_selEstado->execute();

			return $que_selEstado->fetchAll();
		}
	}
?>