<?php
/**



 * The template for displaying 404 pages (Not Found)



 *



 * @package WordPress



 * @subpackage Wodog



 * @since Wodog 1.0



 */
if ( !defined('ABSPATH') ) {
	echo '<h1>Forbidden</h1>'; 
	exit();
} 
get_header(); 
global $wodog_options; 
?>

<section class="tbeer-search-result-section tbeer-section tbeer-single-post-section">
	
	<div class="container">

		<div class="row">

			<div class="tbeer-single-post-wrapper">
				<h1><?php _e('404','wodog');?></h1>

				<p><?php _e('The Page You Looking For Doesn’t Exist','wodog');?></p>

			</div>

		</div>

	</div>
	
</section>

<?php get_footer(); ?>