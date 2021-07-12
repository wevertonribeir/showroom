<?php
    function register_cpt_marca() {
        register_post_type('marca', array(
            'label' => 'Marca',
            'description' => 'Marca',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'marca', 'with_front' => true),
            'query_var' => true,
            'supports' => array('custom-fields', 'author', 'title'),
            'publicky_queryable' => true,
        ));
    }
    add_action('init', 'register_cpt_marca')
?>