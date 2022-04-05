<?php
$panda_option = get_option('panda_option');
$mod_mode = $panda_option['mod_mode'] ?? false;
$category = get_the_category();
global $post;
?>
<?php $is_liked = isset( $_COOKIE[ 'suxing_ding_' . $post->ID ] ); ?>
<main class="site-main">
    <div class="container">
		<?php pandapro_breadcrumbs() ?>
		<?php
		$video_url = get_post_meta( get_the_ID(), 'video_url', true );
		if ( ! empty( $video_url ) ) {
			echo '<div class="post-video mb-2 mb-md-4">';
			echo apply_filters( 'the_content', $video_url );
			echo '</div>';
		}
		?>
        <div class="row">
            <div class="content-wrapper col-lg-8">
                <div class="post card card-md">
                    <div class="card-body">
                        <?php get_template_part('template-parts/post-title/style-2') ?>
                        <?php get_template_part('template-parts/ad/single-ad'); ?>
                        <div class="post-content">
                            <?php get_template_part('template-parts/post-content-control'); ?>
                        </div>
                        <?php the_tags('<div class="post-tags mt-3 mt-md-4"><div class=""><span>#', '</span><span>#', '</span></div></div>'); ?>
                        <?php get_template_part('template-parts/post-share-section') ?>
                        <?php get_template_part('template-parts/post-author-section') ?>
                        <?php get_template_part('template-parts/ad/single-footer-ad'); ?>
                    </div>
                </div>
				<?php
                if ((comments_open() || get_comments_number())) :
                    if (($mod_mode && is_user_logged_in()) || !$mod_mode) {
                        comments_template();
                    }
                endif;
                ?>
                <?php get_template_part('template-parts/related-posts') ?>
            </div>
			<?php get_sidebar() ?>
        </div>
    </div>
</main>