<?php

function api_usuario_delete($request) {
    $id = $request['id'];
    $response = wp_delete_user($id, $reassign = null );
    return rest_ensure_response($response);
}

function registrar_api_usuario_delete() {
    register_rest_route('api', '/usuario/(?P<id>[-\w]+)', array(
        array(
        'methods' => WP_REST_Server::DELETABLE,
        'callback' => 'api_usuario_delete',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_usuario_delete');