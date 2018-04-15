# Yelp Fusion PHP

A simple PHP client for consuming Yelp Fusion’s Business Search and Business Lookup Endpoints. 

## Getting Started

**Business Search Example:**

$example_params = array(
	'term' => 'ramen restaurant',
	'location' => 'Brooklyn'
);

$yelp_obj = new Yelp($example_params, YELP_KEY);

$response = $yelp_obj->get_business_search();

**Business Lookup Example:**

$example_params = array(
	'id' => '_eDLqcUps_l-Uuj4lcJVYg'
);

$yelp_obj = new Yelp($example_params, YELP_KEY);

$response = $yelp_obj->get_business_lookup();

The example folder contains a basic business search sample.
Using a local server from the *example folder directory* you can view results in a browser console.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
