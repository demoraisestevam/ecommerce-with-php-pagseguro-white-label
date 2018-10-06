<?php 
session_start();
require_once("vendor/autoload.php");

// Config
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;

$app = new Slim();

$app->config('debug', true);

require_once("functions.php");

require_once("site.php");
require_once("site-cart.php");
require_once("site-login.php");
require_once("site-profile.php");
require_once("site-checkout.php");
require_once("site-pagseguro.php");

require_once("admin.php");
require_once("admin-users.php");
require_once("admin-products.php");
require_once("admin-categories.php");
require_once("admin-orders.php");

// Run Application
$app->run();

 ?>