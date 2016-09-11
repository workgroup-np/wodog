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
        <section class="tbeer-latest-article-section tbeer-section">
            <div class="container">
                <div class="row">
                    <?php $posts_per_page=get_option('posts_per_page');
                    $latest_args = array( 'posts_per_page' => $posts_per_page, 'order'=> 'DESC', 'orderby' => 'date' );
                    $lateset_posts = new WP_Query( $latest_args );
                    if($lateset_posts->have_posts()): 
                        echo '<div class="tbeer-main-content col-md-8 col-sm-8 col-xs-12">
                                <h3 class="tbeer-section-title">Latest Articles</h3>
                                    <div id="latest_post" class="tbeer-latest-article-wrapper">';
                                        while ( $lateset_posts->have_posts()) : $lateset_posts->the_post();?>
                                             <!-- Latest Article -->
                                            <div class="tbeer-latest-article-post">
                                            <?php
                                                $thumbnail = get_post_thumbnail_id($post->ID);
                                                $img_url = wp_get_attachment_image_src( $thumbnail,'full');
                                                $alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
                                            if($img_url):
                                                $n_img = aq_resize( $img_url[0], $width =353, $height = 353, $crop = true, $single = true, $upscale = true ); ?>
                                                <div class="tbeer-image-wrapper">
                                                    <img src="<?php echo esc_url($n_img);?>" alt="<?php echo esc_attr($alt);?>">
                                                </div>
                                            <?php else:
                                            $img_url=get_template_directory_uri().'/assets/images/no-image.png';
                                            $n_img = aq_resize( $img_url, $width =353, $height = 353, $crop = true, $single = true, $upscale = true );?>
                                                <div class="tbeer-image-wrapper">
                                                    <img src="<?php echo esc_url($img_url);?>" alt="No image">
                                                </div>
                                            <?php endif;?>
                                                <div class="tbeer-latest-post-details">
                                                    <div class="tbeer-category-meta"> <?php if (get_the_category()) : ?><?php the_category(' / ');endif; ?></div>
                                                    <h3 class="tbeer-news-post-heading">
                                                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                                    </h3>
                                                    <div class="tbeer-latest-post-meta">
                                                        <span class="tbeer-latest-post-date"><?php echo date("m.d.y");  ?></span>
                                                        <div class="tbeer-latest-post-author"><?php the_author_posts_link(); ?></div>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                            </div>
                                            <!-- End -->
                                        <?php 
                                        endwhile;
                                    echo '</div>';
                                if($lateset_posts->found_posts<=$posts_per_page)
                                {
                                  $style="display:none";
                                }
                                $total_post = $lateset_posts->found_posts;
                                $raw_page = $total_post%$posts_per_page;
                                if($raw_page==0){$page_count_raw = $total_post/$posts_per_page; }else{$page_count_raw = $total_post/$posts_per_page+1;}
                                   $page_count = floor($page_count_raw);
                                          ?>
                                <div class="tbeer-load-more-wrapper" id="loadmore" style="<?php echo $style;?>">
                                    <input type="hidden" value="2" id="paged">
                                    <input type="hidden" value="<?php echo $posts_per_page?>" id="post_per_page">
                                    <input type="hidden" value="<?php echo $page_count;?>" id="max_paged">
                                    <a href="javascript:void(0);" class="tbeer-btn tbeer-outline-btn tbeer-load-more"><?php _e('Load More','wodog')?></a>
                                </div><?php
                            echo'</div>';
                    endif;
                    wp_reset_postdata();?>
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
                </div>
            </div>
        </section>
        <!-- LATEST ARTICLE SECTION END -->
         <!-- MUST READ SECTION -->
         <?php if(isset($wodog_options['must_read'])&& $wodog_options['must_read']==1):?>
            <section class="tbeer-must-read-news-section tbeer-section">
                <div class="container">
                    <div class="row">
                        <div class="tbeer-section-title-wrapper">
                            <h3 class="tbeer-section-btn-style-title"><?php _e('Must Read','wodog');?></h3>
                        </div>
                        <div class="tbeer-main-content">
                             <?php
                             $header_args=array(
                                'post_type'=>'post',
                                'posts_per_page'=>esc_attr($wodog_options['left_must_read']),
                                'orderby' => 'date',
                                'order'   => 'DESC',
                                //'offset' =>esc_attr($wodog_options['right_must_read']),
                                'meta_query' => array(
                                    array(
                                        'key'     => '_wodog_must',
                                        'value'   => 'on',
                                        'compare' => '=',
                                    ),
                                ),
                            );
                                $header_query= new WP_Query($header_args);

                                if($header_query->have_posts()):
                                    echo '<div class="tbeer-must-read-news-wrapper col-md-7 col-sm-6 col-xs-12">';
                                    while($header_query->have_posts()):
                                    $header_query->the_post(); ?>
                                        <div class="tbeer-must-read-news">
                                            <!-- Image -->
                                            <?php
                                                $thumbnail = get_post_thumbnail_id($post->ID);
                                                $img_url = wp_get_attachment_image_src( $thumbnail,'full');
                                                $alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
                                            if($img_url):
                                                $n_img = aq_resize( $img_url[0], $width =220, $height = 220, $crop = true, $single = true, $upscale = true ); ?>
                                                <div class="tbeer-image-wrapper">
                                                    <img src="<?php echo esc_url($n_img);?>" alt="<?php echo esc_attr($alt);?>">
                                                </div>
                                            <?php else:
                                            $img_url=get_template_directory_uri().'/assets/images/no-image.png';
                                            $n_img = aq_resize( $img_url, $width =220, $height = 220, $crop = true, $single = true, $upscale = true );?>
                                                <div class="tbeer-image-wrapper">
                                                    <img src="<?php echo esc_url($img_url);?>" alt="No image">
                                                </div>
                                            <?php endif;?>
                                            <div class="tbeer-must-read-news-details">
                                                <div class="tbeer-category-meta"> <?php if (get_the_category()) : ?><?php the_category(' / ');endif; ?></div>
                                                <h3 class="tbeer-news-post-heading">
                                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                                </h3>
                                                <div class="tbeer-news-post-meta">
                                                    <span class="tbeer-news-post-date"><?php echo date("m.d.y");  ?></span>
                                                    <div class="tbeer-news-post-author"><?php the_author_posts_link(); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                echo '</div>';
                            endif;
                            wp_reset_postdata(); 

                            $header_args1=array(
                                'post_type'=>'post',
                                'posts_per_page'=>esc_attr($wodog_options['right_must_read']),
                                'orderby' => 'date',
                                'order'   => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key'     => '_wodog_must',
                                        'value'   => 'on',
                                        'compare' => '=',
                                    ),
                                ),
                            );
                            $header_query1= new WP_Query($header_args1);
                                if($header_query1->have_posts()):$i=1;
                                    echo ' <div class="tbeer-numbered-news-post-wrapper col-md-5 col-sm-6 col-xs-12">';
                                    while($header_query1->have_posts()):
                                    $header_query1->the_post(); ?>
                                        <div class="tbeer-numbered-news-post">
                                            <span class="tbeer-post-number"><?php echo $i;?></span>
                                            <h3 class="tbeer-news-post-heading">
                                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                            </h3>
                                        </div>
                                     <?php $i++;
                                    endwhile;
                                echo '</div>';
                            endif;
                            wp_reset_postdata();?>                      
                        </div>
                    </div>
                </div>
            </section>
        <?php endif;?>
<?php get_footer(); ?>