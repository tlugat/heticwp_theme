<?php get_header() ?>

<h1>Page recettes</h1>
<?php if (have_posts()) : ?>
    <ul>
        <?php while (have_posts()) : the_post() ?>
            <li>
                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                <p><?php the_excerpt() ?></p>
                <p><?php the_author() ?></p>
            </li>
        <?php endwhile; ?>
    </ul>
    <?= paginate_links(['type' => 'list']) ?>
<?php else : ?>
    <h1>Aucun article</h1>
<?php endif; ?>

<?php get_footer() ?>