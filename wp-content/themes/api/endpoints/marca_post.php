<?php

function api_marca_post($request)
{
  $user = wp_get_current_user();
  $user_id = $user->ID;

  if ($user_id > 0) {
    $nome = sanitize_text_field($request['nome']);
    $usuario_id = $user->user_login;

    $response = array(
      'post_author' => $user_id,
      'post_type' => 'marca',
      'post_title' => $nome,
      'post_status' => 'publish',
      'meta_input' => array(
        'nome' => $nome,
        'usuario_id' => $usuario_id,
      ),
    );

    $marca_id = wp_insert_post($response);
    $response['id'] = get_post_field('post_name', $marca_id);
  } else {
    $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
  }
  //$response = get_categories();
  return rest_ensure_response($response);
}

function registrar_api_marca_post()
{
  register_rest_route('api', '/marca', array(
    array(
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'api_marca_post',
    ),
  ));
}

add_action('rest_api_init', 'registrar_api_marca_post');