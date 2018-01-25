<?php
namespace App;

use \Firebase\JWT\JWT;

class FirebaseHelper{

	protected $urlKey="";//gserviceaccount
	private $firebaseObject;
	private $config;

	public function __construct(){
		$this->config = \Config::get('firebase');
		$DEFAULT_URL = $this->config["url"];
		$DEFAULT_TOKEN = $this->config["token"];
		$this->firebaseObject = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
		$this->firebaseObject->setToken($DEFAULT_TOKEN);
	}

	public function object(){
		return $this->firebaseObject;
	}

	public function verifyToken($token){
		$result = file_get_contents($this->urlKey);
		$keys = json_decode($result, true);
		$keys_names = (array_keys($keys));
		$longitud = count($keys);
		$validToken=false;
		for($i=0; $i<$longitud; $i++){
			try{
				$user=JWT::decode($token, $keys[$keys_names[$i]], array("RS256"));
				$validToken=true;
			}catch (\Exception $e){

			}
		}
		return $validToken;
	}

}