<?php
/*
            /$$
    /$$    /$$$$
   | $$   |_  $$    /$$$$$$$
 /$$$$$$$$  | $$   /$$_____/
|__  $$__/  | $$  |  $$$$$$
   | $$     | $$   \____  $$
   |__/    /$$$$$$ /$$$$$$$/
          |______/|_______/
================================
        Keep calm and get rich.
                    Is the best.
*/

class Recommended_Posts extends WP_Widget
{

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct()
	{
		$widget_ops = array(
			'classname' => 'widget_recommended_posts',
			'description' => __('Panda PRO - Recommended Posts', 'pandapro'),
		);
		parent::__construct('Recommended_Posts', __('Panda PRO - Recommended Posts', 'pandapro'), $widget_ops);
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

		// extract($args);
		$num   = get_field('num', $widget_id);
		$type   = get_field('type', $widget_id);
		$style = get_field('style', $widget_id);
		$days  = get_field('days', $widget_id);
		$cats_in = is_array(get_field('cats', $widget_id)) ? get_field('cats', $widget_id) : array();

		$title = !empty(get_field('title', $widget_id)) ? get_field('title', $widget_id) : __('Recommended Posts', 'pandapro');
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo $args['before_widget'];
		if ($title) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$date_query = array(
			array(
				'column' => 'post_date',
				'after' => "-$days days",
			)
		);

		switch ($type) {
			case 'new_posts':
				$query_args = array(
					'post_type'                => 'post',
					'posts_per_page'      => $num,
					'category__in' => $cats_in,
					'ignore_sticky_posts' => 1
				);
				break;

			case 'random_posts':
				$query_args = array(
					'post_type'                => 'post',
					'posts_per_page'      => $num,
					'orderby'             => 'rand',
					'ignore_sticky_posts' => 1,
					'category__in' => $cats_in,
					'date_query'   => $date_query,
				);
				break;

			case 'comment_posts':
				$query_args = array(
					'post_type'                => 'post',
					'posts_per_page'           => $num,
					'category__in' => $cats_in,
					'orderby'             => 'comment_count',
					'ignore_sticky_posts' => 1,
					'date_query'   => $date_query,
				);
				break;

			case 'related_posts':
				$queried_object_id = get_queried_object_id();
				$post_tags = get_the_tags($queried_object_id);
				$cats = get_the_category($queried_object_id);

				if ($post_tags) {
					$query_args = array(
						'posts_per_page' => $num,
						'post_status'		  => '',
						'orderby' => 'rand',
						'ignore_sticky_posts' => 1,
						'category__in' => $cats_in,
						'tax_query' => array(
							'relation' => 'OR',
							array(
								'taxonomy' => 'category',
								'field' => 'id',
								'terms' => array_column($cats, 'term_id')
							),
							array(
								'taxonomy' => 'post_tag',
								'field' => 'id',
								'terms' => array_column($post_tags, 'term_id'),
							)
						),
						'date_query'   => $date_query,
					);
				} else {
					$query_args = array(
						'posts_per_page' => $num,
						'orderby' => 'rand',
						'category__in' => $cats_in,
						'ignore_sticky_posts' => 1,
						'tax_query' => array(
							'taxonomy' => 'category',
							'field' => 'id',
							'terms' => array_column($cats, 'term_id')
						),
						'date_query'   => $date_query,
					);
				}

				break;

			case 'like_posts':
				$query_args = array(
					'post_type'                => 'post',
					'posts_per_page'      => $num,
					'category__in' => $cats_in,
					'orderby'             => 'meta_value_num',
					'meta_key'            => 'suxing_ding',
					'ignore_sticky_posts' => 1,
					'date_query'   => $date_query,
				);
				break;

			case 'views_posts':
				$query_args = array(
					'post_type'                => 'post',
					'posts_per_page'      => $num,
					'category__in'   => $cats_in,
					'orderby'             => 'meta_value_num',
					'meta_key'            => 'views',
					'ignore_sticky_posts' => 1,
					'date_query'   => $date_query,
				);
				break;

			default:
				$query_args = null;
				break;
		}

		$queryPosts = new WP_Query($query_args);

?>
<?php if ($style == 'plain') : ?>
<div class="list-grid list-grid-padding list-bordered">
    <?php
				$index = 0;
				if ($queryPosts->have_posts()) :
					while ($queryPosts->have_posts()) : $queryPosts->the_post();
				?>
    <?php $index += 1; ?>
    <div class="list-item">
        <div class="media media-3x2 col-4">
            <a class="media-content" href="<?php the_permalink() ?>"
                style="background-image:url('<?php echo pandapro_the_thumbnail(null, array('w' => 150, 'h' => 100)) ?>')"></a>
            <?php if (($type == 'like_posts') || ($type == 'views_posts') || ($type == 'comment_posts')) : ?>
            <div class="media-overlay overlay-top">
                <span class="badge badge-hot font-theme">TOP<?php echo $index; ?></span>
            </div>
            <?php endif; ?>
        </div>
        <div class="list-content">
            <div class="list-body">
                <a href="<?php the_permalink() ?>" class="list-title h-2x"><?php the_title() ?></a>
            </div>
            <div class="list-footer text-muted text-xs ">
                <?php pandapro_the_time(); ?>
            </div>
        </div>
    </div>
    <?php
		endwhile;
	else :
		echo '<div class="text-center p-3"><div class="icon-svg svg-empty svg-sm"></div></div>';
	endif;
	wp_reset_postdata();
	?>
</div>
<?php elseif ($style == 'time') : ?>

<div class="list-time">
    <?php
				if ($queryPosts->have_posts()) :
					while ($queryPosts->have_posts()) : $queryPosts->the_post();
				?>

    <div class="list-time-item">
        <div class="list-time-dot me-2"></div>
        <div class="list-time-inner mb-3">
            <div class="text-sm">
                <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" target="_blank"><?php the_title() ?></a>
            </div>
            <div class="text-xs text-muted mt-1">
                <?php pandapro_the_time(); ?>
            </div>
        </div>
    </div>
    <?php
					endwhile;
				else :
					echo '<div class="text-center p-3"><div class="icon-svg svg-empty svg-sm"></div>';
				endif;
				wp_reset_postdata();
				?>
</div>
<?php else : ?>

<div class="list">
    <?php
				if ($queryPosts->have_posts()) :
					while ($queryPosts->have_posts()) : $queryPosts->the_post();
				?>

    <div class="list-item list-overlay-content rounded">
        <div class="media media-21x9">
            <a class="media-content" href="<?php the_permalink() ?>"
                style="background-image:url('<?php echo pandapro_the_thumbnail(null, array('w' => 400, 'h' => 200)) ?>')"><span
                    class="overlay-1"></span></a>
        </div>
        <div class="list-content">
            <div class="list-body">
                <a href="<?php the_permalink() ?>" class="list-title h6 h-2x"><?php the_title() ?></a>
            </div>
        </div>
    </div>

    <?php
					endwhile;
				else :
					echo '<div class="text-center p-3"><div class="icon-svg svg-empty svg-sm"></div>';
				endif;
				wp_reset_postdata();
				?>
</div>
<?php endif; ?>
<?php
		echo $args['after_widget'];
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

function reg_recommended_posts()
{
	register_widget("Recommended_Posts");
}

add_action('widgets_init', 'reg_recommended_posts');