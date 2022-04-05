<?php
/**
 * The template for displaying all single posts#single-post
 * Template Name: Topics Page
 * @package Panda PRO
 */

get_header();
?>
<?php
		$topic_ids = get_field('topics', get_the_ID());
	?>
<?php while ( have_posts() ) : the_post() ?>
<main class="site-main h-v-80">
    <div class="container">
        <?php if(is_array($topic_ids) && count($topic_ids) > 0): ?>
        <div class="row g-3 g-md-4 list-topic ">
            <?php foreach($topic_ids as $topic_id): ?>
            <?php $topic = get_term($topic_id['topic']); ?>
            <?php if (!is_wp_error($topic) && $topic->count > 0): ?>
            <?php $cover = get_term_meta($topic->term_id, 'cover', true); ?>
            <div class="col-lg-6">
                <div class="topic-cover block m-0">
                    <div class="media media-2x1">
                        <div class="media-content" style="background-image:url('<?php echo timthumb($cover) ?>')">
                        </div>
                    </div>
                    <div class="cover-body">
                        <div class="cover-title h2"><?php echo $topic->name ?><sup
                                class="font-theme mx-1"><?php echo $topic->count ?></sup></div>
                        <div class="cover-footer mt-1 mt-md-2">
                            <div class="h-1x"><?php echo $topic->description ?></div>
                        </div>
                    </div>
                    <a href="<?php echo get_term_link($topic->term_id) ?>" class="cover-link"></a>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</main>
<?php endwhile; ?>
<?php
get_footer();