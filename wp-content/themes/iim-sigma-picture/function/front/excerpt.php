<?php
/**
 * Add custom excerpt length
 *
 * @param $length
 *
 * @return int
 */
function themify_custom_excerpt_length($length)
{
    return 30;
}

add_filter('excerpt_length', 'themify_custom_excerpt_length', 999);