<?php
/*
 * Plugin Name: SMPLFY Spinning Animation
 * Add a lightweight CSS spinner animation
 * Version: 1.0
 * Author: Liam Nell
 * URL: simplifybiz.com
 * */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

require __DIR__ . '/plugin-update-checker/plugin-update-checker.php';

YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
    'https://github.com/sblik/smplfy-loading-spinning-animation/',
    __FILE__,
    'smplfy-loading-spinning-animation'
);

add_shortcode( 'spinning_animation', function( $atts ) {
    $a = shortcode_atts( [ 'size' => 40, 'color' => '#333' ], $atts );
    wp_enqueue_style( 'smplfy-spinner', plugins_url( 'spinner.css', __FILE__ ) );
    return sprintf(
'<div 
            class="smplfy-spinner"
            role="status"
            aria-label="Loading"
            style="width:%1$dpx;height:%1$dpx;border-top-color:%2$s">
        </div>',
        (int) $a['size'],
        esc_attr( $a['color'] )
    );
} );

add_action( 'wp_footer', function() {
    echo '<script>
        addEventListener("load", ()=>document.querySelectorAll(".smplfy-spinner").forEach(e=>e.remove()))
    </script>';
} );



