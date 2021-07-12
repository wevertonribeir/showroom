<?php

function api_produto_image_delete($request) {
    $id = $request['id'];

    $response = wp_delete_attachment($id, true);

    return rest_ensure_response($response);
}

function registrar_api_produto_image_delete() {
    register_rest_route('api', '/produto/image/(?P<id>[-\w]+)', array(
        array(
        'methods' => WP_REST_Server::DELETABLE,
        'callback' => 'api_produto_image_delete',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_produto_image_delete');