<?php

function marmishlag_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'Navigation dans le header');
}

// function marmishlag_register_assets() {
//     wp_register_style('name', 'path');
//     wp_register_script('name', 'path', [], false, true);
//     wp_enqueue_style('name');
//     wp_enqueue_script('name);
// }

function marmishlag_add_roles()
{
    add_role('moderator', 'Modérateur / Modératrice', [
        'read' => true,

        'edit_posts' => true,

        'edit_other_posts' => true,

        'edit_published_posts' => true,

        'moderate_comments' => true
    ]);
}

// function marmishlag_add_custom_box()
// {
//     add_meta_box('marmishlag_ingredients', __('Ingrédients', 'ingredients-plugin'), 'marmishlag_render_ingredients_box', 'recipe');
// }

// function save_custom_metabox($post_id)
// {
//     if (!isset($_POST['source_post_metabox_nonce'])) :
//         return;
//     endif;

//     if (!wp_verify_nonce($_POST['source_post_metabox_nonce'], 'source_post_metabox')) :
//         return;
//     endif;

//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) :
//         return;
//     endif;

//     if (!current_user_can('edit_post', $post_id))
//         return;


//     if (isset($_POST['source_post'])) {
//         foreach ($_POST['source_post'] as $key => $val)
//             $_POST['source_post'][$key] = sanitize_text_field($val);
//         update_post_meta($post_id, '_post_source', $_POST['source_post']);
//     }
// }
// function outpout_source_metabox($post)
// {
//     wp_nonce_field('source_post_metabox', 'source_post_metabox_nonce');
//     $post_sources = get_post_meta($post->ID, '_post_source', true);
//     if (is_array($post_sources))
//         foreach ($post_sources as $post_source)
//             echo '<input type="text" id="source_post" name="source_post[]" value="' . $post_source . '" style="width: 80%;max-width: 720px;"><br />';
//     else
//         echo '<input type="text" id="source_post" name="source_post[]" value="" style="width: 80%;max-width: 720px;"><br />';
//     echo '<button class="add-field">+</button>';
//     echo '<p>Try to be as specific as possible. <br> E.g. <em>http://tweakers.net/nieuws/101372/ing-belgie-wil-betalingsgedrag-van-klanten-meer-gebruiken-voor-dienstverlening.html</em></p>';
//     echo '<script>counter = 0;
//         jQuery(".add-field").click(function( event ) {
//             event.preventDefault();
//             counter++;
//             jQuery("#source_post").after(\'<input type="text" id="source_post_\'+counter+\'" name="source_post[]" value="" style="width: 80%;max-width: 720px;">\');
//         });</script>';
// }



// add_action('save_post', 'save_custom_metabox');


add_action('init', ' marmishlag_add_roles');
add_action('after_setup_theme', "marmishlag_theme_support");
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});
// add_action('add_meta_boxes', 'marmishlag_add_custom_box');
// add_action('wp_enqueue_script', 'marmishlag_register_assets');
