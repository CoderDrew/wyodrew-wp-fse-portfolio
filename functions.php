<?php

/**
 * wyodrew Theme Functions
 *
 * FSE themes don't need traditional theme support declarations.
 * Most functionality is handled by theme.json.
 */

/**
 * Enqueue theme styles and scripts
 */
function wyodrew_enqueue_styles()
{
    wp_enqueue_style('wyodrew-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Enqueue header scroll script
    wp_enqueue_script(
        'wyodrew-header-scroll',
        get_template_directory_uri() . '/assets/js/header-scroll.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'wyodrew_enqueue_styles');

function wyodrew_enqueue_hero_logo_animation()
{
    if (is_front_page()) {
        wp_enqueue_script(
            'wyodrew-hero-logo',
            get_template_directory_uri() . '/assets/js/hero-logo.js',
            [],
            '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'wyodrew_enqueue_hero_logo_animation');


/**
 * Register custom block styles
 */
function wyodrew_register_block_styles()
{
    register_block_style(
        'core/group',
        array(
            'name'  => 'tech-card',
            'label' => 'Tech Card',
        )
    );
}
add_action('init', 'wyodrew_register_block_styles');

/**
 * Register Custom Post Type: Projects
 */
function wyodrew_register_projects_cpt()
{
    $labels = array(
        'name'                  => 'Projects',
        'singular_name'         => 'Project',
        'menu_name'             => 'Projects',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Project',
        'edit_item'             => 'Edit Project',
        'new_item'              => 'New Project',
        'view_item'             => 'View Project',
        'search_items'          => 'Search Projects',
        'not_found'             => 'No projects found',
        'not_found_in_trash'    => 'No projects found in trash',
        'all_items'             => 'All Projects',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'show_in_rest'          => true,
        'rest_base'             => 'projects',
        'menu_icon'             => 'dashicons-portfolio',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
        'rewrite'               => array('slug' => 'project'),
        'show_in_nav_menus'     => true,
        'menu_position'         => 5,
    );

    register_post_type('project', $args);
}
add_action('init', 'wyodrew_register_projects_cpt');

/**
 * Register Custom Taxonomy: Project Categories
 */
function wyodrew_register_project_category_taxonomy()
{
    $labels = array(
        'name'              => 'Project Categories',
        'singular_name'     => 'Project Category',
        'search_items'      => 'Search Project Categories',
        'all_items'         => 'All Project Categories',
        'edit_item'         => 'Edit Project Category',
        'update_item'       => 'Update Project Category',
        'add_new_item'      => 'Add New Project Category',
        'new_item_name'     => 'New Project Category Name',
        'menu_name'         => 'Categories',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rest_base'         => 'project-categories',
        'show_admin_column' => true,
        'rewrite'           => array('slug' => 'project-category'),
    );

    register_taxonomy('project-category', array('project'), $args);
}
add_action('init', 'wyodrew_register_project_category_taxonomy');
