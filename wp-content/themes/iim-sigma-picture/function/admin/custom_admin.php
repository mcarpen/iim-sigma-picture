<?php

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts()
{
    $current_user = wp_get_current_user();
    $user_info    = get_userdata($current_user->ID);
    if ($user_info->roles[0] == "client") {
        echo '<style>
            #menu-appearance,
            #menu-plugins,
            #menu-tools,
            #menu-settings,
            #menu-dashboard .wp-submenu li:nth-of-type(3),
            #menu-media .wp-submenu li:nth-of-type(4),
            #wp-admin-bar-itsec_admin_bar_menu,
            #wp-admin-bar-w3tc,
            #wp-admin-bar-imagify,
            #toplevel_page_pp-config,
            #toplevel_page_edit-post_type-acf-field-group,
            #toplevel_page_google-analyticator,
            #toplevel_page_itsec,
            #toplevel_page_w3tc_dashboard {
              display: none;
            }
          </style>';
    }
}