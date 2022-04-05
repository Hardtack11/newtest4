<?php
class Featured_Topics extends WP_Widget
{

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct()
	{
		$widget_ops = array(
			'classname' => 'Featured_Topics',
			'description' => 'Panda PRO - 专题展示',
		);
		parent::__construct('Featured_Topics', 'Panda PRO - 专题展示', $widget_ops);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget($args, $instance)
	{

		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		$widget_id = 'widget_' . $args['widget_id'];
		$topics  = get_field('topics', $widget_id) ?: array();
		$title = !empty(get_field('title', $widget_id)) ? get_field('title', $widget_id) : __('Featured Topics', 'pandapro');
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		if (is_array($topics) && count($topics) > 0) :
			echo $args['before_widget'];
			if ($title) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
	?>
		<div class="list-overlay">
			<?php
				foreach ($topics as $topic) : 
				$topic = get_term($topic, 'special');
				if (!is_wp_error($topic)):
				$cover = get_term_meta($topic->term_id, 'cover', true);
			?>
			<div class="list-item overlay-hover rounded">
				<div class="media">
					<div class="media-content" style="background-image: url(<?php echo timthumb($cover) ?>);"><div class="overlay-1"></div></div>
				</div>
				<div class="list-content">
					<div class="list-body">
						<div  class="list-title h6 text-white h-1x"><?php echo $topic->name ?><sup class="font-theme mx-1"><?php echo $topic->count ?></sup></div>
					</div>
				</div>
				<a href="<?php echo get_term_link($topic) ?>" title="<?php echo $topic->name ?>" class="list-goto"></a>
			</div>
		<?php	
			endif;
			endforeach;
		?>
		</div>
	<?php
		echo $args['after_widget'];
		endif;
		wp_reset_postdata();
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form($instance)
	{
		return $instance;
	}
}

function reg_featured_topics()
{
	register_widget("Featured_Topics");
}

add_action('widgets_init', 'reg_featured_topics');
