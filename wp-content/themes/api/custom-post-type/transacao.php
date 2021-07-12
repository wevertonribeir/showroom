<?php
    function register_cpt_transaction() {
        register_post_type('Transação', array(
            'label' => 'Transação',
            'description' => 'Transação',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'Transação', 'with_front' => true),
            'query_var' => true,
            'supports' => array('custom-fields', 'author', 'title'),
            'publicky_queryable' => true,
        ));
    }
    add_action('init', 'register_cpt_transaction')

?>