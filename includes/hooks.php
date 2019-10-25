<?php

/* Block direct access */
defined( 'ABSPATH' ) || exit;

add_action( 'wp_print_styles', function () { ?>
    <style>
        .addons-pack-particle-bg {
            background: red;
        }
    </style>
<?php
} );

