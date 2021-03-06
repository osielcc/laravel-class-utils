<?php
namespace App;

use \Firebase\JWT\JWT;

class FirebaseHelper{

	protected $urlKey="";//gserviceaccount
	private $firebaseObject;

	public function __construct(){
		$DEFAULT_URL = ENV("FB_URL");
		$DEFAULT_TOKEN = ENV("FB_TOKEN");
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