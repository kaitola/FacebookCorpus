<?php
require_once('facebook-php-sdk-v4-5.0-dev/src/Facebook/autoload.php');

//20171021
//@Author: Matt
class FacebookLogin{

	private $autologin = false;
	private $fb;
	private $helper;
	private $loginUrl;

	//optional
	private $permissions = ['email', 'user_likes','user_tagged_places','user_friends','user_birthday'];
	//facebook登入驗證完成後轉址URL
	//'http://localhost/FacebookCorpus/post2.php'
	private $redirectURL = 'http://localhost/FacebookCorpus/corpus.php';
	//facebook access token
	private static $accessToken;

	public function __construct(){

		$this->fb = new Facebook\Facebook([
		    'app_id' => '448131392027934',
		    'app_secret' => '8d2d239ef97293cce1cc1744653fc195',
		    'default_graph_version' => 'v2.2',
		    ]);

		$this->helper = $this->fb->getRedirectLoginHelper();
	}

	public function getfbuse(){
		return $this->fb;
	}

	public function getfbHelper(){
		return $this->helper;
	}

	public function getLoingURL(){

		$this->loginUrl = $this->helper->getLoginUrl($this->redirectURL, $this->permissions);
		return $this->loginUrl;
	}

	public function getAccessToken(){

		try {
			$this->accessToken = $this->helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			//When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		  } catch(Facebook\Exceptions\FacebookSDKException $e) {
		  //When validation fails or other local issues
		  	echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  	exit;
		}
		return $this->accessToken;
	}

}

?>