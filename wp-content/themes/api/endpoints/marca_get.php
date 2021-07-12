<?php

function marca_scheme($slug)
{
    $post_id = get_marca_id_by_slug($slug);

    if ($post_id) {
        $post_meta = get_post_meta($post_id);

        $images = get_attached_media('image', $post_id);
        $images_array = null;

        if ($images) {
            $images_array = array();
            foreach ($images as $key => $value) {
                $images_array[] = array(
                    'titulo' => $value->post_name,
                    'src' => $value->guid,
                );
            }
        }

        $response = array(
            "id" => $slug,
            "fotos" => $images_array,
            "nome" => $post_meta['nome'][0],
            "usuario_id" => $post_meta['usuario_id'][0],
        );
    } else {
        $response = new WP_Error('naoexiste', 'Produto não encontrado', array('status' => 404));
    }
    return $response;
}

function api_marca_get($request)
{
    $user = wp_get_current_user();
    $user_id = $user->ID;
    if($user_id > 0){
        $response = marca_scheme($request["slug"]);
    }else {
        $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
    }
    
    return rest_ensure_response($response);
}

function registrar_api_marca_get()
{
    register_rest_route('api', '/marca/(?P<slug>[-\w]+)', array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'api_marca_get',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_marca_get');

function api_marcas_get($request)
{

    $user = wp_get_current_user();
    $user_id = $user->ID;

    if ($user_id > 0) {
        $query = array(
            'post_type' => 'marca',
        );

        $loop = new WP_Query($query);
        $posts = $loop->posts;

        $marcas = array();
        foreach ($posts as $key => $value) {
            $marcas[] = marca_scheme($value->post_name);
        }
    } else {
        $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
    }

    return rest_ensure_response($marcas);
}

function registrar_api_marcas_get()
{
    register_rest_route('api', '/marca', array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'api_marcas_get',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_marcas_get');
