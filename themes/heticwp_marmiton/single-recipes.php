<?php get_header() ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
        <h1 class="text-primary"><?php the_title(); ?> </h1>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
        <?php the_content(); ?>
        <?php echo esc_attr(get_post_meta(get_the_ID(), 'difficulty', true)); ?>
    <?php endwhile ?>
    <?php if (comments_open() || get_comments_number()) :
        comments_template();
    endif; ?>
<?php endif; ?>
<?php get_footer() ?>