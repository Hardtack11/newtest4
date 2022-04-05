<?php global $post ?>
<div class="list-item block ">
    <div class="list-content p-0">
        <div class="list-body">
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="list-title h5 h-2x"><?php pandapro_the_sticky_tag(); pandapro_the_featured_tag(); ?><?php the_title() ?></a>
            <div class="list-desc text-sm text-secondary mt-2">
                <div class="h-2x "><?php nc_print_excerpt(100) ?></div>
            </div>
        </div>
        <div class="list-footer mt-2">
            <?php get_template_part("template-parts/post-cards/card-meta"); ?>
        </div>
    </div>
</div>