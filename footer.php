    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="footer-widgets container">
            <?php if (is_active_sidebar('footer-widgets')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-widgets'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer-navigation">
            <div class="container">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_id' => 'footer-menu',
                    'menu_class' => 'footer-nav-menu',
                    'container' => 'nav',
                    'container_class' => 'footer-nav',
                    'fallback_cb' => false,
                    'depth' => 1,
                ));
                ?>
            </div>
        </div>

        <div class="site-info container">
            <p>
                &copy; <?php echo date('Y'); ?> 
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
                <?php esc_html_e('All rights reserved.', 'drawabox-theme'); ?>
            </p>
            <p>
                <?php
                printf(
                    esc_html__('Theme: Drawabox Learning | Developed by %s', 'drawabox-theme'),
                    '<a href="https://github.com/Ahmed2020H" target="_blank" rel="noopener">Ahmed2020H</a>'
                );
                ?>
            </p>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>