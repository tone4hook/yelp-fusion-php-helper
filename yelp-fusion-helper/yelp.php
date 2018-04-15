<?php

require_once('parameters.php');
require_once('request.php');

class Yelp {

	private static $search_path = '/v3/businesses/search';
	private static $lookup_path = '/v3/businesses/';
	public $valid_params;
	public $api_key;
	public $params_obj;
	public $request_obj;
	public $response;

	/**
	 * @param    $url_params    Array of query-string parameters. 
	 * @param    $api_key    Yelp Fusion API Key.        
	 */
	public function __construct($url_params = array(), $api_key) {
		$this->params = $url_params;
		$this->api_key = $api_key;
	}

	public function get_business_search() {

		$this->params_obj = new Parameters($this->params);

		$this->valid_params = $this->params_obj->get_business_search_params();

		if ($this->valid_params) {
			$this->request_obj = new Request(self::$search_path, $this->valid_params, $this->api_key);
			$this->response = $this->handle_response();
			echo $this->response;
		} else {
			echo 'Error: Not valid Yelp Fusion parameters for Business Search. Please visit https://www.yelp.com/developers/documentation/v3/business_search and review the valid parameters.';
		}
	}

	public function get_business_lookup() {
		$this->params_obj = new Parameters($this->params);

		$this->$valid_params = $this->params_obj->get_business_lookup_params();

		if ($this->$valid_params) {
			$this->request_obj = new Request(self::$lookup_path, $this->$valid_params, $this->api_key);
			$this->response = $this->handle_response();
			echo $this->response;
		} else {
			echo 'Error: Not valid Yelp Fusion parameters for Business Lookup. Please visit https://www.yelp.com/developers/documentation/v3/business and review the valid parameters.';
		}
	}

	private function handle_response() {
		$initial_response = $this->request_obj->get_response();
		$results = json_decode($initial_response);
		header("Content-type: application/json");
		$encoded = json_encode($results);
		return $encoded;
	}
	
}