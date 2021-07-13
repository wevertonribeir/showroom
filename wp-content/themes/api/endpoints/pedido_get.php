<?php

function pedido_scheme($slug)
{
    $post_id = get_pedido_id_by_slug($slug);

    if ($post_id) {
        $post_meta = get_post_meta($post_id);

        $response = array(
            "id" => $slug,
            "loja" => $post_meta['loja'][0],
            "caixa" => $post_meta['caixa'][0],
            "operador" => $post_meta['operador'][0],
            "data" => $post_meta['data'][0],
            "hora" => $post_meta['hora'][0],
            "n" => $post_meta['n'][0],
            "cliente" => $post_meta['cliente'][0],
            "vendedor" => $post_meta['vendedor'][0],
            "produtos" => $post_meta['produtos'][0],
            "total" => $post_meta['total'][0],
            "count_total" => $post_meta['count_total'][0],
            "obs" => $post_meta['obs'][0],
            "adicionais" => $post_meta['adicionais'][0],
            "status" => $post_meta['status'][0],
            "usuario_id" => $post_meta['usuario_id'][0],
            "rua" => $post_meta['rua'][0],
            "cep" => $post_meta['cep'][0],
            "numero" => $post_meta['numero'][0],
            "bairro" => $post_meta['bairro'][0],
            "cidade" => $post_meta['cidade'][0],
            "estado" => $post_meta['estado'][0],
            "cpf" => $post_meta['cpf'][0],
            "cnpj" => $post_meta['cnpj'][0],
            "nomefantasia" => $post_meta['nomefantasia'][0],
            "rg" => $post_meta['rg'][0],
            "nascimento" => $post_meta['nascimento'][0],
        );
    } else {
        $response = new WP_Error('naoexiste', 'pedido não encontrado', array('status' => 404));
    }
    return $response;
}

function api_pedidos_get($request)
{

    $user = wp_get_current_user();
    $user_id = $user->ID;

    if ($user_id > 0) {
        $query = array(
            'post_type' => 'pedido',
        );

        $loop = new WP_Query($query);
        $posts = $loop->posts;

        $pedidos = array();
        foreach ($posts as $key => $value) {            
            $pedidos[] = pedido_scheme($value->post_name);
        }
    } else {
        $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
    }

    return rest_ensure_response($pedidos);
}

function registrar_api_pedidos_get()
{
    register_rest_route('api', '/pedidos', array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'api_pedidos_get',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_pedidos_get');
