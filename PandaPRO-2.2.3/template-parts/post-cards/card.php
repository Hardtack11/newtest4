<?php global $post; ?>
<div class="list-item default block">
    <div class="media media-3x2 col-4 col-md-3 col-xl-4">
        <a class="media-content" href="<?php the_permalink() ?>" title="<?php the_title() ?>"
            style="background-image:url('<?php pandapro_the_thumbnail() ?>')"></a>
    </div>
    <div class="list-content">
        <div class="list-body">
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"
                class="list-title h5 h-2x"><?php pandapro_the_sticky_tag();
                                                                                                        pandapro_the_featured_tag(); ?><?php the_title() ?></a>
            <div class="list-desc d-none d-xl-block text-secondary text-sm mt-2">
                <div class="h-2x "><?php nc_print_excerpt(100) ?></div>
            </div>
        </div>
        <div class="list-footer">
            <?php get_template_part("template-parts/post-cards/card-meta"); ?>
        </div>
    </div>
</div>