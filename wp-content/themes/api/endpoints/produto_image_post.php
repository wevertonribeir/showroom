<?php

function api_produto_image_post($request)
{
  $user = wp_get_current_user();
  $slug = sanitize_text_field($request['produto_slug']);
  $user_id = $user->ID;

  if ($user_id > 0) {

    $response = true;
    $post_id = get_produto_id_by_slug($slug);
    $files = $request->get_file_params();

    if ($files) {
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/media.php');
      foreach ($files as $file => $array) {
        media_handle_upload($file, $post_id);
      }
    }
  } else {
    $response = new WP_Error('permissao', 'Usuário não possui permissão.', array('status' => 401));
  }
  return rest_ensure_response($response);
}

function registrar_api_produto_image_post()
{
  register_rest_route('api', '/produto/image', array(
    array(
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'api_produto_image_post',
    ),
  ));
}

add_action('rest_api_init', 'registrar_api_produto_image_post');
