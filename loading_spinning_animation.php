<?php
/*
 * Plugin Name: SMPLFY Spinning Animation
 * Add a lightweight CSS spinner animation
 * Version: 1.2
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
    $a = shortcode_atts( [ 'size' => 40, 'color' => '', 'persist' => 0 ], $atts );
    wp_enqueue_style( 'smplfy-spinner', plugins_url( 'spinner.css', __FILE__ ) );
    $style = sprintf( 'width:%1$dpx;height:%1$dpx', (int) $a['size'] );
    if ( $a['color'] ) { // one color, or a comma list to replace the brand cycle
        $colors = array_map( 'trim', explode( ',', $a['color'] ) );
        foreach ( range( 1, 4 ) as $i ) {
            $style .= sprintf( ';--smplfy-c%d:%s', $i, esc_attr( $colors[ ( $i - 1 ) % count( $colors ) ] ) );
        }
    }
    return sprintf(
        '<div class="smplfy-spinner%2$s" role="status" aria-label="Loading" style="%1$s"></div>',
        $style,
        $a['persist'] ? ' smplfy-persist' : ''
    );
} );

add_action( 'wp_footer', function() {
    echo '<script>
        addEventListener("load", ()=>document.querySelectorAll(".smplfy-spinner:not(.smplfy-persist)").forEach(e=>e.remove()))
    </script>';
} );



