<?php
/**
 * Adds a route/endpoint for accessing menus via the WordPress REST API
 *
 * @package   JP-API-Menu
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2014 Josh Pollock
 */
if ( class_exists( 'JP_API_Menu' ) || ! function_exists( 'json_url' ) ) {
	return;
}

if ( ! defined( 'JP_API_ROUTE' ) ) {
	define( 'JP_API_ROUTE', 'jp-api' );
}

class JP_API_Menu {
	/**
	 * Server object
	 *
	 * @var WP_JSON_ResponseHandler
	 */
	protected $server;

	/**
	 * Constructor
	 *
	 * @param WP_JSON_ResponseHandler $server Server object
	 */
	public function __construct(WP_JSON_ResponseHandler $server) {
		$this->server = $server;

	}

	/**
	 * Register endpoints for JSON REST API.
	 *
	 * @param array $routes
	 *
	 * @return array
	 *
	 *
	 * @access public
	 */
	public function register_routes( $routes ) {
		$route = JP_API_ROUTE;
		$routes[ "/{$route}/menus/(?P<menu>[\w\-\_]+)" ] = array(
			array( array( $this, 'get_menu' ), WP_JSON_Server::READABLE | WP_JSON_Server::ACCEPT_JSON ),
		);

		$routes[ "/{$route}/menus/" ] = array(
			array( array( $this, 'get_menus' ), WP_JSON_Server::READABLE ),
		);

		return $routes;

	}

	/**
	 * Get a menu by name
	 *
	 * @param string $menu The menu's name
	 * @param null|array $data Optional. Args to pass to wp_get_nav_menu_items()
	 *
	 * @return WP_Error|WP_JSON_ResponseInterface
	 */
	public function get_menu( $menu, $data = null ) {

		$menu_items = wp_get_nav_menu_items( $menu, $data );

		if ( $menu_items ) {
			$response = json_ensure_response( $menu_items );
			$response->set_status( 201 );
			$response->header( 'Location', json_url( 'jpwp/menus/' . $menu  ) );

			return $response;
		}
		else {
			return new WP_Error( 'jwp_api_error' . __FUNCTION__,  __( 'Menu does not exist.', 'jwp-api' ) );
		}

	}

	/**
	 * Get all registered menus.
	 *
	 * @return WP_Error|WP_JSON_ResponseInterface
	 */
	public function get_menus() {
		$menus = get_registered_nav_menus();
		if ( $menus ) {
			$response = json_ensure_response( $menus );
			$response->set_status( 201 );
			$response->header( 'Location', json_url( 'jpwp/menus/'  ) );

			return $response;
		}
		else {
			return new WP_Error( 'jwp_api_error' . __FUNCTION__,  __( 'Menus could not be returned.', 'jpwp-api' ) );
		}
	}
} 
