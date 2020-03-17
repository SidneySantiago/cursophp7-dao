<?php 

class Usuario{

	private $idUsuario;
	private $desLogin;
	private $desSenha;
	private $dtCadastro;
	// Usuario
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function setIdUsuario($value): void {
		$this->idUsuario = $value;
	}
	// Login
	public function getDesLogin(){
		return $this->desLogin;
	}
	public function setDesLogin($value): void {
		$this->desLogin = $value;
	}
	// Senha 
	public function getDesSenha(){
		return $this->desSenha;
	}
	public function setDesSenha($value): void {
		$this->desSenha = $value;
	}
	// Cadastro
	public function getDtCadastro(){
		return $this->dtCadastro;
	}
	public function setDtCadastro($value):void {
		$this->dtCadastro = $value;
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
	// Carrega os dados 
	public function setData($data){
		$this->setIdUsuario($data['idusuario']);
		$this->setDesLogin($data['deslogin']);
		$this->setDesSenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));

	}

	
	// função para fazer um login
	public function login($usuario,$senha){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN" => $usuario, 
			":PASSWORD" => $senha
		));
		if (count($results) > 0){
			$this->setData($results[0]);
		} 
		else{
			throw new Exception("Login e/ou usuario invalidos");
		}
	}
// Inserções no BD
	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			":LOGIN" => $this->getDesLogin(),
			":PASSWORD" => $this->getDesSenha()	
		));
		if(count($results) > 0) {
			$this->setData($results[0]);
		}
	}

// FUNÇÃO PARA FAVER O LOGIN
public function __construct($login = "", $password = ""){
	$this->setDesLogin($login);
	$this->setDesSenha($password);
}

// FUNÇÃO PARA ATUALIZAR DADOS
public function update($login, $password){
	$this->setDesLogin($login);
	$this->setDesSenha($password);

	$sql = new Sql();
	$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(':LOGIN' => $this->getDesLogin(), ':PASSWORD' => $this->getDesSenha(),':ID' => $this->getIdUsuario()));
}
// FUNÇÃO PARA APAGAR DADOS
public function delete(){
	$sql = new Sql();
	$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
		':ID'=>$this->getIdUsuario()
	));
	$this->setIdUsuario(0);
	$this->setDesLogin("");
	$this->setDesSenha("");
	$this->setDtCadastro(new DateTime());
}

// Busca por um usuario a partir da ID
public function __toString(){
	return json_encode(array(
		"idusuario" => $this->getIdUsuario(),
		"deslogin" => $this->getDesLogin(),
		"dessenha" => $this->getDesSenha(),
		"dtcadastro" => $this->getDtCadastro()->format("d/m/Y H:i:s")
	));
}




}





?>