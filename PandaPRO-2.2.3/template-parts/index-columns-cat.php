<?php
    $panda_option = get_option('panda_option');
?>
<?php if ($panda_option['index_featured_columns_switch'] ?? false): ?>
<div class="index-columns-cat swiper mb-3 mb-md-4">
    <div class="swiper-wrapper">
        <?php foreach(($panda_option['index_featured_columns'] ?? array()) as $column): ?>
        <?php 
            $type = $column['type'] ?? 'category';
            $term = get_term($column[$type], $type);
        ?>
            <?php if (!is_wp_error($term)): ?>
                <?php $cover = get_term_meta($term->term_id, 'cover', true) ?>
                <div class="swiper-slide">
                    <div class="list-item overlay-hover rounded">
                        <div class="media media-2x1">
                            <div class="media-content" style="background-image: url(<?php echo timthumb($cover) ?>);">
                                <div class="overlay-1"></div>
                            </div>
                        </div>
                        <div class="list-content">
                            <div class="text-center h-1x ">
                                <?php echo $term->name ?>
                            </div>
                        </div>
                        <a href="<?php echo get_term_link($term) ?>"  class="list-goto"></a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach ?>
    </div>
</div>
<?php endif; ?>