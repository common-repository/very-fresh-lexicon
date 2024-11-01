<?php

get_header(); ?>


<?php 
function get_excerpt($limit, $source = null){

    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    return $excerpt;
}
?>



	<div id="content-wrap" class="container clr"  style="margin-bottom:40px">

		<div id="primary" class="content-area clr">
				
				<h1 class="h-wiki-item">Das Fachlexikon</h1>
				
				<div class="flex-subnav">

<?php 
        for($letter_count="a"; $letter_count <= "y"; $letter_count++){
?>

<?php 
				$argsx = ( array(
					'order' => 'ASC',
					'orderby' => 'title',
					'post_type' => 'flex',
					'posts_per_page' => -1,
					'starts_with' => $letter_count
				) );
				$my_query = new WP_Query($argsx);
				if ($my_query->have_posts()) {
					?>
					<a href="<?php echo get_site_url(); ?>/fachlexikon/?letter=<?php echo $letter_count;?>" class="letter existing"><?php echo $letter_count; ?></a> 
					<?php 
				} else {
				?>
					<a class="letter"><?php echo $letter_count; ?></a>
				<?php
				}
				wp_reset_query();?>


<?php 		if($letter_count == 'M') {
						echo '<div class="flex-break"></div>';
					}
        }
 ?>
 				<a class="letter z">z</a> 
				</div><!-- /.flex-subnav -->

					<?php $param_letter = esc_html( $_GET['letter'] ); ?>
					<?php
					if ($param_letter) {
						$args = ( array(
							'order' => 'ASC',
							'orderby' => 'title',
							'post_type' => 'flex',
							'posts_per_page' => -1,
							'starts_with' => $param_letter
						 ) );
					} else {
						$args = ( array(
							'order' => 'ASC',
							'orderby' => 'title',
							'post_type' => 'flex',
							'posts_per_page' => -1
						 ) );
					}
				 	?>
					<?php 

					query_posts($args);
					?>

					<?php 
						$curr_letter = ''; 

					?>
					<?php while ( have_posts() ) : the_post();

					$first_letter = substr(get_the_title(),0,1);

					if($curr_letter == '') {
					?>
						<div class="flexletter-hold" id="letter-<?php echo $first_letter;?>"><?php echo $first_letter;?></div>

						<div class="wrap-wiki-item">
							<ul>
					<?php 
					} else if($curr_letter != $first_letter) {
					?>
							</ul>
						</div><!-- /.wrap-wiki-item -->
						<div class="flexletter-hold" id="letter-<?php echo $first_letter;?>"><?php echo $first_letter;?></div>
						<div class="letter-line"></div>
						<div class="wrap-wiki-item">
							<ul>
					<?php 
					}
					?>

					<li>
						<?php
							if(has_post_thumbnail()) {
						?>
							<div class="thumbnail-hold">
								<img src="<?php the_post_thumbnail_url(array(100, 100)); ?>" alt="">
							</div>
						<?php
							}
						 ?>
						<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo get_excerpt(210); ?><a href="<?php echo get_permalink(); ?>"> ...weiterlesen →</a></p>
					</li>

					<?php 
						$curr_letter = $first_letter;
						endwhile; // end of the loop. ?>
					</ul>
				</div><!-- /.wrap-wiki-item -->

		</div><!-- #primary -->

	</div><!-- #content-wrap -->

<?php get_footer(); ?>