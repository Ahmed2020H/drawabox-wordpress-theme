<?php
/**
 * Drawabox Theme Functions
 *
 * @package Drawabox_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

function drawabox_theme_setup() {
    load_theme_textdomain('drawabox-theme', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-width'  => true,
        'flex-height' => true,
    ]);
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);

    register_nav_menus([
        'primary' => __('Primary Menu', 'drawabox-theme'),
        'footer'  => __('Footer Menu', 'drawabox-theme'),
    ]);

    add_image_size('lesson-thumbnail', 400, 300, true);
    add_image_size('lesson-featured', 1200, 600, true);
    add_image_size('blog-thumbnail', 600, 400, true);
}
add_action('after_setup_theme', 'drawabox_theme_setup');

function drawabox_enqueue_assets() {
    // Base stylesheet (style.css header)
    wp_enqueue_style('drawabox-style', get_stylesheet_uri(), [], '1.0.0');

    // Main CSS and responsive
    wp_enqueue_style('drawabox-main', get_template_directory_uri() . '/assets/css/main.css', ['drawabox-style'], '1.0.0');
    wp_enqueue_style('drawabox-responsive', get_template_directory_uri() . '/assets/css/responsive.css', ['drawabox-main'], '1.0.0');

    // RTL
    if (is_rtl()) {
        wp_enqueue_style('drawabox-rtl', get_template_directory_uri() . '/rtl.css', ['drawabox-main'], '1.0.0');
    }

    // JS (mobile nav)
    wp_enqueue_script('drawabox-main-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], '1.0.0', true);
    wp_localize_script('drawabox-main-js', 'drawaboxAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('drawabox-nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'drawabox_enqueue_assets');

// Safe optional includes (no fatals if missing)
foreach (['custom-post-types.php','taxonomies.php'] as $inc) {
    $path = get_template_directory() . '/inc/' . $inc;
    if (file_exists($path)) {
        require_once $path;
    }
}

// Sidebars
function drawabox_widgets_init() {
    register_sidebar([
        'name'          => __('Lesson Sidebar', 'drawabox-theme'),
        'id'            => 'lesson-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    register_sidebar([
        'name'          => __('Blog Sidebar', 'drawabox-theme'),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    register_sidebar([
        'name'          => __('Footer Widget Area', 'drawabox-theme'),
        'id'            => 'footer-widgets',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'drawabox_widgets_init');

// Excerpts
add_filter('excerpt_length', function($len){ return 30; }, 99);
add_filter('excerpt_more', function($more){
    return '... <a class="read-more" href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More', 'drawabox-theme') . '</a>';
});
