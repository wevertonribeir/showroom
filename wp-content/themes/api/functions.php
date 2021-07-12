<?php

    $template_diretorio = get_template_directory();

    if (file_exists (ABSPATH.'/wp-admin/includes/taxonomy.php')) {
        require_once (ABSPATH.'/wp-admin/includes/taxonomy.php'); 
    }

    if (file_exists (ABSPATH.'wp-admin/includes/user.php')) {
        require_once (ABSPATH.'wp-admin/includes/user.php'); 
    }

    require_once($template_diretorio. "/custom-post-type/produto.php");
    require_once($template_diretorio. "/custom-post-type/transacao.php");
    require_once($template_diretorio. "/custom-post-type/marca.php");
    require_once($template_diretorio. "/custom-post-type/pedido.php");

    require_once($template_diretorio. "/endpoints/usuario_post.php");
    require_once($template_diretorio. "/endpoints/usuario_get.php");
    require_once($template_diretorio. "/endpoints/usuario_put.php");
    require_once($template_diretorio. "/endpoints/usuario_delete.php");

    require_once($template_diretorio. "/endpoints/produto_post.php");
    require_once($template_diretorio. "/endpoints/produto_get.php");
    require_once($template_diretorio. "/endpoints/produto_put.php");
    require_once($template_diretorio. "/endpoints/produto_delete.php");

    require_once($template_diretorio. "/endpoints/pedido_post.php");

    require_once($template_diretorio. "/endpoints/produto_image_post.php");
    require_once($template_diretorio. "/endpoints/produto_image_delete.php");

    require_once($template_diretorio. "/endpoints/categoria_get.php");
    require_once($template_diretorio. "/endpoints/categoria_post.php");
    require_once($template_diretorio. "/endpoints/categoria_delete.php");
    require_once($template_diretorio. "/endpoints/categoria_put.php");

    require_once($template_diretorio. "/endpoints/marca_post.php");
    require_once($template_diretorio. "/endpoints/marca_get.php");
    require_once($template_diretorio. "/endpoints/marca_delete.php");

    require_once($template_diretorio. "/endpoints/marca_image_post.php");

    function get_produto_id_by_slug($slug){

        $query = new WP_Query(array(
            'name' => $slug,
            'post_type' => 'produto',
            'numberposts' => 1,
            'fields' => 'ids'
        ));

        $posts = $query->get_posts();

        return array_shift($posts);
    }

    function get_marca_id_by_slug($slug){

        $query = new WP_Query(array(
            'name' => $slug,
            'post_type' => 'marca',
            'numberposts' => 1,
            'fields' => 'ids'
        ));

        $posts = $query->get_posts();

        return array_shift($posts);
    }

    function expire_token() {
        return time() + (60 * 60);
    }

    add_action('jwt_auth_expire', 'expire_token');

?>