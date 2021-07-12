<?php

function api_categoria_put($request)
{
  $user = wp_get_current_user();
  $user_id = $user->ID;

  if ($user_id > 0) {
    $cat_id = sanitize_text_field($request['cat_id']);
    $cat_name = sanitize_text_field($request['cat_name']);

    $categoria = array(
        'cat_ID' => $cat_id,
        'cat_name' => $cat_name,
    );

    $response = wp_insert_category($categoria);

  } else {
    $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
  }
  //$response = get_categories();
  return rest_ensure_response($response);
}

function registrar_api_categoria_put()
{
  register_rest_route('api', '/categoria', array(
    array(
      'methods' => WP_REST_Server::EDITABLE,
      'callback' => 'api_categoria_put',
    ),
  ));
}

add_action('rest_api_init', 'registrar_api_categoria_put');
