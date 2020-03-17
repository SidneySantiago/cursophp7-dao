<?php 

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	// Usuario
	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
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
			$this->setData($results[0]);
		}
	}
 	
 	// Lista varios usuarios 
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM  tb_usuarios ORDER BY deslogin;"); 
	}
	// lista para uma busca
	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM  tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%" )); 
	}
	
	// função para fazer um login
	public function login($usuario,$senha){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			':LOGIN'=>$usuario, 
			':PASSWORD'=>$senha
		));
		if (count($results) > 0){
			$this->setData($results[0]);
		} 
		else{
			throw new Exception("Login e/ou usuario invalidos");
		}
	}

// Busca por um usuario a partir da ID
	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
public function setData($data){
	$this->setIdusuario($data['idusuario']);
	$this->setDeslogin($data['deslogin']);
	$this->setDessenha($data['dessenha']);
	$this->setDtcadastro(new DateTime($data['dtcadastro']));

}


// Inserções no BD
	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()	
		));
		if(count($results) > 0) {
			$this->setData($results[0]);
		}
	}

}





?>