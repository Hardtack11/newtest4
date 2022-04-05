<?php
/**
 * The template for displaying all single posts#single-post
 *
 * @package Panda PRO
 */
$panda_option = get_option('panda_option');
$mod_mode = $panda_option['mod_mode'] ?? false;
get_header();
?>
    <?php while ( have_posts() ) : the_post() ?>
		<main class="site-main ">
			<div class="container">
				<div class="row">
					<div class="content-wrapper col-lg-8">
						<div class="post card card-md">
							<div class="card-body">
								<h1 class="mb-2 mb-md-3 mb-xl-4">
									<?php the_title() ?><?php edit_post_link('<i class="iconfont icon-edit-square ms-2"></i>', '', ''); ?>
								</h1>
								<div class="post-content">
									<?php the_content() ?>
									<?php get_template_part( 'template-parts/wp-link-pages' ); ?>
								</div>
								<?php get_template_part('template-parts/ad/single-footer-ad'); ?>
								
							</div>
						</div>
						<?php
							if ( (comments_open() || get_comments_number()) ) :
								if (($mod_mode && is_user_logged_in()) || !$mod_mode) {
									comments_template();
								}
							endif;
						?>
					</div>
					<?php get_sidebar() ?>
				</div>
			</div>
		</main>

    <?php endwhile; ?>
<?php
get_footer();
