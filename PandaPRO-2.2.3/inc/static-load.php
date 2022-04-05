<?php

/**
 * Enqueue scripts and styles.
 */
function pandapro_scripts()
{
	$panda_option = get_option('panda_option');
	$allow_switch_darkmode = $panda_option['dark_mode_detail']['frontend'] ?? false;
	wp_enqueue_style('nicetheme-iconfont', get_template_directory_uri() . '/plugins/iconfont/iconfont.css');

	wp_enqueue_style('nicetheme-bootstrap', get_template_directory_uri() . '/plugins/bootstrap/bootstrap.min.css');

	wp_enqueue_style('nicetheme-reset', get_template_directory_uri() . '/css/reset.css');

	wp_enqueue_style('nicetheme-style', get_stylesheet_uri());
	global $post;


	wp_register_script('nicetheme-email-autocomplete', get_template_directory_uri() . '/plugins/email-autocomplete/jquery.email-autocomplete.min.js', array('jquery'), THEME_VERSION, true);

	wp_register_script('nicetheme-resizeseneor', get_template_directory_uri() . '/plugins/theia-sticky-sidebar/ResizeSensor.min.js', array('jquery'), THEME_VERSION, true);
	wp_register_script('nicetheme-sticky-sidebar', get_template_directory_uri() . '/plugins/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), THEME_VERSION, true);

	wp_register_style('nicetheme-swiper-css', get_template_directory_uri() . '/plugins/swiper/swiper-bundle.min.css',  THEME_VERSION, true);
	wp_register_script('nicetheme-swiper-js', get_template_directory_uri() . '/plugins/swiper/swiper-bundle.min.js', array('jquery'), THEME_VERSION, true);

	wp_register_script('nicetheme-clipboard-js', get_template_directory_uri() . '/plugins/clipboard/clipboard.min.js', array('jquery'), THEME_VERSION, true);
	wp_register_script('nicetheme-tocbot-js', get_template_directory_uri() . '/plugins/tocbot/tocbot.min.js', array('jquery'), THEME_VERSION, true);

	wp_register_script('nicetheme-ajax-comments', get_template_directory_uri() . '/js/ajax-comment.js', array('jquery'), THEME_VERSION, true);


	wp_localize_script(
		'jquery',
		'globals',
		array(
			"ajax_url"             => admin_url("admin-ajax.php"),
			"url_theme"            => get_template_directory_uri(),
			"site_url"             => get_bloginfo('url'),
			"post_id"			   => is_single() ? $post->ID : 0,
			"allow_switch_darkmode" => $allow_switch_darkmode,
		)
	);
	if (!is_admin()) {

		wp_enqueue_script('nicetheme-bootstrap', get_template_directory_uri() . '/plugins/bootstrap/bootstrap.bundle.min.js', array('jquery'), THEME_VERSION, true);

		if (is_home()) {
			wp_enqueue_style('nicetheme-swiper-css');
			wp_enqueue_script('nicetheme-swiper-js');
		}

		wp_enqueue_script('nicetheme-email-autocomplete');
		wp_enqueue_script('nicetheme-resizeseneor');
		wp_enqueue_script('nicetheme-sticky-sidebar');

		if (is_single()) {
			wp_enqueue_script('nicetheme-clipboard-js');
		}

		if (is_single() && get_post_meta($post->ID, 'single_toc', true)) {
			wp_enqueue_script('nicetheme-tocbot-js');
		}
		wp_enqueue_script('nicetheme-js', get_template_directory_uri() . '/js/nicetheme.js', ['jquery', 'wp-i18n'], THEME_VERSION, true);
		wp_set_script_translations('nicetheme-js', 'pandapro', get_template_directory() . '/languages');

		if (is_singular() && comments_open()) {
			wp_enqueue_script('nicetheme-ajax-comments');
		}
	}
}
add_action('wp_enqueue_scripts', 'pandapro_scripts');
add_action('wp_enqueue_scripts', 'nc_load_experimental_alpine');

function pandapro_acf_input_admin_footer()
{
?>
<script type="text/javascript">
(function($) {
    function toggleField() {
        var field = '.acf-field-5c5afa7ba7296'
        if ($(field).length) {
            var styleType = $('.acf-image-select-selected input:checked').attr('value')
            $('.acf-field-5e8e6cbb03ce9').hide()
            if (styleType === 'banner-style-1') {
                $('.acf-field-5ce95aff61d2d').show()
                $('.acf-field-5df1963be30b6').hide()
            } else {
                if (styleType === 'banner-style-3') {
                    $('.acf-field-5e8e6cbb03ce9').show()
                }
                $('.acf-field-5ce95aff61d2d').hide()
                $('.acf-field-5df1963be30b6').show()
            }
        }
    }
    toggleField()
    $('.acf-field-5c5afa7ba7296 .acf-image-select').click(toggleField)
})(jQuery);
</script>
<?php
}
add_action('acf/input/admin_footer', 'pandapro_acf_input_admin_footer');