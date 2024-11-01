<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       freshlabs.net
 * @since      1.0.0
 *
 * @package    Very_Fresh_Lexicon
 * @subpackage Very_Fresh_Lexicon/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="fp">

    <div class='container'>
      <header>
      	<img src="<?php echo esc_url( plugins_url( '/img/logo.png', dirname(__FILE__) ) )?>" class="logo" alt="Very fresh Lexicon Logo">
        <h1>Very fresh Lexicon</h1>

        <p>
          <?php _e('Have your own lexicon oder glossary in minutes.
Use Flexicon to create glossary like custom post-types the easy way. Define your custom post-type in Flexicon, for example "dictionary" or "glossary" and start creating items for it right away. Having a knowledgebase is beneficial for the user and your search engine results. This plugin can do it all. There is no pro version or subscription model to rip you off.'); ?>
        </p>
        
      </header>
      <?php /*
      <div class='form'>
          <h2 class="inner-title"><?php _e('Shortcode Generation', 'very-fresh-lexicon'); ?></h2>
          <div class='field'>
            <label for='password'><?php _e('Flex Category', 'very-fresh-lexicon'); ?></label>
            <input id='url' name='url' type='text' placeholder="Flex Category ID" value=''>
          </div>



          <div class="clear"></div>
          <button onclick="flGenerate()"><?php _e('Generate shortcode', 'very-fresh-lexicon'); ?></button>
          <div id="wrap-output" class="wrap-output">
            <h2 class="inner-title"><?php _e('Your shortcode:', 'very-fresh-lexicon'); ?></h2>
            <div id="output-shortcode" class="output-shortcode"  onclick="window.getSelection().selectAllChildren(document.getElementById('output-shortcode'))">
            </div>
          </div><!-- /.form -->
      </div>
      */?>



      <div class="container edit-css">
          <header>
            <h1 style="margin-top:40px"><?php _e('Custom URL', 'very-fresh-lexicon'); ?></h1>
          </header>
          <br><br>
          <form method="post" action="options.php" class="form">
            <?php settings_fields( 'very-fresh-lexicon-options' ); ?>
            <div class='field'>
<input type="text" id="fl-podcaster-custom-url" name="fl-podcaster-custom-url" value="<?php echo get_option('fl-podcaster-custom-url'); ?>" style="border: 1px solid #ddd; padding: 5px 15px;" placeholder="<?php 
if(get_option('fl-podcaster-custom-url')) {
echo get_option('fl-podcaster-custom-url');
} else {?>
fachlexikon
<?php
}
?>">
            </div>
            <div class="clear"></div>
            <input type="submit" name="submit" id="submit" value="<?php _e('Update the URL', 'very-fresh-lexicon'); ?>">
            <?php  //submit_button(); ?>
          </form>
      </div>



      <div class="container edit-css">
          <header>
            <h1 style="margin-top:40px"><?php _e('Custom CSS Code', 'very-fresh-lexicon'); ?></h1>
          </header>
          <br><br>
          <form method="post" action="options.php" class="form">
            <?php settings_fields( 'very-fresh-lexicon-options' ); ?>
            <div class='field'>
<textarea type="text" id="fl-podcaster-custom-style" name="fl-podcaster-custom-style" value="<?php echo get_option('fl-podcaster-custom-style'); ?>" style="min-height:300px; padding:10px;">
<?php 
if(get_option('fl-podcaster-custom-style')) {
echo get_option('fl-podcaster-custom-style');
} else {?>
.flex {

}
<?php
}
?></textarea>
            </div>
            <div class="clear"></div>
            <input type="submit" name="submit" id="submit" value="<?php _e('Save the code', 'very-fresh-lexicon'); ?>">
            <?php  //submit_button(); ?>
          </form>
      </div>





    </div><!-- /.container -->

</div>