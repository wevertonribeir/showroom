<?php
    function register_cpt_pedido() {
        register_post_type('pedido', array(
            'label' => 'Pedido',
            'description' => 'Pedido',
            'taxonomies' => array('category'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'pedido', 'with_front' => true),
            'query_var' => true,
            'supports' => array('custom-fields', 'author', 'title'),
            'publicky_queryable' => true,
        ));
    }
    add_action('init', 'register_cpt_pedido')

?>