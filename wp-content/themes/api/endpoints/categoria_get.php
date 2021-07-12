<?php

function api_categoria_get($request)
{
    $response = get_categories(array('hide_empty' => false));
    return rest_ensure_response($response);
}

function registrar_api_categoria_get()
{
    register_rest_route('api', '/categoria', array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'api_categoria_get',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_categoria_get');
