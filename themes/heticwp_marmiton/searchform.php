<?php
/*
Template Name: Search Page
*/
?>
<form action="<?= esc_url(home_url('/actualites')); ?>">
    <input type="search" name="s" id="" placeholder="Search" aria-label="Search" value="<?= get_search_query() ?>">
    <button type="submit">Search</button>
</form>