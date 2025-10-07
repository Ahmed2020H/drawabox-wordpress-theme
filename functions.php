<?php
// Theme setup
function drawabox_setup() {
    // Add support for automatic feed links
    add_theme_support('automatic-feed-links');
    // Add support for title tag
    add_theme_support('title-tag');
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'drawabox'),
    ));
}
add_action('after_setup_theme', 'drawabox_setup');

// Enqueue assets
function drawabox_enqueue_assets() {
    // Enqueue styles
    wp_enqueue_style('main-style', get_stylesheet_uri());
    // Enqueue scripts
    wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'drawabox_enqueue_assets');

// Register widget area
function drawabox_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'drawabox'),
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'drawabox_widgets_init');

// Include additional files
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/enqueue.php';
?>