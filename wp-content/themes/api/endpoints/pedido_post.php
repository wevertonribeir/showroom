<?php

function api_pedido_post($request)
{
  $user = wp_get_current_user();
  $user_id = $user->ID;

  if ($user_id > 0) {

    $loja = sanitize_text_field($request['loja']);
    $caixa = sanitize_text_field($request['caixa']);
    $operador = sanitize_text_field($request['operador']);
    $data = sanitize_text_field($request['data']);
    $hora = sanitize_text_field($request['hora']);
    $n = sanitize_text_field($request['n']);
    $cliente = sanitize_text_field($request['cliente']);
    $vendedor = sanitize_text_field($request['vendedor']);
    $produtos = sanitize_text_field($request['produtos']);
    $total = sanitize_text_field($request['total']);
    $count_total = sanitize_text_field($request['count_total']);
    $obs = sanitize_text_field($request['obs']);
    $adicionais = sanitize_text_field($request['adicionais']);
    $status = sanitize_text_field($request['status']);

    // Dados do Cliente
    $rua = sanitize_text_field($request['rua']);
    $cep = sanitize_text_field($request['cep']);
    $numero = sanitize_text_field($request['numero']);
    $bairro = sanitize_text_field($request['bairro']);
    $cidade = sanitize_text_field($request['cidade']);
    $estado = sanitize_text_field($request['estado']);
    $cpf = sanitize_text_field($request['cpf']);
    $cnpj = sanitize_text_field($request['cnpj']);
    $nomefantasia = sanitize_text_field($request['nomefantasia']);
    $rg = sanitize_text_field($request['rg']);
    $nascimento = sanitize_text_field($request['nascimento']);

    $usuario_id = $user->user_login;

    $response = array(
      'post_author' => $user_id,
      'post_type' => 'pedido',
      'post_title' => 'Pedido N° '. $n,
      'post_status' => 'publish',
      'meta_input' => array(
        'loja' => $loja,
        'caixa' => $caixa,
        'operador' => $operador,
        'data' => $data,
        'hora' => $hora,
        'n' => $n,
        'cliente' => $cliente,
        'vendedor' => $vendedor,
        'produtos' => $produtos,
        'total' => $total,
        'count_total' => $count_total,
        'obs' => $obs,
        'adicionais' => $adicionais,
        'status' => $status,
        'usuario_id' => $usuario_id,

        // Dados do Cliente
        'rua' => $rua,
        'cep' => $cep,
        'numero' => $numero,
        'bairro' => $bairro,
        'cidade' => $cidade,
        'estado' => $estado,
        'cpf' => $cpf,
        'cnpj' => $cnpj,
        'nomefantasia' => $nomefantasia,
        'rg' => $rg,
        'nascimento' => $nascimento
      ),
    );

    $pedido_id = wp_insert_post($response);
    $response['id'] = get_post_field('post_name', $pedido_id);

  } else {
    $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
  }
  //$response = get_categories();
  return rest_ensure_response($response);
}

function registrar_api_pedido_post()
{
  register_rest_route('api', '/pedido', array(
    array(
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'api_pedido_post',
    ),
  ));
}

add_action('rest_api_init', 'registrar_api_pedido_post');
