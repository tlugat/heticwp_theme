<?php

class Custom_Post
{
    function __construct()
    {
        register_activation_hook(__FILE__, array($this, 'register_custom_post_type'));
        add_action('init', [$this, 'register_custom_post_type']);
        add_action('add_meta_boxes', [$this, 'recipe_add_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_boxes']);
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
     * save meta box
     *
     * @param  post $post The post object
     * @return void
     * @link https://codex.wordpress.org/Plugin_API/Action_Reference/update_post_meta
     */
    function save_meta_boxes($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        $fields = [
            'difficulty',
            'budget',
            'prepTime',
            'cookTime',
            'restingTime',
            'video'
        ];
        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }

    /**
     * Build custom field meta box
     *
     * @param post $post The post object
     */
    function build_meta_box($post)
    {
        wp_nonce_field(basename(__FILE__), 'recipe_meta_box_nonce');

        $current_difficulty = get_post_meta($post->ID, '_recipe_difficulty', true);
        $current_budget = get_post_meta($post->ID, '_recipe_budget', true);
        $current_prepTime = get_post_meta($post->ID, '_recipe_prepTime', true);
        $current_cookTime = get_post_meta($post->ID, '_recipe_cookTime', true);
        $current_restingTime = get_post_meta($post->ID, '_recipe_restingTime', true);
        // $total_time = $current_prepTime + $current_cookTime + $current_restingTime

        $current_video = get_post_meta($post->ID, '_recipe_video', true);

?>
        <div class='inside'>

            <h3><?php _e('Difficulté', 'recipe_example_plugin'); ?></h3>
            <select name="difficulty" id="difficulty" class="postbox">
                <option value="">Choisissez une difficulté...</option>
                <option value="Facile" <?php selected($current_difficulty, 'Facile'); ?>>Facile</option>
                <option value="Moyen" <?php selected($current_difficulty, 'Moyen'); ?>>Moyen</option>
                <option value="Difficile" <?php selected($current_difficulty, 'Difficile'); ?>>Difficile</option>
            </select>

            <h3><?php _e('Coût', 'recipe_example_plugin'); ?></h3>
            <select name="budget" id="budget" class="postbox">
                <option value="">Choisissez un coût</option>
                <option value="Bon marché" <?php selected($current_budget, 'Bon marché'); ?>>Bon marché</option>
                <option value="Coût moyen" <?php selected($current_budget, 'Coût moyen'); ?>>Coût moyen</option>
                <option value="Assez cher" <?php selected($current_budget, 'Assez cher'); ?>>Assez cher</option>
            </select>

            <h3><?php _e('Temps de préparation', 'recipe_example_plugin'); ?></h3>
            <input type="text" name="prepTime" id="prepTime" value="<?php echo $current_prepTime; ?>" />

            <h3><?php _e('Temps de cuisson', 'recipe_example_plugin'); ?></h3>
            <input type="text" name="cookTime" id="cookTime" value="<?php echo $current_cookTime; ?>" />

            <h3><?php _e('Temps de repos', 'recipe_example_plugin'); ?></h3>
            <input type="text" name="restingTime" id="restingTime" value="<?php echo $current_restingTime; ?>" />

            <h3><?php _e('Lien de la vidéo', 'recipe_example_plugin'); ?></h3>
            <input type="text" name="video" id="video" value="<?php echo $current_video; ?>" />

        </div>
<?php
    }
}
