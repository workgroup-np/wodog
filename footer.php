<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} $pageid=get_the_ID();global $wodog_options;  ?>

    <!-- FOOTER -->

        <footer>
            <!-- Footer Bottom -->

            <div class="tbeer-footer-bottom">

                <div class="container">

                    <div class="row">

                     <?php if($wodog_options['footer_copyright']):?>

                        <div class="tbeer-copyright-info">

                            <p><?php echo wp_kses_post($wodog_options['footer_copyright']);?></p>

                        </div>

                    <?php endif;?>

                        <div class="tbeer-footer-menu">

                            <?php

                                wp_nav_menu( array(

                                'theme_location'    => 'secondary',

                                'container'         => '',

                                'container_class'   => '',

                                'container_id'      => 'bs-example-navbar-collapse-1',

                                'menu_class'        => '',

                                'fallback_cb'       => 'wodog_bootstrap_navwalker::fallback',

                                'walker'            => new wodog_bootstrap_navwalker())

                                );

                            ?> 

                        </div>

                    </div>

                </div>

            </div>

            <!-- End -->

        </footer>

        <!-- FOOTER END -->

</div>

<?php if(isset($wodog_options['meta_javascript']) && $wodog_options['meta_javascript']!='')

echo wp_kses_post($wodog_options['meta_javascript']); ?>

<?php wp_footer(); ?>

<script type="text/javascript">

jQuery('body').on('click','#loadmore a',function(){

    var paged = jQuery('#paged').val();

    var next_num =parseInt(paged)+1;

    jQuery('#paged').val(next_num);

    var max_paged =jQuery('#max_paged').val();

    console.log(max_paged);

    if(parseInt(paged)>parseInt(max_paged))

    {

      return false;

    }

      jQuery.ajax({

        url: '<?php echo esc_url( get_template_directory_uri() );?>/inc/ajax.php',

        type: 'POST',

        data: 'action_type=loadmore&paged='+paged,

        beforeSend:function(xhr){

          jQuery('#loadmore a').html('Loading..');

        }

      })

      .done(function(result) {

        console.log(result);

        jQuery("#latest_post").append(result);

        if (parseInt(paged) == parseInt(max_paged))

        {

          jQuery("#loadmore a").hide();

          jQuery("#loadmore a").html('Load More');

        }

        else

        {

          jQuery("#loadmore a").show();

          jQuery("#loadmore a").html('Load More');

        }

      })

      .fail(function() {

        console.log("error");

      })

      .always(function() {

        console.log("complete");

      });

});

jQuery('body').on('click','#loadmore_cat a',function(){

    var paged = jQuery('#paged').val();var cat_id = jQuery('#cat_id').val();

    var next_num =parseInt(paged)+1;

    jQuery('#paged').val(next_num);

    var max_paged =jQuery('#max_paged').val();

    console.log(max_paged);

    if(parseInt(paged)>parseInt(max_paged))

    {

      return false;

    }

      jQuery.ajax({

        url: '<?php echo esc_url( get_template_directory_uri() );?>/inc/ajax.php',

        type: 'POST',

        data: 'action_type=loadmore_cat&cat_id='+cat_id+'&paged='+paged,

        beforeSend:function(xhr){

          jQuery('#loadmore_cat a').html('Loading..');

        }

      })

      .done(function(result) {

        console.log(result);

        jQuery("#latest_post").append(result);

        if (parseInt(paged) == parseInt(max_paged))

        {

          jQuery("#loadmore_cat a").hide();

          jQuery("#loadmore_cat a").html('Load More');

        }

        else

        {

          jQuery("#loadmore_cat a").show();

          jQuery("#loadmore_cat a").html('Load More');

        }

      })

      .fail(function() {

        console.log("error");

      })

      .always(function() {

        console.log("complete");

      });

});

</script>

    </body>

</html>