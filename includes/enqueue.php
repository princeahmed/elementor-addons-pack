<?php

/* Block direct access */
defined( 'ABSPATH' ) || exit;

/**
 * Register and enqueue frontend scripts
 *
 * @param $hook
 *
 * @since 1.0.0
 *
 */
function elementor_addons_pack_scripts() {
	wp_register_style('elementor-addons-pack', ELEMENTOR_ADDONS_PACK_ASSETS_URL.'/css/frontend.min.js', [], ELEMENTOR_ADDONS_PACK_VERSION);

	wp_register_script('particles', ELEMENTOR_ADDONS_PACK_ASSETS_URL.'/js/particles.min.js', ['jquery'], '2.0.0', true);
	wp_register_script('elementor-addons-pack', ELEMENTOR_ADDONS_PACK_ASSETS_URL.'/js/frontend.min.js', ['jquery'], ELEMENTOR_ADDONS_PACK_VERSION, true);
}

add_action( 'wp_enqueue_scripts', 'elementor_addons_pack_scripts' );



