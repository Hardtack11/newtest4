<div class="list-item image block">
    <div class="list-content">
        <div class="list-body">
            <div class="media media-3x1 mb-2 mb-md-3">
                <a class="media-content" title="<?php the_title() ?>" href="<?php the_permalink() ?>" style="background-image:url('<?php pandapro_the_thumbnail() ?>')"></a>
            </div>
            <a class="list-title h5 mb-md-2" title="<?php the_title() ?>" href="<?php the_permalink() ?>" ><?php pandapro_the_sticky_tag(); pandapro_the_featured_tag(); ?><?php the_title() ?></a>
            <div class="list-desc d-none d-md-block text-secondary text-sm">
                <div class="h-2x "><?php nc_print_excerpt(100) ?></div>
            </div>
        </div>
        <div class="list-footer mt-2">
            <?php get_template_part("template-parts/post-cards/card-meta"); ?>
        </div>
    </div>
</div>