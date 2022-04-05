<?php $panda_option = get_option( 'panda_option' ) ?>
<?php $social_connect = $panda_option['social_connect'] ?>
<?php if ( isset( $panda_option['social_connect_open'] ) && $panda_option['social_connect_open'] === '1' ): ?>
    <div class="footer-social mt-3 mt-lg-0">
		<?php if ( ! empty( $social_connect['qq']['title'] ) ): ?>
            <a href="javascript:"
                                                data-img="<?php echo timthumb( $social_connect['qq']['img'] ) ?>"
                                                data-title="<?php echo $social_connect['qq']['title'] ?>"
                                                data-desc="<?php echo $social_connect['qq']['desc'] ?>"
                                                class="single-popup btn btn-light btn-sm btn-qq btn-icon btn-rounded">
            <span><i class="iconfont icon-QQ"></i>
        </a>
		<?php endif; ?>
		<?php if ( ! empty( $social_connect['weixin']['title'] ) ): ?>
            <a href="javascript:"
                                                data-img="<?php echo timthumb( $social_connect['weixin']['img'] ) ?>"
                                                data-title="<?php echo $social_connect['weixin']['title'] ?>"
                                                data-desc="<?php echo $social_connect['weixin']['desc'] ?>"
                                                class="single-popup btn btn-light btn-sm btn-weixin btn-icon btn-rounded">
            <span><i class="iconfont icon-wechat"></i>
        </a>
		<?php endif; ?>
		<?php if ( ! empty( $social_connect['weibo'] ) ): ?>
            <a href="<?php echo $social_connect['weibo'] ?>" rel="nofollow"
                                                class="btn btn-light btn-sm btn-icon btn-rounded">
            <span><i class="iconfont icon-weibo"></i>
        </a>
		<?php endif; ?>
		<?php if ( ! empty( $social_connect['facebook'] ) ): ?>
            <a href="<?php echo $social_connect['facebook'] ?>" rel="nofollow"
                                                class="btn btn-light btn-sm btn-icon btn-rounded">
            <span><i class="iconfont icon-facebook1"></i>
        </a>
		<?php endif; ?>
		<?php if ( ! empty( $social_connect['twitter'] ) ): ?>
            <a href="<?php echo $social_connect['twitter'] ?>" rel="nofollow"
                                                class="btn btn-light btn-sm btn-icon btn-rounded">
            <span><i class="iconfont icon-twitter"></i>
        </a>
		<?php endif; ?>
		<?php if ( ! empty( $social_connect['instagram'] ) ): ?>
            <a href="<?php echo $social_connect['instagram'] ?>" rel="nofollow"
                                                class="btn btn-light btn-sm btn-icon btn-rounded">
            <span><i class="iconfont icon-instagram-fill"></i>
        </a>
		<?php endif; ?>
		<?php if ( ! empty( $social_connect['Youtube'] ) ): ?>
            <a href="<?php echo $social_connect['Youtube'] ?>" rel="nofollow"
                                                class="btn btn-light btn-sm btn-icon btn-rounded">
            <span><i class="iconfont icon-Youtube-fill"></i>
        </a>
		<?php endif; ?>
		<?php if ( ! empty( $social_connect['behance'] ) ): ?>
            <a href="<?php echo $social_connect['behance'] ?>" rel="nofollow"
                                                class="btn btn-light btn-sm btn-icon btn-rounded">
            <span><i class="iconfont icon-behance"></i>
        </a>
		<?php endif; ?>
		<?php if ( ! empty( $social_connect['email'] ) ): ?>
            <a href="mailto:<?php echo $social_connect['email'] ?>"
                                                class="btn btn-light btn-sm btn-icon btn-rounded">
            <span><i class="iconfont icon-mail-fill"></i>
        </a>
		<?php endif; ?>
    </div>
<?php endif; ?>