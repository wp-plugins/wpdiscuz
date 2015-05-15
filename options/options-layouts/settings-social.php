<?php
/* 1. WordPress Social Login
  2. Social Login
  3  Super Socializer
  4. Social Connect
  5. uLogin
 */
add_thickbox();
if (function_exists('wsl_render_auth_widget_in_comment_form')) {
    $wc_social_plugin = '<tr valign="top"><td>WordPress Social Login</td><td><a href="options-general.php?page=wordpress-social-login" class="button button-primary">' . __('Settings', 'default') . '</a></td></tr>';
} else if (function_exists('the_champ_login_button')) {
    $wc_social_plugin = '<tr valign="top"><td>Super Socializer</td><td><a href="admin.php?page=the-champ-social-login" class="button button-primary">' . __('Settings', 'default') . '</a></td></tr>';
} else if (function_exists('sc_render_comment_form_social_connect')) {
    $wc_social_plugin = '<tr valign="top"><td>Social Connect</td><td><a href="options-general.php?page=social-connect-id" class="button button-primary">' . __('Settings', 'default') . '</a></td></tr>';
} else {
    $plugins_directory = ABSPATH . 'wp-content/plugins/';
    // wordpress social login
    if (file_exists($plugins_directory . 'wordpress-social-login/')) {
        $wc_wordpress_social_login_text = __('Activate', WC_Core::$TEXT_DOMAIN);
        $wc_wordpress_social_login_link = 'admin.php?page=wpdiscuz_options_page&wc_social_action=wordpress-social-login';
        $wc_wordpress_social_login_thickbox = '';
    } else {
        $wc_wordpress_social_login_text = __('View details/Install', WC_Core::$TEXT_DOMAIN);
        $wc_wordpress_social_login_link = 'plugin-install.php?tab=plugin-information&plugin=wordpress-social-login&TB_iframe=true&width=772&height=342';
        $wc_wordpress_social_login_thickbox = 'thickbox';
    }
    // super socializer
    if (file_exists($plugins_directory . 'super-socializer/')) {
        $wc_super_socializer_text = __('Activate', WC_Core::$TEXT_DOMAIN);
        $wc_super_socializer_link = 'admin.php?page=wpdiscuz_options_page&wc_social_action=super-socializer';
        $wc_super_socializer_thickbox = '';
    } else {
        $wc_super_socializer_text = __('View details/Install', WC_Core::$TEXT_DOMAIN);
        $wc_super_socializer_link = 'plugin-install.php?tab=plugin-information&plugin=super-socializer&TB_iframe=true&width=772&height=342';
        $wc_super_socializer_thickbox = 'thickbox';
    }
    // social connect
    if (file_exists($plugins_directory . 'social-connect/')) {
        $wc_social_connect_text = __('Activate', WC_Core::$TEXT_DOMAIN);
        $wc_social_connect_link = 'admin.php?page=wpdiscuz_options_page&wc_social_action=social-connect';
        $wc_social_connect_thickbox = '';
    } else {
        $wc_social_connect_text = __('View details/Install', WC_Core::$TEXT_DOMAIN);
        $wc_social_connect_link = 'plugin-install.php?tab=plugin-information&plugin=social-connect&TB_iframe=true&width=772&height=342';
        $wc_social_connect_thickbox = 'thickbox';
    }

    $wc_social_plugin = '<tr valign="top"><td>WordPress Social Login</td><td><a href="' . $wc_wordpress_social_login_link . '" class="button button-primary ' . $wc_wordpress_social_login_thickbox . '">' . $wc_wordpress_social_login_text . '</a></td></tr>';
    $wc_social_plugin .= '<tr valign="top"><td>Super Socializer</td><td><a href="' . $wc_super_socializer_link . '" class="button button-primary ' . $wc_super_socializer_thickbox . '">' . $wc_super_socializer_text . '</a></td></tr>';
    $wc_social_plugin .= '<tr valign="top"><td>Social Connect</td><td><a href="' . $wc_social_connect_link . '" class="button button-primary ' . $wc_social_connect_thickbox . '">' . $wc_social_connect_text . '</a></td></tr>';
}

if (isset($_GET['wc_social_action'])) {
    $plugin_name = $_GET['wc_social_action'];
    $wc_activation_redirect_url = '';
    $wc_social_plugin_file = '';
    switch ($plugin_name) {
        case 'wordpress-social-login':
            $wc_activation_redirect_url = 'options-general.php?page=wordpress-social-login';
            $wc_social_plugin_file = 'wordpress-social-login/wp-social-login.php';
            break;
        case 'super-socializer':
            $wc_activation_redirect_url = 'admin.php?page=the-champ-social-login';
            $wc_social_plugin_file = 'super-socializer/super_socializer.php';
            break;
        case 'social-connect':
            $wc_activation_redirect_url = 'options-general.php?page=social-connect-id';
            $wc_social_plugin_file = 'social-connect/social-connect.php';
            break;
    }
    activate_plugin($wc_social_plugin_file, $wc_activation_redirect_url);
}
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Social Login', WC_Core::$TEXT_DOMAIN); ?> </h2>
    <p style="padding-bottom:10px; padding-left:10px;"><?php _e('You can use one of these most popular Social Login Plugins to allow your visitors login and comment with Facebook, Twitter, Google+, Wordpress, VK, OK and lots of other social network service accounts. All social login buttons will be fully integrated with wpDiscuz comment forms.', WC_Core::$TEXT_DOMAIN); ?> </p>
    <table class="wp-list-table widefat plugins" style="margin-top:10px; border:none;">
        <tbody>
            <?php echo $wc_social_plugin; ?>
        </tbody>
    </table>
</div>
