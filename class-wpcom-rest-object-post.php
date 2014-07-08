<?php

class WPCOM_REST_Object_Post extends WPCOM_REST_Object {
	private $client;
	private $post_id;
	private $site_id;

	private function __construct( $post_id, $site_id, WPCOM_REST_Client $client ) {
		$this->post_id = $post_id;
		$this->site_id = $site_id;
		$this->client = $client;
	}

	public static function withId( $post_id, $site_id, WPCOM_REST_Client $client ) {
		return new self( $post_id, $site_id, $client );
	}

	public static function asNew( $post_data, $site_id, WPCOM_REST_Client $client ) {
		$url = sprintf( 'v1/sites/%s/posts/new', $site_id );

		$response = $client->send_authorized_api_request( $url, WPCOM_REST_Client::REQUEST_METHOD_POST, null, $post_data );
		return self::withId( $response->ID, $site_id, $client );
	}

	public function get() {
		$url = sprintf( 'v1/sites/%s/posts/%d', $this->site_id, $this->post_id );
		return $this->client->send_api_request( $url, WPCOM_REST_Client::REQUEST_METHOD_GET );
	}

	public function update_post( $post_data ) {
		$url = sprintf( 'v1/sites/%s/posts/%d', $this->site_id, $this->post_id );
		return $this->client->send_authorized_api_request( $url, WPCOM_REST_Client::REQUEST_METHOD_POST, null, $post_data );
	}

	public function delete_post() {
		$url = sprintf( 'v1/sites/%s/posts/%d/delete', $this->site_id, $this->post_id );
		return $this->client->send_authorized_api_request( $url, WPCOM_REST_Client::REQUEST_METHOD_POST );
	}


}