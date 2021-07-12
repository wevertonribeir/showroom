<?php

function api_marca_delete($request) {
    $slug = $request['slug'];

    $marca_id = get_marca_id_by_slug($slug);

    $images = get_attached_media('image', $marca_id);
    if($images) {
        foreach($images as $key => $value) {
            wp_delete_attachment($value->ID, true);
        }
    }

    $response = wp_delete_post($marca_id, true);

    return rest_ensure_response($response);
}

function registrar_api_marca_delete() {
    register_rest_route('api', '/marca/(?P<slug>[-\w]+)', array(
        array(
        'methods' => WP_REST_Server::DELETABLE,
        'callback' => 'api_marca_delete',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_marca_delete');