<?php

function api_categoria_post($request)
{
  $user = wp_get_current_user();
  $user_id = $user->ID;

  if ($user_id > 0) {
    $cat_name = sanitize_text_field($request['cat_name']);
    $usuario_id = $user->user_login;

    $categoria = array(
        'cat_name' => $cat_name,
    );

    //$wpdocs_cat = array('cat_name' => 'Wpdocs Category', 'category_description' => 'A Cool Category', 'category_nicename' => 'category-slug', 'category_parent' => '');
    $response = wp_insert_category($categoria);

  } else {
    $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
  }
  //$response = get_categories();
  return rest_ensure_response($response);
}

function registrar_api_categoria_post()
{
  register_rest_route('api', '/categoria', array(
    array(
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'api_categoria_post',
    ),
  ));
}

add_action('rest_api_init', 'registrar_api_categoria_post');
