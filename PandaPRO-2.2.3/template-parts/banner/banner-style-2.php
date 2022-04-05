<?php $panda_option = get_option('panda_option'); ?>
<?php $slides = $panda_option['index_featured_slides']; ?>
<?php if (is_array($slides) && count($slides) > 0) : ?>
<div class="index-slide slide-style-2 swiper mb-3 mb-xl-4">
    <div class="swiper-wrapper">
        <?php foreach ($slides as $slide) : ?>
        <div class="swiper-slide rounded overlay-hover">
            <div class="media media-3x1">
                <div class="media-content" style="background-image: url(<?php echo timthumb($slide['image']) ?>)"></div>
                <?php if ($slide['link']) : ?>
                <div class="media-overlay overlay-bottom">
                    <div class="h3 h-2x"><?php echo $slide['link']['title'] ?></div>
                </div>
                <?php endif; ?>
            </div>
            <a href="<?php echo $slide['link']['url'] ?>" target="_blank" class="slide-link"></a>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>
<?php endif; ?>