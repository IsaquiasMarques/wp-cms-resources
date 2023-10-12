<?php

class Util {

    public static function getAllCategoriesFromDataStored(string $key, string $acf_field, string $state, string $operator = '=', int $limit = -1, string $acf_key)
    {

        $projects_stored = Geral::getPostByFilter($key, $acf_field, $state, $operator, $limit);
        $categories = [];
        $reserv = [];

        // return $projects_stored;

        foreach ($projects_stored['data']['res'] as $project){
            $reserv[] =  $project[$acf_key];
        }

        foreach(array_unique($reserv) as $re){
            // $categories[] = $re;
            
            $id_cat = get_cat_id($re);
            $categories[] = [
                "id" => $id_cat,
                "category" => $re
                ];
            
        }
        
        // $categories[] = array_unique($reserv);

        return $categories;

    }

    public static function getPostDetails(int $id, string $page = 'post-details')
    {
        $post = get_post($id);

        if(!empty($post) && $post->post_type === "post"){
                
            $ID = $post->ID;
            $post_title = $post->post_title;
            $post_content = $post->post_content;

            $post_category = humanizePostsCategories($ID);

            $slug = get_post( $ID );

            $post_highlight = get_the_excerpt( $ID );

            $author = author($post->post_author);

            $post_image_size = !($page === "post-details") ? 'medium' : 'full';
            $post_banner_image = get_the_post_thumbnail_url( $ID, $post_image_size );


            $post_time_to_read = get_field('tempo_de_leitura', $ID, 'options');

            $created_at = human_readable_post_created_at(strtotime( get_the_date('Y-m-d H:i:s', $ID) ));

            $res = self::post_response_format(
                    $ID, 
                    $post_title,
                    $slug->post_name,
                    $post_category,
                    !($page === "post-details") ? '' : $post_content,
                    $post_highlight,
                    $author,
                    // pvc_get_post_views($ID),
                    33,
                    // get_comments_number( $ID ),
                    368,
                    // $post_time_to_read,
                    '16 minutos de Leitura',
                    $created_at,
                    $post_banner_image
            );

        }else{
            $res = Geral::resposta_404( );
        }

        return $res;

    }

    public static function get_by_acf_fields($field_type, $limit_posts = 6){
        $posts = Geral::getPostByFilter('post', $field_type, true, '=', $limit_posts);

        if($field_type === "incluir_no_banner"){
            foreach($posts as $key => $post){
                if($key === 0){
                    $posts[$key]['active'] = true;
                }else{
                    $posts[$key]['active'] = false;
                }
            }
        }
        
        return $posts;
    }
    
    public static function post_response_format($id_post, $title, $slug, $category, $description = '', $highlight, $author = '', $views, $comments, $time_read, $created_at, $img)
    {
        return [
             'id' => $id_post,
             'slug' => $slug,
             'title' => [ 'rendered' => $title ],
             'content' => [ 'rendered' => $description ],
             'categories' => $category ?? null,
             'posted_at' => $created_at,
             'custom_author' => $author,
             'images_size_custom' => $img ?? null,
             'views' => $views,
             'comments' => $comments,
             'time_read' => $time_read,
             'highlight' => $highlight,
         ];
    }

    public static function post($posts){
        
        while($posts->have_posts()):
            $posts->the_post();

            $ID = get_the_ID();
            $post = get_post( $ID );

            $post_categories = humanizePostsCategories( $ID );

            $author = author($post->post_author);

            $post_highlight = get_the_excerpt();
            $post_time_to_read = get_field('tempo_de_leitura', $ID, 'options');

            $post_banner_image = images_custom( $ID );

            $created_at = human_readable_post_created_at( $ID );
            
            $res[] = self::post_response_format(
                $ID,
                get_the_title(),
                $post->post_name,
                $post_categories,
                // get_the_content( '', false, $ID ),
                '',
                $post_highlight,
                $author,
                get_views_number_func($ID),
                get_comments_number_func($ID),
                $post_time_to_read,
                $created_at,
                $post_banner_image
            );

            $dados = $res;

        endwhile;

        return $dados;

    }
    
}