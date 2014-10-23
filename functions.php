<?php
/**
 * Add the menu route & endpoints
 *
 * @package   JP-API-Menu
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2014 Josh Pollock
 */
if ( ! function_exists( 'jp_api_menus' ) ) :
	add_action( 'wp_json_server_before_serve', 'jp_api_menus', 10, 1 );
	function jp_api_menus( $server ) {
		$jp_api_menus = new JP_API_Menu( $server );
		add_filter( 'json_endpoints', array( $jp_api_menus, 'register_routes' ), 0 );
	}
endif;
