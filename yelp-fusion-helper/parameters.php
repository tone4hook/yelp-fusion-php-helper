<?php

class Parameters {

	// business search parameters
	// https://www.yelp.com/developers/documentation/v3/business_search
	private static $business_search_params = array(
		'term'=> 'string',
		'location'=> 'string',
		'latitude'=> 'double',
		'longitude'=> 'double',
		'radius'=> 'integer',
		'categories'=> 'string',
		'locale'=> 'string',
		'linit'=> 'integer',
		'offset'=> 'integer',
		'sort_by'=> 'string',
		'price'=> 'string',
		'open_now'=> 'boolean',
		'open_at'=> 'integer',
		'attributes'=> 'string'
	);
	// business lookup parameters
	// https://www.yelp.com/developers/documentation/v3/business
	private static $business_lookup_params = array(
		'id'=> 'string',
		'locale'=> 'string'
	);

	public $params;
	public $valid_params;

	/**
	 * @param    $params    Array of query-string parameters.      
	 */
	public function __construct($url_params = array()) {
		$this->params = $url_params;
	}

	public function get_business_search_params() {
		$this->valid_params = array();
		foreach ($this->params as $key => $value) {
			if (self::$business_search_params[$key]) {
				if (gettype(self::$business_search_params[$key]) === gettype($this->params[$key])) {
					$this->valid_params[$key] = $value;  
				}
			}
		}

		if ($this->valid_params) {
			return $this->valid_params;
		} else {
			return null; // returns null if no valid parameters
		}
	}

	public function get_business_lookup_params() {
		$this->valid_params = array();
		foreach ($this->params as $key => $value) {
			if (self::$business_lookup_params[$key]) {
				if (gettype(self::$business_lookup_params[$key]) === gettype($this->params[$key])) {
					$this->valid_params[$key] = $value;  
				}
			}
		}

		if ($valid_params) {
			return $this->valid_params;
		} else {
			return null; // returns null if no valid parameters
		}	
	}

}


