<?php get_header() ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
        <h1><?php the_title(); ?> </h1>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
        <?php the_content(); ?>
    <?php endwhile ?>
    <?php if (comments_open() || get_comments_number()) :
        comments_template();
    endif; ?>
<?php endif; ?>
<?php get_footer() ?>