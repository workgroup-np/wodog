<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); global $wodog_options;?>

 <section class="wodog-latest-article-section wodog-section wodog-category-post-section">

    <div class="container">

        <div class="row">

            <div class="wodog-latest-article-details">

                    <?php if (have_posts()) : ?>

                        <?php while (have_posts()) : the_post(); ?>

                            <span class="wodog-news-post-excerpt"><?php the_content(); ?>   </span>                         

                        <?php endwhile; ?>

                    <?php endif; ?>

            </div>

        </div>

    </div>

</section>

<?php get_footer(); ?>