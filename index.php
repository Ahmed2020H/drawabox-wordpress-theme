<?php
/**
 * Main template file
 *
 * @package Drawabox_Theme
 */

get_header();
?>

<main id="primary" class="site-main container">
    <div class="content-area">
        <?php if (have_posts()) : ?>
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    if (is_home() && !is_front_page()) :
                        single_post_title();
                    else :
                        _e('Blog', 'drawabox-theme');
                    endif;
                    ?>
                </h1>
            </header>

            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;
                ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('&laquo; Previous', 'drawabox-theme'),
                'next_text' => __('Next &raquo;', 'drawabox-theme'),
            ));
            ?>

        <?php else : ?>
            <div class="no-results">
                <h2><?php _e('Nothing Found', 'drawabox-theme'); ?></h2>
                <p><?php _e('It seems we can\'t find what you\'re looking for.', 'drawabox-theme'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>