<?php

class Request {

	private static $host = 'https://api.yelp.com';
	public $path;
	public $url_params;
	public $api_key;

	/**
	 * @param    $path    The path of the API after the domain.
	 * @param    $url_params    Array of query-string parameters.
	 * @param    $api_key    Yelp Fusion API Key.        
	 */
	public function __construct($path, $url_params = array(), $api_key) {
		$this->path = $path;
		$this->url_params = $url_params;
		$this->api_key = $api_key;
	}

	/**
	 * @return   The JSON response from the request
	 */
	public function get_response() {
	    // Send Yelp API Call
	    try {
	        $curl = curl_init();
	        // the following line is for development ONLY
	        // Some localhosts complain about SSL verify
	        // delete the line below before production
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false); // delete before production
	        if (FALSE === $curl)
	            throw new Exception('Failed to initialize');
	 
	        $url = self::$host . $this->path . "?" . http_build_query( $this->url_params);
	        curl_setopt_array($curl, array(
	            CURLOPT_URL => $url,
	            CURLOPT_RETURNTRANSFER => true,  // Capture response.
	            CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
	            CURLOPT_MAXREDIRS => 10,
	            CURLOPT_TIMEOUT => 30,
	            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	            CURLOPT_CUSTOMREQUEST => "GET",
	            CURLOPT_HTTPHEADER => array(
	                "authorization: Bearer " . $this->api_key,
	                "cache-control: no-cache",
	            ),
	        ));
	        $response = curl_exec($curl);
	        if (FALSE === $response)
	            throw new Exception(curl_error($curl), curl_errno($curl));
	        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	        if (200 != $http_status)
	            throw new Exception($response, $http_status);
	        curl_close($curl);
	    } catch(Exception $e) {
	        trigger_error(sprintf(
	            'Curl failed with error #%d: %s',
	            $e->getCode(), $e->getMessage()),
	            E_USER_ERROR);
	    }
	    return $response;
	}
}