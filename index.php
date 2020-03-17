<?php 

require_once("config.php");

/* Apenas um select simples : antes da classe usuário
$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);
*/
/** Um usuarios apenas pelo ID
$us = new Usuario();
$us->loadById(46);
echo $us;
/**/
// Carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista); 

// Carrega um liste ususarios por login
//$search = Usuario::search("AA");
//echo json_encode($search);

// Carrega o ususario usando login e senha

$usuario = new Usuario();
$usuario->login("AA", "11");
echo $usuario;


?>