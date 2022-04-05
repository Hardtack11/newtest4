<?php

class Author_Card extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_author_card',
			'description' => __('Panda PRO - Author Card', 'pandapro'),
		);
		parent::__construct( 'Author_Card', __('Panda PRO - Author Card', 'pandapro'), $widget_ops );
	}

	public function form($instance) { 
		return $instance;
	}



	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$widget_id = 'widget_' . $args['widget_id'];

		echo $args['before_widget'];
        if (get_the_author_meta('ID') > 0): 
?>
	
	<div class="widget-author-cover">
		<div class="media media-21x9">
			<div class="media-content" style="background-image:url('<?php pandapro_the_author_cover(get_the_author_meta('ID')) ?>')"></div>
		</div>
	</div>
	<div class="widget-author-meta text-center">
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" class="flex-avatar w-80" target="_blank"><?php echo get_avatar( get_the_author_meta('ID'), 80, '', '', array('class' => '80') ); ?></a>
		<div class="d-flex align-items-center justify-content-center mb-2">
			<div class="h6"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" title="<?php the_author_meta('display_name') ?>" target="_blank"><?php the_author_meta('display_name') ?></a></div>
			<div class="author-insignia ms-1" tooltip="<?php pandapro_the_author_role_name(get_the_author_meta('ID')) ?>" flow="up"></div>			
		</div>
		<div class="text-sm text-secondary mb-4"><?php the_author_meta('description') ?></div>
		<div class="row g-0">
			<div class="col">
				<div class="font-theme h5"><?php echo count_user_posts(get_the_author_meta('ID')) ?></div><div class="text-xs text-muted"><?php _e('Posts', 'pandapro') ?></div>
			</div>
			<div class="col">
				<div class="font-theme h5"><?php pandapro_the_author_comment_count(get_the_author_meta('ID')) ?></div><div class="text-xs text-muted"><?php _e('Comments', 'pandapro') ?></div>
			</div>
			<div class="col">
				<div class="font-theme h5"><?php pandapro_the_author_like_count(get_the_author_meta('ID')) ?></div><div class="text-xs text-muted"><?php _e('Likes', 'pandapro') ?></div>
			</div>
		</div>
		<?php 
			$panda_option = get_option('panda_option');
			if ($panda_option['default_donate_image']) : ?>
		<div class="widget-author-power mt-4">
		<button class="btn btn-outline-danger btn-block plus-power-popup"><i class="iconfont icon-USB me-2"></i><?php _e('Donate', 'pandapro') ?></button>
		<?php get_template_part_with_vars('template-parts/popup/plus-power-popup', array('id' => get_the_author_meta('ID'))) ?>
		</div>
		<?php endif; ?>
	</div>
<?php
        endif;
        echo $args['after_widget'];
	}
}

function reg_author_card() {
	register_widget("Author_Card");
}
add_action( 'widgets_init', 'reg_author_card');