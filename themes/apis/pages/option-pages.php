<?php

if( function_exists('acf_add_options_page') ){
    acf_add_options_page(array(
        'page_title' => 'Anúncio de Serviço',
        'menu_title' => 'Anúncio de Serviço',
        'menu_slug' => 'anuncio-de-servico',
        'capability' => 'edit_posts',
        'redirect' => false,
        'icon_url' => 'dashicons-megaphone',
        'position' => 6,
    ));
}