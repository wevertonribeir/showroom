<?php

function produto_scheme($slug)
{
    $post_id = get_produto_id_by_slug($slug);

    if ($post_id) {
        $post_meta = get_post_meta($post_id);

        $images = get_attached_media('image', $post_id);
        $images_array = null;

        if ($images) {
            $images_array = array();
            foreach ($images as $key => $value) {
                $images_array[] = array(
                    'id' => $value->ID,
                    'titulo' => $value->post_name,
                    'src' => $value->guid,
                );
            }
        }

        $response = array(
            "id" => $slug,
            "fotos" => $images_array,
            "nome" => $post_meta['nome'][0],
            "preco" => $post_meta['preco'][0],
            "descricao" => $post_meta['descricao'][0],
            "marca" => $post_meta['marca'][0],
            "vendido" => $post_meta['vendido'][0],
            "usuario_id" => $post_meta['usuario_id'][0],
            "categorias" => wp_get_object_terms($post_id, 'category', array('fields' => 'all')),
        );
    } else {
        $response = new WP_Error('naoexiste', 'Produto não encontrado', array('status' => 404));
    }
    return $response;
}

function api_produto_get($request)
{
    $user = wp_get_current_user();
    $user_id = $user->ID;
    if($user_id > 0){
        $response = produto_scheme($request["slug"]);
    }else {
        $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
    }
    
    return rest_ensure_response($response);
}

function registrar_api_produto_get()
{
    register_rest_route('api', '/produto/(?P<slug>[-\w]+)', array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'api_produto_get',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_produto_get');

function api_produtos_get($request)
{

    $user = wp_get_current_user();
    $user_id = $user->ID;

    if ($user_id > 0) {
        $query = array(
            'post_type' => 'produto',
        );

        $loop = new WP_Query($query);
        $posts = $loop->posts;

        $produtos = array();
        foreach ($posts as $key => $value) {
            $produtos[] = produto_scheme($value->post_name);
        }
    } else {
        $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
    }

    return rest_ensure_response($produtos);
}

function registrar_api_produtos_get()
{
    register_rest_route('api', '/produto', array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'api_produtos_get',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_produtos_get');
