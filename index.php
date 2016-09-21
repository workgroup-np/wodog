<?php 
if ( !defined('ABSPATH') ) {
echo '<h1>Forbidden</h1>'; 
exit();
} 
get_header(); 
global $wodog_options;
$style="";
if ( is_active_sidebar( 'wodog-banner-sidebar' ) ) : 
    dynamic_sidebar('wodog-banner-sidebar');
endif;?>
<!-- LATEST ARTICLE SECTION -->
<section class="tbeer-latest-and-trending-article-section tbeer-section">
    <div class="container">
        <div class="row">
            <div class="tbeer-main-content col-md-8 col-sm-8 col-xs-12">
                <div class="tbeer-left-sidebar col-md-4 col-sm-12 col-xs-12"><?php
                    if ( is_active_sidebar( 'wodog-category-sidebar' ) ) : 
                        dynamic_sidebar('wodog-category-sidebar');
                    endif;
                    ?>                  
                </div>
                <?php $posts_per_page=get_option('posts_per_page');
                $latest_args = array( 'posts_per_page' => $posts_per_page, 'order'=> 'DESC', 'orderby' => 'date' );
                $lateset_posts = new WP_Query( $latest_args );
                if($lateset_posts->have_posts()): 
                    echo '<div class="tbeer-latest-article-wrapper col-md-8 col-sm-12 col-xs-12">';
                            while ( $lateset_posts->have_posts()) : $lateset_posts->the_post();?>
                                 <!-- Latest Article -->
                                <div class="tbeer-latest-article">
                                    <?php
                                        $thumbnail = get_post_thumbnail_id($post->ID);
                                        $img_url = wp_get_attachment_image_src( $thumbnail,'full');
                                        $alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
                                    if($img_url):
                                        $n_img = aq_resize( $img_url[0], $width =260, $height = 260, $crop = true, $single = true, $upscale = true ); ?>
                                        <div class="tbeer-image-wrapper">
                                            <img src="<?php echo esc_url($n_img);?>" alt="<?php echo esc_attr($alt);?>">
                                        </div>
                                    <?php else:
                                    $img_url=get_template_directory_uri().'/assets/images/no-image.png';
                                    $n_img = aq_resize( $img_url, $width =260, $height = 260, $crop = true, $single = true, $upscale = true );?>
                                        <div class="tbeer-image-wrapper">
                                            <img src="<?php echo esc_url($img_url);?>" alt="No image">
                                        </div>
                                    <?php endif;?>
                                    <div class="tbeer-latest-article-details">
                                        <div class="tbeer-category-meta"> <?php if (get_the_category()) : ?><?php the_category(' / ');endif; ?></div>
                                        <h3 class="tbeer-news-post-heading">
                                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                        </h3>
                                        <p class="tbeer-news-post-excerpt">
                                            <?php echo Wodog_the_excerpt_max_charlength(100);?>
                                        </p>
                                        <div class="tbeer-news-post-meta">
                                            <span class="tbeer-news-post-date"><?php echo date("m.d.y");  ?></span>
                                            <div class="tbeer-news-post-author"><?php the_author_posts_link();?></div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                                <!-- End -->
                            <?php 
                            endwhile;
                    echo'</div>';
                endif;
                wp_reset_postdata();?>
            </div><!-- tberr-main-content-->
                <!-- Sidebar -->
                <div class="tbeer-sidebar-wrapper col-md-4 col-sm-4 col-xs-12">
                    <div class="tbeer-sidebar">
                        <?php if ( is_active_sidebar( 'wodog-widgets-sidebar' ) ) : 
                            dynamic_sidebar('wodog-widgets-sidebar');
                        endif;
                        if ( is_active_sidebar( 'wodog-trending-sidebar' ) ) : 
                            dynamic_sidebar('wodog-trending-sidebar');
                        endif;
                        ?>
                    </div>
                </div>
                <!-- End -->
            
        </div><!--row-->
    </div>
</section>
<!-- LATEST ARTICLE SECTION END -->

<?php get_footer(); ?>