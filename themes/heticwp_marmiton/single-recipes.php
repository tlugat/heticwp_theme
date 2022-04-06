<?php

$budget = esc_attr(get_post_meta(get_the_ID(), 'budget', true));
$difficulty = esc_attr(get_post_meta(get_the_ID(), 'difficulty', true));
$prepTime = esc_attr(get_post_meta(get_the_ID(), 'prepTime', true));
$cookTime = esc_attr(get_post_meta(get_the_ID(), 'cookTime', true));
$restingTime = esc_attr(get_post_meta(get_the_ID(), 'restingTime', true));

$totalTime = $prepTime + $cookTime + $restingTime;

// function Chrono($TotSec)
// {
//     $heures  =  bcdiv($TotSec,  3600,  0);
//     $minutes  =  (bcdiv($TotSec,  60,  0)  %  60);
//     return $heures  .  ":"  .  $minutes;
// }

?>

<?php get_header() ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
        <article class="recipe-container">
            <header class="recipe-header">
                <h1 class="text-dark"><?php the_title(); ?> <span class="text-secondary">par</span> <u class="text-secondary"><?php the_author() ?></u> </h1>
                <img class="recipe-header__image" src="<?php the_post_thumbnail_url(); ?>" alt="">
            </header>
            <div class="recipe-content-container">
                <div class="recipe-content">
                    <?php the_content(); ?>
                </div>
                <div class="recipe-details">
                    <div class="recipe-details__row">
                        <div class="recipe-details__title">
                            <img src="<?php bloginfo('template_url'); ?>/assets/images/cooking-time.svg" alt="cook timer">
                            <h5>Durée</h5>
                        </div>
                        <p>Temps de préparation : <?= $prepTime ? $prepTime : "???" ?> min</p>
                        <p>Temps de cuisson : <?= $cookTime ? $cookTime : "???" ?> min</p>
                        <p>Temps de repos : <?= $restingTime ? $restingTime : "???"; ?> min</p>
                        <p>Total : <?= $totalTime ? $totalTime : "???" ?> min</p>
                    </div>
                    <hr />
                    <div class="recipe-details__row">
                        <div class="recipe-details__title">
                            <img src="<?php bloginfo('template_url'); ?>/assets/images/speedometer.svg" alt="speedometer">
                            <h5>Difficulté</h5>
                        </div>
                        <p><?= $difficulty ? $difficulty : "???" ?></p>
                    </div>
                    <hr />
                    <div class="recipe-details__row">
                        <div class="recipe-details__title">
                            <img src="<?php bloginfo('template_url'); ?>/assets/images/money-bag.svg" alt="money bag">
                            <h5>Coût</h5>
                        </div>
                        <p><?= $budget ? $budget : "???" ?></p>
                    </div>
                </div>
            </div>
            <?php if (comments_open() || get_comments_number()) : ?>
                <h4><?= get_comments_number() ?> commentaires</h4>
                <?php comments_template(); ?>
            <?php endif; ?>
        </article>
    <?php endwhile ?>
<?php endif; ?>
<?php get_footer() ?>