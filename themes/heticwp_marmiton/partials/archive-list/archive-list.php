<?php if (have_posts()) : ?>
    <ul class="post-list">
        <?php while (have_posts()) : the_post() ?>
            <li>
                <?php get_template_part('partials/post-card/post-card') ?>
            </li>
        <?php endwhile; ?>
    </ul>
    <?= paginate_links(['type' => 'list']) ?>
<?php else : ?>
    <h1>Aucun article</h1>
<?php endif; ?>