<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Panda PRO
 */

get_header();
?>
<main class="site-main">
    <div class="container">
        <div class="content-error d-flex flex-fill align-items-center h-v-80">
            <div class="text-center p-5 mx-auto">
                <div class="d-inline-block svg-lg svg-404"></div>
                <h1 class="display-1 font-theme">404</h1>
                <h4 class="py-4"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'pandapro' ); ?></h4>
                <p class="text-muted"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'pandapro' ); ?></p>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
