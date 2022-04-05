<?php $date = get_the_date('Y.m.d') ?>
<?php $prev_date = get_option('panda_newscat_prev_date') ?>
<?php if ($prev_date !== $date) : ?>
<?php update_option('panda_newscat_prev_date', $date) ?>
<div class="list-time-item active">
    <div class="list-time-dot"></div>
    <div class="list-time-inner">
        <div class="list-time-date font-theme h3 text-height-xs">
            <?php the_date('Y.m.d') ?>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="list-time-item">
    <div class="list-time-dot"></div>
    <div class="list-time-inner ">
        <div class="list-time-date h6 font-theme text-height-xs text-secondary mb-2">
            <?php the_time('H:i') ?>
        </div>
        <div class="list-time-card card">
            <div class="card-body">
                <div class="h5 mb-1"><?php the_title() ?></div>
                <div class="text-secondary text-height-lg">
                    <?php nc_print_excerpt(300) ?><a href="<?php the_permalink() ?>" target="_blank"
                        class="text-primary"><?php _e('[Read More]', 'pandapro') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>