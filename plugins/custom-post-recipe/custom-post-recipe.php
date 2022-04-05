<?php
/*
Plugin Name: Recipe plugin
*/
require_once(__DIR__ . '/includes/Custom-terms.php');
require_once(__DIR__ . '/includes/Custom-post.php');

$terms = new Custom_Terms();
$recipe_custom_post = new Custom_Post();
