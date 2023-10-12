<?php

require_once(TEMPLATEPATH . "/Utils/Geral.php");
require_once(TEMPLATEPATH . "/Utils/Util.php");
require_once(TEMPLATEPATH . "/Utils/Advertisement.php");

class Ads{

    public function __construct()
    {
        $this->namespace = 'wp/v2';
        $this->endpointFirstLevel = '/ads-level-1';
        $this->endpointSecondLevel = '/ads-level-2';
        $this->endpointThirdLevel = '/ads-level-3';
        $this->endpointFourthLevel = '/ads-level-4';
        $this->endpointFifthLevel = '/ads-level-5';
    }

    public function registerRoute()
    {
        Geral::registerRoute('GET', 'get_first_level', $this, $this->namespace, $this->endpointFirstLevel);
        Geral::registerRoute('GET', 'get_second_level', $this, $this->namespace, $this->endpointSecondLevel);
        Geral::registerRoute('GET', 'get_third_level', $this, $this->namespace, $this->endpointThirdLevel);
        Geral::registerRoute('GET', 'get_fourth_level', $this, $this->namespace, $this->endpointFourthLevel);
        Geral::registerRoute('GET', 'get_fifth_level', $this, $this->namespace, $this->endpointFifthLevel);
    }

    public function get_first_level(){
        return Advertisement::first_level();
    }
    public function get_second_level(){
        return Advertisement::second_level();
    }
    public function get_third_level(){
        return Advertisement::third_level();
    }
    public function get_fourth_level(){
        return Advertisement::fourth_level();
    }
    public function get_fifth_level(){
        return Advertisement::fifth_level();
    }

}


function registerAdsRoutes(){
    $home = new Ads();
    $home->registerRoute();
}

add_action('rest_api_init', 'registerAdsRoutes');