<?php
function register_lesson_post_type() {
    $labels = array(
        'name'               => 'Lessons',
        'singular_name'      => 'Lesson',
        'menu_name'          => 'Lessons',
        'name_admin_bar'     => 'Lesson',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Lesson',
        'new_item'           => 'New Lesson',
        'edit_item'          => 'Edit Lesson',
        'view_item'          => 'View Lesson',
        'all_items'          => 'All Lessons',
        'search_items'       => 'Search Lessons',
        'not_found'          => 'No lessons found.',
        'not_found_in_trash' => 'No lessons found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'lesson' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'lesson', $args );
}
add_action( 'init', 'register_lesson_post_type' );

// Add custom columns to the lesson post type
add_filter( 'manage_lesson_posts_columns', 'set_custom_edit_lesson_columns' );
function set_custom_edit_lesson_columns($columns) {
    $columns['lesson_number'] = 'Lesson Number';
    $columns['unit'] = 'Unit';
    $columns['difficulty'] = 'Difficulty';
    return $columns;
}

// Make custom columns sortable
add_filter( 'manage_edit-lesson_sortable_columns', 'lesson_sortable_columns' );
function lesson_sortable_columns( $columns ) {
    $columns['lesson_number'] = 'lesson_number';
    $columns['unit'] = 'unit';
    $columns['difficulty'] = 'difficulty';
    return $columns;
}