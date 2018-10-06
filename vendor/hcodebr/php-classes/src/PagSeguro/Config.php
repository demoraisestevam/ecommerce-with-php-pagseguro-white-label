<?php 

namespace Hcode\PagSeguro;

class Config {

	const SANDBOX = true;

	const SANDBOX_EMAIL = "demoraisestevam@gmail.com";
	const PRODUCTION_EMAIL = "demoraisestevam@gmail.com";

	const SANDBOX_TOKEN = "18BEA85AB7B046BC883F4A88443093AE"; //Sandbox Tokem
	const PRODUCTION_TOKEN = "MY_TOKEN_PRIVATE"; //Private Tokem

	const SANDBOX_SESSIONS = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";
	const PRODUCTION_SESSIONS = "https://ws.pagseguro.uol.com.br/v2/sessions";


	public static function getAuthentication()
	{

		if (Config::SANDBOX === true) 
		{

			return [
				"email"=>Config::SANDBOX_EMAIL,
				"token"=>Config::SANDBOX_TOKEN
			];

		}
		else
		{

			return [
				"email"=>Config::PRODUCTION_EMAIL,
				"token"=>Config::PRODUCTION_TOKEN
			];


		}

	}

	public static function getUrlSessions():string
	{

		return (Config::SANDBOX === true) ? Config::SANDBOX_SESSIONS : Config::PRODUCTION_SESSIONS;

	}

}

 ?>