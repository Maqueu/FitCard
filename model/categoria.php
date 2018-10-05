<?php
	require_once "controller/conn.php";

	class Categoria{
		function listarCategorias(){
			$sql_selCategorias = "SELECT 	id, 
											categoria
										FROM fit_categorias
									    ORDER BY categoria";

			global $conn;
			$que_selCategorias = $conn->prepare($sql_selCategorias);
			$que_selCategorias->execute();

			return $que_selCategorias->fetchAll();
		}
	}
?>