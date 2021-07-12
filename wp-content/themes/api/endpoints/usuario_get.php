<?php

function api_usuario_get($request) {
  $user = wp_get_current_user();
  $user_id = $user->ID;

  if($user_id > 0) {
    $user_meta = get_user_meta($user_id);

    $response = array(
      "id" => $user->user_login,
      "nome" => $user->display_name,
      "email" => $user->user_email,
      "cep" => $user_meta['cep'][0],
      "numero" => $user_meta['numero'][0],
      "rua" => $user_meta['rua'][0],
      "bairro" => $user_meta['bairro'][0],
      "cidade" => $user_meta['cidade'][0],
      "estado" => $user_meta['estado'][0],
      "cpf" => $user_meta['cpf'][0],
      "cnpj" => $user_meta['cnpj'][0],
      "nomefantasia" => $user_meta['nomefantasia'][0],
      "rg" => $user_meta['rg'][0],
      "nascimento" => $user_meta['nascimento'][0],
      "obs" => $user_meta['obs'][0],
      "role" => $user->roles[0],
    );
  } else {
    $response = new WP_Error('permissao', 'Usuário não possui permissão', array('status' => 401));
  }
  return rest_ensure_response($response);
}

function registrar_api_usuario_get() {
  register_rest_route('api', '/usuario', array(
    array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => 'api_usuario_get',
    ),
  ));
}

add_action('rest_api_init', 'registrar_api_usuario_get');

function api_usuarios_get($request) {
  $user = wp_get_current_user();
  $user_id = $user->ID;

  if($user_id > 0) {
    $response = get_users();
    $users = array();
    foreach ($response as $key => $value) {
      $user_meta = get_user_meta($value->ID);
      $users[] = array(
        "id" => $value->user_login,
        "nome" => $value->display_name,
        "email" => $value->user_email,
        "cep" => $user_meta['cep'][0],
        "numero" => $user_meta['numero'][0],
        "rua" => $user_meta['rua'][0],
        "bairro" => $user_meta['bairro'][0],
        "cidade" => $user_meta['cidade'][0],
        "estado" => $user_meta['estado'][0],
        "cpf" => $user_meta['cpf'][0],
        "cnpj" => $user_meta['cnpj'][0],
        "nomefantasia" => $user_meta['nomefantasia'][0],
        "rg" => $user_meta['rg'][0],
        "nascimento" => $user_meta['nascimento'][0],
        "obs" => $user_meta['obs'][0],
        "role" => $value->roles[0],
      );
    }
    $response = $users;
  } else {
    $response = new WP_Error('permissao', 'Usuário não possui permissão', array('status' => 401));
  }
  return rest_ensure_response($response);
}

function registrar_api_usuarios_get() {
  register_rest_route('api', '/usuarios', array(
    array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => 'api_usuarios_get',
    ),
  ));
}

add_action('rest_api_init', 'registrar_api_usuarios_get');

?>