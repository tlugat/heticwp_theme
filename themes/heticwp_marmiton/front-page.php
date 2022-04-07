<?php get_header() ?>
<main class="landing">
    <?php while (have_posts()) : the_post(); ?>
        <div class="landing__content">
            <h1><?php the_title() ?></h1>
            <?php the_content() ?>
        </div>
        <div class="landing__image">
            <img class="" src="<?php the_post_thumbnail_url()  ?>" alt="">
        </div>
        <div class="landing__posts">
            <div class="landing__posts__row">
                <h4><a href="<?= get_post_type_archive_link('recipes') ?>">Voir les dernieres recettes</a></h4>
                <ul class="row__post-list">
                    <?php
                    $recentPosts = new WP_Query();
                    $args = array(
                        'post_type' => 'recipes',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'order' => 'ASC',
                    );
                    $recentPosts->query($args);
                    ?>
                    <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                        <li>
                            <?php get_template_part('partials/post-card/post-card') ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="landing__posts__row row">
                <h4> <a href="<?= get_post_type_archive_link('post') ?>">Voir les derniers articles</a></h4>
                <ul class="row__post-list">
                    <?php
                    $recentPosts = new WP_Query();
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'order' => 'ASC',
                    );
                    $recentPosts->query($args);
                    ?>
                    <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                        <li>
                            <?php get_template_part('partials/post-card/post-card') ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    <?php endwhile; ?>
</main>

<?php get_footer() ?>