<?php 

require_once("config.php");

/* Apenas um select simples : antes da classe usuário
$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);
*/

$us = new Usuario();
$us->loadById(43);
echo $us;

?>