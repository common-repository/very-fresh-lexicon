<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       freshlabs.net
 * @since      1.0.0
 *
 * @package    Very_Fresh_Lexicon
 * @subpackage Very_Fresh_Lexicon/public
 */


class Very_Fresh_Lexicon_Shortcodes {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $name    The ID of this plugin.
	 */
	private $name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $name, $version ) {

		$this->name    = $name;
		$this->version = $version;

		add_shortcode( 'flex', array( $this, 'shortcode_Very_Fresh_Lexicon' ) );
		

	}



	/**
	 * Shortcode function for returning 
	 *
	 * @since 2.3.5
	 * @param  array $attributes shortcode attributes
	 */
	public function shortcode_Very_Fresh_Lexicon($params = array()) {

		$a = shortcode_atts( array(
			'title' => 'Fachlexikon',
			'posts' => -1
		), $atts );

		$cat_name = get_cat_name($a['id']);

		$html .= '<div class="block-title">';
			$html .= '<h2>'.$a['title'].'</h2>';
		$html .= '</div><!-- /.block-title-->';
		$html .= '<div class="list-title">';

		$args = array(
			'post_type' 			=> 'flex',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order'		=> 'ASC'
		);

		$category_posts = new WP_Query($args);

		$html .= '<div class="wrap-wiki-item">';
		$html .= '<ul>';

		if($category_posts->have_posts()) : 
			while($category_posts->have_posts()) :
				$category_posts->the_post();   
				$html .= '<li>';
					$html .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
					$html .= '<p>'.get_the_excerpt().'<a href="'.get_permalink().'"> ...weiterlesen →</a>'.'</p>';
				$html .= '</li>';
			endwhile;
		else: 
			$html .= '<div>Keine Beiträge in der Kategorie Gefunden</div>';
		endif;
		wp_reset_postdata();


		$html .= '</ul><!--/.ul -->';
		$html .= '</div><!--/.wrap-wiki-item -->';

		return $html;



		// var_dump($params);

		// $attributes = shortcode_atts(
		// 	array(
	 //    'author' => 'Podcast. author',
	 //    'title' => 'Podcast Title',
	 //    'url' => '/wp-content/',
	 //    'class' => 'fl-green',
	 //    'colorone' => '#67b26f',
	 //    'colortwo' => '#4ca2cd'
	 //  ), $params);



		// return Very_Fresh_Lexicon_Public::display_flex($attributes);

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */

}
