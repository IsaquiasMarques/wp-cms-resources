<?php

add_action('init', 'create_custom_posts');

function create_custom_posts(){

    register_post_type('brochuras', [
        'label' => 'Brochuras',
        'description' => 'Gestão de brochuras',
        'public' => true,
        'show_ui' => true,
        'capabiliy_type' => 'post',
        'rewrite' => [ 'slug' => 'brochuras', 'with_front' => true ],
        'query_var' => true,
        'publicly_queriable' => true,
        'show_in_rest' => true,
        'rest_base' => 'brochuras',
        'menu_icon' => 'dashicons-media-document',
        'supports' => [ 'custom_fields', 'categories' ],
        'taxonomies' => ['category' ]
    ]);

}