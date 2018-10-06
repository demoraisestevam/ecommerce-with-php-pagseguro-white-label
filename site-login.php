<?php 

use \Hcode\Page;
use \Hcode\Model\User;

$app->get("/login", function(){

	$page = new Page();

	$page->setTpl("login", [
		'error'=>User::getError(),
		'errorRegister'=>User::getErrorRegister(),
		'registerValues'=>(isset($_SESSION['registerValues'])) ? $_SESSION['registerValues'] : ['name'=>'', 'email'=>'', 'phone'=>'']
	]);

});

$app->post("/login", function(){

	try {

		User::login($_POST['login'], $_POST['password']);

	} catch(Exception $e) {

		User::setError($e->getMessage());

	}

	header("Location: /checkout");
	exit;

});

$app->get("/logout", function(){
    
    User::logout();

    Cart::removeFromSession();

    session_regenerate_id();

    header("Location: /login");
    exit;

});

$app->post("/register", function(){

	$_SESSION['registerValues'] = $_POST;

	if (!isset($_POST['name']) || $_POST['name'] === '') {

		User::setErrorRegister("Preencha seu nome.");
		header("Location: /login");
		exit;

	};

	if (!isset($_POST['email']) || $_POST['email'] === '') {

		User::setErrorRegister("Preencha seu email.");
		header("Location: /login");
		exit;

	};

	if (!isset($_POST['password']) || $_POST['password'] === '') {

		User::setErrorRegister("Preencha a senha.");
		header("Location: /login");
		exit;

	};

	if (User::checkLoginExist($_POST['email']) === true) {

		User::setErrorRegister("Este endereço de email já está sendo usado por outro usuário.");
		header("Location: /login");
		exit;

	};

	$user = new User();

	$user->setData([
		'inadmin'=>0,
		'deslogin'=>$_POST['email'],
		'desperson'=>$_POST['name'],
		'desemail'=>$_POST['email'],
		'despassword'=>$_POST['password'],
		'nrphone'=>$_POST['phone']
	]);

	$user->save();

	User::login($_POST['email'], $_POST['password']);

	header("Location: /checkout");
	exit;

});

// Forgot Page
$app->get("/forgot", function() {
 	
 	$page = new Page();

 	$page->setTpl("forgot");

});

// Forgot Post
$app->post("/forgot", function(){

 	$user = User::getForgot($_POST["email"], false);

 	header("Location: /forgot/sent");

	exit;

});

// Forgot Email Send
$app->get("/forgot/sent", function(){

 	$page = new Page();

 	$page->setTpl("forgot-sent");	
 	
});

// Forgot Reset
$app->get("/forgot/reset", function() {

 	$user = User::validForgotDecrypt($_GET["code"]);

 	$page = new Page();

 	$page->setTpl("forgot-reset", array(
 		"name"=>$user["desperson"],
 		"code"=>$_GET["code"]
 	));

});

// Forgot Reset Post
$app->post("/forgot/reset", function() {

	$forgot = User::validForgotDecrypt($_POST["code"]);

	User::setForgotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$user->setPassword(User::getPasswordHash($_POST["password"]));

	$page = new Page();

 	$page->setTpl("forgot-reset-success");

});

 ?>