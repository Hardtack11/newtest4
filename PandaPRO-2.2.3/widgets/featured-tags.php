<?php
class Featured_Tags extends WP_Widget
{

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct()
	{
		$widget_ops = array(
			'classname' => 'widget_nice_tag_cloud',
			'description' => 'Panda PRO - 标签展示',
		);
		parent::__construct('Featured_Tags', 'Panda PRO - 标签展示', $widget_ops);
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
		$title = !empty(get_field('title', $widget_id)) ? get_field('title', $widget_id) : __('Featured Tags', 'pandapro');
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		$type = get_field('type', $widget_id) === 'hot' ? 'count' : 'rand';
		$display_posts_num = get_field('display_posts_num', $widget_id) ?? true;
		$num = get_field('num', $widget_id) ?: 15;
		$post_tags = get_terms([
			'taxonomy' => 'post_tag',
			'number' => $type === 'count' ? $num : $num * 3,
			'orderby' => $type,
			'order' => $type === 'count' ? 'DESC' : 'ASC',
			'hide_empty' => false,
		]);
		// 伪随机
		if ($type === 'rand') {
			shuffle($post_tags);
			$post_tags = array_slice($post_tags, 0, $num);
		}
		if (is_array($post_tags) && count($post_tags) > 0) :
			echo $args['before_widget'];
			if ($title) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
?>
<ul>
	<?php foreach ($post_tags as $post_tag) : ?>
	<li>
		<a href="<?php echo get_term_link($post_tag); ?>" class="btn btn-light btn-sm btn-tag btn-w-md">
			<?php echo $post_tag->name ?>
			<?php if ($display_posts_num) : ?>
			<sup class="text-muted"><?php echo $post_tag->count; ?></sup>
			<?php endif; ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
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

function reg_featured_tags()
{
	register_widget("Featured_Tags");
}

add_action('widgets_init', 'reg_featured_tags');