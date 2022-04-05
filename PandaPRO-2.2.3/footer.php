<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Panda PRO
 */
$panda_option = get_option('panda_option');
$footer_bottom = $panda_option['footer_bottom'];
$footer_text = $footer_bottom['footer_text'];
$miitbeian = $footer_bottom['miitbeian'];
$miitbeian_button = $footer_bottom['miitbeian_button'];
$gabeian_button = $footer_bottom['gabeian_button'];
$gabeian = $footer_bottom['gabeian'];
$gabeian_link = $footer_bottom['gabeian_link'];
?>

<footer class="footer bg-white py-3 py-md-4">

    <div class="container">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-center justify-content-lg-between mt-lg-2">
        <?php if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('footer-menu') ) {?>
        <div class="footer-menu mt-2 mt-md-3 mt-lg-0">
            <ul>
                <?php  wp_nav_menu( array(  'container'=> false , 'theme_location' => 'footer-menu' , 'items_wrap' => '%3$s','depth'=>1) ); ?>
            </ul>
        </div>
        <?php } ?>
        <?php get_template_part('template-parts/social-connect') ?>
    
        </div>
        <div class="footer-copyright text-center text-lg-start text-xs text-muted mt-3">
            <?php
                if ($gabeian_button) : $footer_text .= ' <a href="'.$gabeian_link.'" rel="nofollow"><i class="icon icon-beian"></i>'.$gabeian.'</a> '; endif;
                if ($miitbeian_button) : $footer_text .= ' <a href="http://beian.miit.gov.cn/" rel="nofollow">'.$miitbeian.'</a>'; endif;
                echo 'Copyright © '.pandapro_get_footer_year().' <a href="'.get_bloginfo('url').'" title="'.get_bloginfo('name').'" rel="home">'.get_bloginfo('name').'</a>. Designed by <a href="https://www.nicetheme.cn" title="nicetheme奈思主题-资深的原创WordPress主题开发团队" target="_blank">nicetheme</a>. '.$footer_text;
            ?>
        </div>
        <?php if ((is_home() || $panda_option['links_global']) && $panda_option['links'] === '1'): ?>
    <div class="footer-links justify-content-center justify-content-lg-start text-xs text-muted border-top border-light pt-3 pt-md-4 mt-3 mt-md-4">
        
        <?php $links_cat = get_term($panda_option['links_cat'], 'link_category'); ?>
        <span class="me-2"><?php echo is_wp_error($links_cat) ? __('Partners: ', 'pandapro') : $links_cat->name.': ' ?></span>
        <?php
            $bookmarks = get_bookmarks(array(
                'orderby' => 'rating',
                'category' => $panda_option['links_cat']
            ));
        ?>
        <?php foreach($bookmarks as $bookmark): ?>
            <a href="<?php echo $bookmark->link_url ?>" target="<?php echo $bookmark->link_target ?>"><?php echo $bookmark->link_name ?></a>
        <?php endforeach; ?>
     
    </div>
    <?php endif; ?>
    </div>
   

</footer>
<ul class="scroll-fixed-menu">
    <li id="scrollToTOP" class="scroll-to-top">
        <button class="btn btn-primary btn-icon btn-rounded"><span><i class="iconfont icon-arrowup"></i></span></button>
    </li>
</ul>
<div class="mobile-overlay"></div>
<?php wp_footer(); ?>
</body>
</html>