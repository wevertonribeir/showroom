<?php
    function api_usuario_post($request){
        $email = sanitize_email($request['email']);
        $senha = $request['senha'];

        $nome = sanitize_text_field($request['nome']);

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

        $role = sanitize_text_field($request['role']);

        $obs = sanitize_text_field($request['obs']);

        $user_exists = username_exists($email);
        $email_exists = email_exists($email);
      
        if(!$user_exists && !$email_exists && $email && $senha) {
          $user_id = wp_create_user($email, $senha, $email);
      
          $response = array(
            'ID' => $user_id,
            'display_name' => $nome,
            'first_name' => $nome,
            'role' => $role ? $role : 'subscriber',
          );
          wp_update_user($response);
      
          update_user_meta($user_id, 'cep', $cep);
          update_user_meta($user_id, 'rua', $rua);
          update_user_meta($user_id, 'numero', $numero);
          update_user_meta($user_id, 'bairro', $bairro);
          update_user_meta($user_id, 'cidade', $cidade);
          update_user_meta($user_id, 'estado', $estado);
          update_user_meta($user_id, 'cpf', $cpf);
          update_user_meta($user_id, 'cnpj', $cnpj);
          update_user_meta($user_id, 'nomefantasia', $nomefantasia);
          update_user_meta($user_id, 'rg', $rg);
          update_user_meta($user_id, 'nascimento', $nascimento);
          update_user_meta($user_id, 'obs', $obs);
          


        } else {
          $response = new WP_Error('email', 'Email j?? cadastrado.', array('status' => 403));
        }
        return rest_ensure_response($response);
    }
    function registrar_api_usuario_post() {
        register_rest_route('api', '/usuario', array(
            array(
                'methods' => WP_REST_Server::CREATABLE,
                'callback' => 'api_usuario_post'
            ),
        ));
    }
    add_action('rest_api_init', 'registrar_api_usuario_post');
?>