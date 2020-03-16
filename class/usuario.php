<?php 

class Usuario{

	private $idusuario;
	private $deslogin;
	private $desenha;
	private $dtcadastro;
	// Usuario
	public function getUsuario(){
		return $this->idusuario;
	}
	public function setUsuario($value){
		$this->idusuario = $value;
	}
	// Login
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		$this->deslogin = $value;
	}
	// Senha 
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}
	// Cadastro
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}
	// Metodo para carregar pelo ID

	public function loadById($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
		if (count($results) > 0){
			$row = $results[0];
			$this->setUsuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}
	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getUsuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}



}





?>