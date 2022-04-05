<?php
/**
 * The template for displaying all single posts#single-post
 * Template Name: Links Page
 * @package Panda PRO
 */

get_header();
$link_cats = get_field('link_cats', get_the_ID());
?>
    <?php while ( have_posts() ) : the_post() ?>
		<main class="site-main h-v-80">
		    <div class="container">
				<div class="post card card-md">
					<div class="card-body">
						<div class="post-header mb-3 mb-md-4">
							<h1><?php the_title() ?><?php edit_post_link('<i class="iconfont icon-edit-square ms-2"></i>', '', ''); ?></h1>
						</div>
						<div class="post-content">
							<?php the_content() ?>
							<?php get_template_part( 'template-parts/wp-link-pages' ); ?>
						</div>
					
						<?php if (is_array($link_cats) && count($link_cats) > 0): ?>
							<?php foreach ($link_cats as $link_cat): ?>
							<?php
								$cat = get_term($link_cat['cat'], 'link_category');
								$links = get_bookmarks(array(
									'category' => $link_cat['cat'],
									'orderby' => 'rating'
								));
							?>
							<div class="friends-grid">
								<div class="friends-heading h6"><?php echo $cat->name ?></div>
								<div class="friends-group row g-2 g-md-3">
								<?php foreach($links as $link): ?>
									<div class="col-6 col-md-3 col-xl-2">
										<div class="friend-item">
											<div class="media w-24 rounded-circle">
												<div class="media-content" style="background-image:url('<?php echo !empty($link->link_image) ? $link->link_image : get_template_directory_uri() . '/images/default-avatar.png'; ?>')"></div>
											</div>
											<div class="h-1x"><?php echo $link->link_name; ?></div>
											<a href="<?php echo $link->link_url; ?>" target="<?php echo $link->link_target; ?>" class="friend-goto"></a>
										</div>
									</div>
								<?php endforeach; ?>
								</div>
							</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
				<?php
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;
				?>
		    </div>
		</main>
    <?php endwhile; ?>
<?php
get_footer();
