<?php $thumbnails = pandapro_more_post_thumbnails() ?>
<div class="list-item image block">
    <div class="list-content">
        <div class="list-body ">
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="list-title h5 h-2x mb-2 mb-xl-2"><?php pandapro_the_sticky_tag(); pandapro_the_featured_tag(); ?><?php the_title() ?></a>
            <div class="list-desc d-none d-md-block text-secondary text-sm mb-2 mb-xl-3">
                <div class="h-2x"><?php nc_print_excerpt(100) ?></div>
            </div>
            <div class="row gx-1 gx-md-2 mb-2 mb-xl-3">
                <?php foreach(array_slice($thumbnails, 0, 3) as $thumbnail): ?>
                <div class="col-4">
                    <div class="media media-3x2">
                        <a class="media-content" title="<?php the_title() ?>" href="<?php the_permalink() ?>" style="background-image: url('<?php echo timthumb($thumbnail, array('w' => 300, 'h' => 200)) ?>');"></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="list-footer mt-2">
            <?php get_template_part("template-parts/post-cards/card-meta"); ?>
        </div>
    </div>
</div>