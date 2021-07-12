<?php

function api_categoria_delete($request) {
    $cat_id = $request['id'];

    $response = wp_delete_category( $cat_id );

    return rest_ensure_response($response);
}

function registrar_api_categoria_delete() {
    register_rest_route('api', '/categoria/(?P<id>[-\w]+)', array(
        array(
        'methods' => WP_REST_Server::DELETABLE,
        'callback' => 'api_categoria_delete',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_categoria_delete');