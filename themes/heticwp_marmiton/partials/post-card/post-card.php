<div class="card">

    <?php if (has_post_thumbnail(get_the_ID())) : ?>
        <img class="card-img-top" src="<?php the_post_thumbnail_url()  ?>" alt="">
    <? else : ?>
        <img class="card-img-top" src="<?php bloginfo('template_url'); ?>/assets/images/placeholder_img.svg" alt="">
    <?php endif; ?>
    <div class="card-body">
        <h5 class="card-title"><?= the_title() ?></h5>
        <h6><?php the_category() ?? the_terms(get_the_ID(), 'variety') ?></h6>
        <p class="card-text">
            <?= get_the_excerpt() ?>
        </p>
        <button type="button" class="card-btn"> <a href="<?php the_permalink() ?>" class="card-link">Voir plus</a></button>
    </div>
</div>