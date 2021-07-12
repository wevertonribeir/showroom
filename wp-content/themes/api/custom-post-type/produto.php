<?php
    function register_cpt_product() {
        register_post_type('produto', array(
            'label' => 'Produto',
            'description' => 'Produto',
            'taxonomies' => array('category'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'produto', 'with_front' => true),
            'query_var' => true,
            'supports' => array('custom-fields', 'author', 'title'),
            'publicky_queryable' => true,
        ));
    }
    add_action('init', 'register_cpt_product')

?>