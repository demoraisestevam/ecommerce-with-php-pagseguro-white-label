<?php 

namespace Hcode\PagSeguro;

class Config {

	const SANDBOX = true;

	const SANDBOX_EMAIL = "demoraisestevam@gmail.com";
	const PRODUCTION_EMAIL = "demoraisestevam@gmail.com";

	const SANDBOX_TOKEN = "18BEA85AB7B046BC883F4A88443093AE";
	const PRODUCTION_TOKEN = "MY_TOKEN_PRIVATE";

	const SANDBOX_SESSIONS = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";
	const PRODUCTION_SESSIONS = "https://ws.pagseguro.uol.com.br/v2/sessions";

	const SANDBOX_URL_JS = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
	const PRODUCTION_URL_JS = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";



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

	public static function getUrlJS()
	{

		return (Config::SANDBOX === true) ? Config::SANDBOX_URL_JS : Config::PRODUCTION_URL_JS;

	}

}

 ?>