<?php

require_once(TEMPLATEPATH . "/Utils/Geral.php");
require_once(TEMPLATEPATH . "/Utils/Util.php");
require_once(TEMPLATEPATH . "/Utils/Advertisement.php");

class Home{

    public function __construct()
    {
        $this->namespace = 'wp/v2';
        $this->endpointBannerPosts = '/banner-posts';
        $this->endpointHighlightPosts = '/highlight-posts';
    }

    public function registerRoute()
    {
        Geral::registerRoute('GET', 'get_banner_posts', $this, $this->namespace, $this->endpointBannerPosts);
        Geral::registerRoute('GET', 'get_highlight_posts', $this, $this->namespace, $this->endpointHighlightPosts);
    }

    public function get_banner_posts(){
        return Util::get_by_acf_fields('incluir_no_banner');
    }

    public function get_highlight_posts(){
        return Util::get_by_acf_fields('incluir_nos_destaques', 9);
    }

    
}


function registerRoute(){
    $home = new Home();
    $home->registerRoute();
}

add_action('rest_api_init', 'registerRoute');