<?php

require_once('../yelp-fusion-helper/yelp.php');

// API key placeholders that must be filled in by users.
// You can find it on
// https://www.yelp.com/developers/v3/manage_app

define('YELP_KEY', 'YourApiKeyHere');

// Complain if credentials haven't been filled out.
assert('YELP_KEY', 'Please supply your API key.');

// example of business seach parameters
$example_params = array(
	'term' => 'ramen restaurant',
	'location' => 'Brooklyn'
);

$yelp_obj = new Yelp($example_params, YELP_KEY);

echo $yelp_obj->get_business_search();