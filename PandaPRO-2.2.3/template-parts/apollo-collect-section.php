<?php if (defined('NC_APOLLO_DIR')) : ?>
<button x-data="apolloPostCollect" type="button"
    :class="{ 'btn btn-light btn-collect btn-w-md btn-rounded me-2': true, 'active': collected }" @click="collect"
    :disabled="loading">
    <i class="text-lg iconfont icon-star"></i> <span class="collect-count" x-text="count"></span>
</button>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('apolloPostCollect', () => ({
        nonce: '<?php echo wp_create_nonce('ajax_apollo_collection_' . get_the_ID()); ?>',
        count: <?php echo get_post_collection_count(get_the_ID()) ?: '0' ?>,
        collected: <?php echo is_collection(get_current_user_id(), get_the_ID()) ? 'true' : 'false' ?>,
        postId: <?php the_ID(); ?>,
        loading: false,
        collect() {
            this.loading = true

            $.ajax({
                    url: globals.ajax_url,
                    type: "POST",
                    dataType: "json",
                    data: {
                        action: "apollo-collection",
                        nonce: this.nonce,
                        id: this.postId
                    },
                })
                .done(({
                    status,
                    type,
                    points,
                    msg
                }) => {
                    if (status !== 200) {
                        ncPopupTips(0, msg);
                        return
                    }
                    ncPopupTips(+type, msg);
                    if (type === 1) {
                        this.count += 1
                        this.collected = true
                        return
                    }
                    this.count -= 1
                    this.collected = false
                })
                .fail(() => {
                    ncPopupTips(
                        0,
                        __("Network error, please try again later.", "apollo")
                    );
                }).always(() => {
                    this.loading = false
                });
        }
    }))
})
</script>

<?php endif; ?>