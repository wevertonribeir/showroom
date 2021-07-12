<?php

function api_produto_put($request)
{
  $user = wp_get_current_user();
  $user_id = $user->ID;

  if ($user_id > 0) {
    $post_id = get_produto_id_by_slug(sanitize_text_field($request['id']));
    $nome = sanitize_text_field($request['nome']);
    $preco = sanitize_text_field($request['preco']);
    $descricao = sanitize_text_field($request['descricao']);
    $marca = sanitize_text_field($request['marca']);
    $categorias = $request['categorias'];
    // $usuario_id = $user->user_login;

    $response = array(
        'ID' => $post_id,
        'post_title' => $nome,
        'post_name' => $nome,
        'meta_input' => array(
            'nome' => $nome,
            'preco' => $preco,
            'descricao' => $descricao,
            'marca' => $marca,
        ),
    );

    $produto_id = wp_update_post($response);
    $response['id'] = get_post_field('post_name', $produto_id);

    wp_set_post_categories($produto_id, $categorias, false);
  } else {
    $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
  }
  //$response = get_categories();
  return rest_ensure_response($response);
}

function registrar_api_produto_put()
{
  register_rest_route('api', '/produto', array(
    array(
      'methods' => WP_REST_Server::EDITABLE,
      'callback' => 'api_produto_put',
    ),
  ));
}

add_action('rest_api_init', 'registrar_api_produto_put');
