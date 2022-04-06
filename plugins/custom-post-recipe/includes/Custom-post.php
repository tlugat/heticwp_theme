<?php

class Custom_Post
{
    function __construct()
    {
        register_activation_hook(__FILE__, array($this, 'register_custom_post_type'));
        add_action('init', [$this, 'register_custom_post_type']);
        add_action('add_meta_boxes', [$this, 'recipe_add_meta_boxes']);
    }

    function register_custom_post_type()
    {
        register_post_type(
            'recipes',
            array(
                'labels' => array(
                    'name' => 'Recette',
                    'singular_name' => 'Recette',
                    'search_items' => 'Rechercher une recette',
                    'all_items' => 'Toutes les recettes'
                ),
                'public' => true,
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'thumbnail'),
                'has_archive' => true,
                'rewrite'   => array('slug' => 'recettes'),
                'menu_position' => 5,
                'menu_icon' => 'dashicons-food',
                'taxonomies' => array('variety')
            )
        );
    }

    /**
     * Add meta box
     *
     * @param post $post The post object
     * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
     */
    function recipe_add_meta_boxes()
    {
        add_meta_box('recipe_meta_box', __('Détails de la préparation', 'recipe_example_plugin'), [$this, 'build_meta_box'], 'recipes', 'side', 'low');
    }

    /**
     * Build custom field meta box
     *
     * @param post $post The post object
     */
    function build_meta_box($post)
    {
        wp_nonce_field(basename(__FILE__), 'recipe_meta_box_nonce');

        $current_cholesterol = get_post_meta($post->ID, '_recipe_cholesterol', true);

        $current_prepTime = get_post_meta($post->ID, '_recipe_prepTime', true);
        $current_cookTime = get_post_meta($post->ID, '_recipe_cookTime', true);
        $current_restingTime = get_post_meta($post->ID, '_recipe_restingTime', true);
        // $total_time = $current_prepTime + $current_cookTime + $current_restingTime

        $current_video = get_post_meta($post->ID, '_recipe_video', true);

?>
        <div class='inside'>

            <h3><?php _e('Cholesterol', 'recipe_example_plugin'); ?></h3>
            <p>
                <input type="radio" name="cholesterol" value="0" <?php checked($current_cholesterol, '0'); ?> /> Yes<br />
                <input type="radio" name="cholesterol" value="1" <?php checked($current_cholesterol, '1'); ?> /> No
            </p>

            <h3><?php _e('Temps de préparation', 'recipe_example_plugin'); ?></h3>
            <p>
                <input type="text" name="prepTime" value="<?php echo $current_prepTime; ?>" />
            </p>

            <h3><?php _e('Temps de cuisson', 'recipe_example_plugin'); ?></h3>
            <p>
                <input type="text" name="cookTime" value="<?php echo $current_cookTime; ?>" />
            </p>

            <h3><?php _e('Temps de repos', 'recipe_example_plugin'); ?></h3>
            <p>
                <input type="text" name="restingTime" value="<?php echo $current_restingTime; ?>" />
            </p>
            <h3><?php _e('Lien de la vidéo', 'recipe_example_plugin'); ?></h3>
            <p>
                <input type="text" name="video" value="<?php echo $current_video; ?>" />
            </p>
        </div>
<?php
    }
}
