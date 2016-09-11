 <?php get_header(); global $wodog_options; ?>

 <section class="tbeer-latest-article-section tbeer-section wodog-category-post-section">

    <div class="container">

        <div class="row">

         <?php

          $category=get_queried_object(); $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 

          $total_pages=$wp_query->max_num_pages;

          $posts_per_page=6;

          $cat_args=array('posts_per_page' => $posts_per_page, 'order'=> 'DESC', 'orderby' => 'date','cat'=>$category->term_id );

			$cat_query= new WP_Query($cat_args);

			if($cat_query->have_posts()):

            echo '<div class="tbeer-main-content col-md-8 col-sm-8 col-xs-12">

                    <h3 class="tbeer-section-title">Category: '.$category->name.'</h3>

                      <div id="latest_post" class="tbeer-latest-article-wrapper">';

                    while ($cat_query->have_posts()) :$cat_query->the_post();?>

                       <!-- Latest Article -->

                            <div class="tbeer-latest-article-post">

                            <?php

                                $thumbnail = get_post_thumbnail_id($post->ID);

                                $img_url = wp_get_attachment_image_src( $thumbnail,'full');

                                $alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);

                            if($img_url):

                                $n_img = aq_resize( $img_url[0], $width =315, $height = 315, $crop = true, $single = true, $upscale = true ); ?>

                              <div class="tbeer-image-wrapper">

                                    <img src="<?php echo esc_url($n_img);?>" alt="<?php echo esc_attr($alt);?>">

                                </div>

                            <?php else:

                            $img_url=get_template_directory_uri().'/assets/images/no-image.png';

                            $n_img = aq_resize( $img_url, $width =315, $height = 315, $crop = true, $single = true, $upscale = true );?>

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

                    $style="";
                    
                    if($cat_query->found_posts<=$posts_per_page)
                    
                    {
                    
                    $style="display:none";
                    
                    }

                  $total_post = $cat_query->found_posts;

                  $raw_page = $total_post%$posts_per_page;

                  if($raw_page==0){$page_count_raw = $total_post/$posts_per_page; }else{$page_count_raw = $total_post/$posts_per_page+1;}

                     $page_count = floor($page_count_raw);

                            ?>

                  <div class="tbeer-load-more-wrapper" id="loadmore_cat" style="<?php echo $style;?>">

                      <input type="hidden" value="2" id="paged">

                      <input type="hidden" value="<?php echo $category->term_id;?>" id="cat_id">

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

<?php get_footer(); ?>