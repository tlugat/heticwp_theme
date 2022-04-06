<?php get_header() ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
        <h1 class="text-primary"><?php the_title(); ?> </h1>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
        <div class="recipe-details__card">
            <p class="text-dark"><?= esc_attr(get_post_meta(get_the_ID(), 'difficulty', true)); ?></p>
        </div>
        <div class="recipe__time">
            <p>Temps de préparation : <?= esc_attr(get_post_meta(get_the_ID(), 'prepTime', true)); ?> min</p>
            <p>Temps de cuisson : <?= esc_attr(get_post_meta(get_the_ID(), 'cookTime', true)); ?> min</p>
            <p>Temps de repos : <?= esc_attr(get_post_meta(get_the_ID(), 'restingTime', true)); ?> min</p>
            <p>Temps de repos : <?= esc_attr(get_post_meta(get_the_ID(), 'restingTime', true)); ?> min</p>
        </div>
        <?php the_content(); ?>
    <?php endwhile ?>
    <?php if (comments_open() || get_comments_number()) :
        comments_template();
    endif; ?>
<?php endif; ?>
<?php get_footer() ?>