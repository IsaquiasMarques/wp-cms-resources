<?php

class Advertisement{

   
    public static function first_level(){

        $details = [
            'image' => get_field('imagem-ads-1', 'options'),
            'link' => get_field('link-ads-1', 'options')
        ];

        $res['data']['status'] = 200;
        $res['data']['res'] = $details;

        return $res;
    }

    public static function second_level(){
        $details = [
            'image' => get_field('imagem-ads-2', 'options'),
            'link' => get_field('link-ads-2', 'options')
        ];

        $res['data']['status'] = 200;
        $res['data']['res'] = $details;

        return $res;
    }

    public static function third_level(){
        $details = [
            'image' => get_field('imagem-ads-3', 'options'),
            'link' => get_field('link-ads-3', 'options')
        ];

        $res['data']['status'] = 200;
        $res['data']['res'] = $details;

        return $res;
    }

    public static function fourth_level(){

        $double_ads = get_field('anuncios_duplicados', 'options');
        $horizontal_ads = get_field('anuncio_horizontal', 'options');
        
        $details = [
            'double_ads' => $double_ads,
            'horizontal_ads' => $horizontal_ads
        ];

        $res['data']['status'] = 200;
        $res['data']['res'] = $details;

        return $res;

    }

    public static function fifth_level(){
        $details = [
            'image' => get_field('imagem-ads-5', 'options'),
            'link' => get_field('link-ads-5', 'options')
        ];

        $res['data']['status'] = 200;
        $res['data']['res'] = $details;

        return $res;
    }

}