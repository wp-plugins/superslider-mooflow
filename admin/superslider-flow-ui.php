<?php
/*
Copyright 2008 daiv Mowbray

This file is part of superslider

superslider is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

superslider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Fancy Categories; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
	/**
   * Should you be doing this?
   */ 	
   $ssFlow_domain = 'superslider-mooflow'; 
   
	if ( !current_user_can('manage_options') ) {
		// Apparently not.
		die( __( 'ACCESS DENIED: Your don\'t have permission to do this.', 'superslider' ) );
		}
		if (isset($_POST['set_defaults']))  {
			check_admin_referer('ssFlow_options');
			$ssFlow_OldOptions = array(
				"load_moo" => "on",
				"css_load" => "default",
				"css_theme" => "default",
				"reflection" => "0.4",
				"useautoplay" => "true",
				"heightratio" => "0.6",
				"offsety" => "10",
				"startindex" => "0",
				"interval" => "3000",
				"factor" => "115",
				"bgcolor" => "#fff",
				"usecaption" => "true",
				"useresize" => "true",
				"useslider" => "true",
				"usewindowresize" => "true",
				"usemousewheel" => "true",
				"usekeyinput" => "true",
				"addslim"   => "true",
				"addjson"   => "false",
				"addajax"   => "false",
				"useviewer" => "true",
				"linked" => "image",
				"pop_size" => 'medium',
                "image_size" => 'thumbnail'
                );//end array
			
			update_option($this->AdminOptionsName, $ssFlow_OldOptions);
				
			echo '<div id="message" class="updated fade"><p><strong>' . __( 'superslider Default Options reloaded.', 'superslider' ) . '</strong></p></div>';
			
		}
		elseif ($_POST['action'] == 'update' ) {
			
			check_admin_referer('ssFlow_options'); // check the nonce
					// If we've updated settings, show a message
			echo '<div id="message" class="updated fade"><p><strong>' . __( 'superslider Options saved.', 'superslider' ) . '</strong></p></div>';
			
			$ssFlow_newOptions = array(
				'load_moo'		=> $_POST['op_load_moo'],
				'css_load'		=> $_POST['op_css_load'],
				'css_theme'		=> $_POST["op_css_theme"],
				'useautoplay'    => $_POST["op_useAutoPlay"],
				'reflection'=> $_POST["op_reflection"],
				'heightratio'   => $_POST["op_heightRatio"],				
				'offsety'		=> $_POST["op_offsetY"],
				'startindex'	=> $_POST["op_startIndex"],
				'interval'		=> $_POST["op_interval"],
				'factor'		=> $_POST["op_factor"],
				'bgcolor'		=> $_POST["op_bgColor"],
				'usecaption'	=> $_POST["op_useCaption"],
				'useresize'		=> $_POST["op_useResize"],
				'useslider'		=> $_POST["op_useSlider"],
				'usewindowresize'=> $_POST["op_useWindowResize"],
				'usemousewheel'	=> $_POST["op_useMouseWheel"],
				'usekeyinput'	=> $_POST["op_useKeyInput"],
				'addslim'	    => $_POST["op_addslim"],
				'addjson'	    => $_POST["op_addJson"],
				'addajax'	    => $_POST["op_addAjax"],
				'useviewer'		=> $_POST["op_useViewer"],
				'linked'		=> $_POST["op_linked"],
				'pop_size'		=> $_POST["op_pop_size"],
				'image_size'	=> $_POST["op_image_size"]
			);	

		update_option($this->AdminOptionsName, $ssFlow_newOptions);

		}	

		$ssFlow_newOptions = get_option($this->AdminOptionsName);   

	/**
	*	Let's get some variables for multiple instances
	*/
    $checked = ' checked="checked"';
    $selected = ' selected="selected"';
	$site = get_option('siteurl'); 
?>

<div class="wrap">
<form name="ssShow_options" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
<!-- possible auto save options : action="options.php" , bellow, update-options as nonce -->
<?php if ( function_exists('wp_nonce_field') )
		wp_nonce_field('ssFlow_options'); echo "\n"; ?>
		
<div style="">
<a href="http://wp-superslider.com/">
<img src="<?php echo $site ?>/wp-content/plugins/superslider-show/admin/img/logo_superslider.png" style="margin-bottom: -15px;padding: 20px 20px 0px 20px;" alt="SuperSlider Logo" width="52" height="52" border="0" /></a>
  <h2 style="display:inline; position: relative;">SuperSlider-Flow Options</h2>
 </div><br style="clear:both;" />
 <table class="form-table">	
	<tr
<?php if ($this->base_over_ride != "on") { 
  		 echo '';
  		} else {
  		echo 'style="display:none;"';
  		}?>	
	>
	<th scope="row">MooFlow Appearance</th>
		<td width="70%" valign="top">
		<fieldset style="border:1px solid grey;margin:10px;padding:10px 10px 10px 30px;"><!-- Theme options start -->  	
		<legend><b><?php _e(' Themes',$ssFlow_domain); ?>:</b></legend>
	
	<table width="100%" cellpadding="10" align="center">
	<tr>
		<td width="25%" align="center" valign="top"><img src="<?php echo $site ?>/wp-content/plugins/superslider-show/admin/img/default.png" alt="default" border="0" width="110" height="25" /></td>
		<td width="25%" align="center" valign="top"><img src="<?php echo $site ?>/wp-content/plugins/superslider-show/admin/img/blue.png" alt="blue" border="0" width="110" height="25" /></td>
		<td width="25%" align="center" valign="top"><img src="<?php echo $site ?>/wp-content/plugins/superslider-show/admin/img/black.png" alt="black" border="0" width="110" height="25" /></td>
		<td width="25%" align="center" valign="top"><img src="<?php echo $site ?>/wp-content/plugins/superslider-show/admin/img/custom.png" alt="custom" border="0" width="110" height="25" /></td>
	</tr>
	<tr>
		<td><label for="op_css_theme1">
			 <input type="radio"  name="op_css_theme" id="op_css_theme1"
			 <?php if($ssFlow_newOptions['css_theme'] == "default") echo $checked; ?> value="default" />
			</label>
		</td>
		<td> <label for="op_css_theme2">
			 <input type="radio"  name="op_css_theme" id="op_css_theme2"
			 <?php if($ssFlow_newOptions['css_theme'] == "blue") echo $checked; ?> value="blue" />
			 </label>
  		</td>
		<td><label for="op_css_theme3">
			 <input type="radio"  name="op_css_theme" id="op_css_theme3"
			 <?php if($ssFlow_newOptions['css_theme'] == "black") echo $checked; ?> value="black" />
			 </label>
  		</td>
		<td> <label for="op_css_theme4">
			 <input type="radio"  name="op_css_theme" id="op_css_theme4"
			 <?php if($ssFlow_newOptions['css_theme'] == "custom") echo $checked; ?> value="custom" />
			</label>
     </td>
	</tr>
	</table>
     <br /><span class="setting-description"><?php _e('  Choose a theme for your MooFlow. ',$ssFlow_domain); ?></span>
    

  </fieldset>
  </td>
		<td width="30%" valign="top">
		
		</td>
	</tr>
	
	<tr><th scope="row">Options</th>
		<td  width="70%" valign="top">
		<fieldset style="border:1px solid grey;margin:10px;padding:10px 10px 10px 30px;"><!-- MooFlow options start -->
   <legend><b><?php _e(' Personalize Appearence',$ssFlow_domain); ?>:</b></legend>
   <ul style="list-style-type: none;">
     <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">	
            
            
		 <label  for="op_reflection"><?php _e(' Reflection'); ?>:
		 <input type="text" class="span-text" name="op_reflection" id="op_reflection" size="4" maxlength="6"
		 value="<?php echo ($ssFlow_newOptions['reflection']); ?>" /></label> 
		 <span class="setting-description"><?php _e(' Reflection opacity (default 0.4)',$ssFlow_domain); ?></span>
         <br />
        
		 <label  for="op_heightRatio"><?php _e(' Height Ratio '); ?>:
		 <input type="text" class="span-text" name="op_heightRatio" id="op_heightRatio" size="4" maxlength="6"
		 value="<?php echo ($ssFlow_newOptions['heightratio']); ?>" /></label> 
		 <span class="setting-description"><?php _e(' Display height in relation to the display width. (default 0.6)',$ssFlow_domain); ?></span>
		 <br />

     <label  for="op_offsetY"><?php _e(' Floor offsetY '); ?>:
		 <input type="text" class="span-text" name="op_offsetY" id="op_offsetY" size="4" maxlength="20"
		 value="<?php echo ($ssFlow_newOptions['offsety']); ?>" /></label> 
		 <span class="setting-description"><?php _e('Move the floor down by increasing this offset. (default 10)',$ssFlow_domain); ?></span>
		 <br />

     <label  for="op_startIndex"><?php _e(' Start image '); ?>:
		 <input type="text" class="sstartIndex-text" name="op_startIndex" id="op_startIndex" size="4" maxlength="10"
		 value="<?php echo ($ssFlow_newOptions['startindex']); ?>" /></label> 
		 <span class="setting-description"><?php _e('Which image to start with in the sequence. (default 0)',$ssFlow_domain); ?></span>
		 <br />

     <label  for="op_interval"><?php _e(' Flow interval '); ?>:
		 <input type="text" class="span-text" name="op_interval" id="op_interval" size="4" maxlength="10"
		 value="<?php echo ($ssFlow_newOptions['interval']); ?>" /></label> 
		 <span class="setting-description"><?php _e('Display time per image when set to play. (default 3000)',$ssFlow_domain); ?></span>
		 <br />

     <label  for="op_factor"><?php _e(' Flow factor '); ?>:
		 <input type="text" class="span-text" name="op_factor" id="op_factor" size="4" maxlength="10"
		 value="<?php echo ($ssFlow_newOptions['factor']); ?>" /></label> 
		 <span class="setting-description"><?php _e('Scale difference between center and last image. (default 115)',$ssFlow_domain); ?></span>
		 <br />

     <label  for="op_bgColor"><?php _e(' Flow bgColor '); ?>:
		 <input type="text" class="span-text" name="op_bgColor" id="op_bgColor" size="4" maxlength="10"
		 value="<?php echo ($ssFlow_newOptions['bgcolor']); ?>" /></label> 
		 <span class="setting-description"><?php _e('Display area color. (default #fff)',$ssFlow_domain); ?></span>
	</li> 
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">		
        <label  for="op_useAutoPlayon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['useautoplay'] == "true") echo $checked; ?> name="op_useAutoPlay" id="op_useAutoPlayon" value="true" /> 
            <?php _e(' Include Play - Stop buttons on.',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_useAutoPlayoff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['useautoplay'] == "false") echo $checked; ?>  name="op_useAutoPlay" id="op_useAutoPlayoff" value="false" />
            <?php _e(' Play - Stop buttons off.',$ssFlow_domain); ?>
            </label>
      </li> 
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">	
        <label  for="op_useCaptionon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['usecaption'] == "true") echo $checked; ?> name="op_useCaption" id="op_useCaptionon" value="true" /> 
            <?php _e(' Image captions on (default).',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_useCaptionoff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['usecaption'] == "false") echo $checked; ?>  name="op_useCaption" id="op_useCaptionoff" value="false" />
            <?php _e(' Image captions off.',$ssFlow_domain); ?>
            </label>			
	</li> 
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">	
        <label  for="op_useResizeon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['useresize'] == "true") echo $checked; ?> name="op_useResize" id="op_useResizeon" value="true" /> 
            <?php _e(' Image resize on (default).',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_useResizeoff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['useresize'] == "false") echo $checked; ?>  name="op_useResize" id="op_useResizeoff" value="false" />
            <?php _e(' Image resize off.',$ssFlow_domain); ?>
            </label>			
	</li>
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">		
        <label  for="op_useSlideron">
            <input type="radio" 
            <?php if($ssFlow_newOptions['useslider'] == "true") echo $checked; ?> name="op_useSlider" id="op_useSlideron" value="true" /> 
            <?php _e(' Show Image Slider on (default).',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_useSlideroff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['useslider'] == "false") echo $checked; ?>  name="op_useSlider" id="op_useSlideroff" value="false" />
            <?php _e(' Image Slider off.',$ssFlow_domain); ?>
            </label>			
	</li> 
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">	
        <label  for="op_useWindowResizeon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['usewindowresize'] == "true") echo $checked; ?> name="op_useWindowResize" id="op_useWindowResizeon" value="true" /> 
            <?php _e(' Fullscreen button on (default).',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_useWindowResizeoff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['usewindowresize'] == "false") echo $checked; ?>  name="op_useWindowResize" id="op_useWindowResizeoff" value="false" />
            <?php _e(' Fullscreen button off.',$ssFlow_domain); ?>
            </label>			
	</li>
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">		
        <label  for="op_useMouseWheelon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['usemousewheel'] == "true") echo $checked; ?> name="op_useMouseWheel" id="op_useMouseWheelon" value="true" /> 
            <?php _e(' Mouse wheel on (default).',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_useMouseWheeloff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['usemousewheel'] == "false") echo $checked; ?>  name="op_useMouseWheel" id="op_useMouseWheeloff" value="false" />
            <?php _e(' Mouse wheel off.',$ssFlow_domain); ?>
            </label>			
	 </li> 
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 95%; float: left;">	
        <label  for="op_useKeyInputon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['usekeyinput'] == "true") echo $checked; ?> name="op_useKeyInput" id="op_useKeyInputon" value="true" /> 
            <?php _e(' Key input on (default).',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_useKeyInputoff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['usekeyinput'] == "false") echo $checked; ?>  name="op_useKeyInput" id="op_useKeyInputoff" value="false" />
            <?php _e(' Key input off.',$ssFlow_domain); ?>
            </label>			
	</li>

	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">		
        <label  for="op_useVieweron">
            <input type="radio" 
            <?php if($ssFlow_newOptions['useviewer'] == "true") echo $checked; ?> name="op_useViewer" id="op_useVieweron" value="true" /> 
            <?php _e(' Viewer on (default).',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_useVieweroff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['useviewer'] == "false") echo $checked; ?>  name="op_useViewer" id="op_useVieweroff" value="false" />
            <?php _e(' Viewer off.(Not compatible with Slimbox)',$ssFlow_domain); ?>
            </label>			
	</li>
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 50%; float: left;">		
        <label  for="op_op_addslimon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['addslim'] == "true") echo $checked; ?> name="op_addslim" id="op_addslimon" value="true" /> 
            <?php _e(' add Slimbox on (default).',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_addslim">
            <input type="radio" 
            <?php if($ssFlow_newOptions['addslim'] == "false") echo $checked; ?>  name="op_addslim" id="op_addslim" value="false" />
            <?php _e(' Slimbox off.(Not compatible with Viewer)',$ssFlow_domain); ?>
            </label>			
	</li><br style="clear:both;"/>
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
	 <label for="op_linked"><?php _e(' With Viewer on, Link images to:',$ssFlow_domain); ?></label>
            <select name="op_linked" id="op_linked">
                 <option <?php if($ssFlow_newOptions['linked'] == "image") echo $selected; ?> id="image" value='image'> image</option>
                 <option <?php if($ssFlow_newOptions['linked'] == "parent") echo $selected; ?> id="parent" value='parent'> parent</option>
                 <option <?php if($ssFlow_newOptions['linked'] == "attach") echo $selected; ?> id="attach" value='attach'> attach</option>     
            </select>
       </li>
       <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
				<label for="op_pop_size"><?php _e(' Popover Image size to use.',$ssFlow_domain); ?></label>
				<select name="op_pop_size" id="op_pop_size">
					 <option <?php if($ssFlow_newOptions['pop_size'] == "thumbnail") echo $selected; ?> id="op_pop_size1" value='thumbnail'> thumbnail</option>
					 <option <?php if($ssFlow_newOptions['pop_size'] == "medium") echo $selected; ?> id="op_pop_size2" value='medium'> medium</option>
					 <option <?php if($ssFlow_newOptions['pop_size'] == "slideshow") echo $selected; ?> id="op_pop_size3" value='slideshow'>custom slideshow</option>
					 <option <?php if($ssFlow_newOptions['pop_size'] == "large") echo $selected; ?> id="op_pop_size4" value='large'> large</option>
					 <option <?php if($ssFlow_newOptions['pop_size'] == "full") echo $selected; ?> id="op_pop_size5" value='full'> full</option>
				</select>
				<span class="setting-description"><?php _e(' Which image size to set as default for Popovers with light boxes.',$ssFlow_domain); ?></span>
	   </li>
	   <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
				<label for="op_image_size"><?php _e(' MooFlow Image size to use.',$ssFlow_domain); ?></label>
				<select name="op_image_size" id="op_image_size">
					 <option <?php if($ssFlow_newOptions['image_size'] == "thumbnail") echo $selected; ?> id="op_image_size1" value='thumbnail'> thumbnail</option>
					 <option <?php if($ssFlow_newOptions['image_size'] == "medium") echo $selected; ?> id="op_image_size2" value='medium'> medium</option>
					 <option <?php if($ssFlow_newOptions['image_size'] == "slideshow") echo $selected; ?> id="op_image_size3" value='slideshow'>custom slideshow</option>
					 <option <?php if($ssFlow_newOptions['image_size'] == "large") echo $selected; ?> id="op_image_size4" value='large'> large</option>
					 <option <?php if($ssFlow_newOptions['image_size'] == "full") echo $selected; ?> id="op_image_size5" value='full'> full</option>
				</select>
				<span class="setting-description"><?php _e(' Which image size to set as default for all Mooflow shows.',$ssFLow_domain); ?></span>
			</li>
<!--		<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 95%; float: left;">
	<p>The following are still being developed. Advanced users may like to do some beta testing.</p>
	</li>
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">		
        <label  for="op_addAjaxon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['addajax'] == "true") echo $checked; ?> name="op_addAjax" id="op_addAjaxon" value="true" /> 
            <?php _e(' add Ajax on.',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_addAjax">
            <input type="radio" 
            <?php if($ssFlow_newOptions['addajax'] == "false") echo $checked; ?>  name="op_addAjax" id="op_addAjax" value="false" />
            <?php _e(' add Ajax off (default).',$ssFlow_domain); ?>
            </label>			
	</li>
		<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">		
        <label  for="op_addJsonon">
            <input type="radio" 
            <?php if($ssFlow_newOptions['addjson'] == "true") echo $checked; ?> name="op_addJson" id="op_op_addJsonon" value="true" /> 
            <?php _e(' add Json on.',$ssFlow_domain); ?>
            </label>
            <br />
        <label  for="op_addJsonoff">
            <input type="radio" 
            <?php if($ssFlow_newOptions['addjson'] == "false") echo $checked; ?>  name="op_addJson" id="op_op_addJsonoff" value="false" />
            <?php _e(' addJson off (default).',$ssFlow_domain); ?>
            </label>			
	</li>-->
		
     </ul>
  </fieldset>
  
  </td>
		<td valign="top" width="30%">
		<p class="submit">
		<input type="submit" id="update1" class="button-primary" value="<?php _e(' Update options',$ssFlow_domain); ?> &raquo;" />
		</p>
		<p><?php _e('These options are global. You can modify most options within your individual post by adding options to the shortcode.',$ssFlow_domain); ?>
		</p>
		
		</td>
	</tr>

	<tr
<?php if ($this->base_over_ride != "on") { 
  		 echo '';
  		} else {
  		echo 'style="display:none;"';
  		}?> 
	><th scope="row">File Storage</th>
		<td>

	<fieldset style="border:1px solid grey;margin:10px;padding:10px 10px 10px 30px;">
   			<legend><b><?php _e(' Loading Options'); ?>:</b></legend>
  		 <ul style="list-style-type: none;">
  		<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">
    	<label for="op_load_moo">
    	<input type="checkbox" 
    	<?php if($ssFlow_newOptions['load_moo'] == "on") echo $checked; ?> name="op_load_moo" id="op_load_moo" />
    	<?php _e(' Load Mootools 1.2 into your theme header.',$ssFlow_domain); ?></label>
    	
	</li>
	
    <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px; width: 45%; float: left;">

    	<label for="op_css_load1">
			<input type="radio" name="op_css_load" id="op_css_load1"
			<?php if($ssFlow_newOptions['css_load'] == "default") echo $checked; ?> value="default" />
			<?php _e(' Load css from default location. superslider-show plugin folder.',$ssFlow_domain); ?></label><br />
    	<label for="op_css_load2">
			<input type="radio" name="op_css_load"  id="op_css_load2"
			<?php if($ssFlow_newOptions['css_load'] == "pluginData") echo $checked; ?> value="pluginData" />
			<?php _e(' Load css from plugin-data folder, see side note. (Recommended)',$ssFlow_domain); ?></label><br />
    	<label for="op_css_load3">
			<input type="radio" name="op_css_load"  id="op_css_load3"
			<?php if($ssFlow_newOptions['css_load'] == "off") echo $checked; ?> value="off" />
			<?php _e(' Don\'t load css, manually add to your theme css file.',$ssFlow_domain); ?></label>

    </li>
    </ul>
     </fieldset>
     </td>
		<td valign="top">
<?php if ($base_over_ride != "on") { 
  		 echo '<p ';
  		} else {
  		echo '<p style="display:none;">';
  		}?>
		><?php _e(' If your theme or any other plugin loads the mootools 1.2 javascript framework into your file header, you can disactivate it here.',$ssFlow_domain); ?></p>
		<p><?php _e(' Via ftp, move the folder named plugin-data from this plugin folder into your wp-content folder. This is recomended to avoid over writing any changes you make to the css files when you update this plugin.',$ssFlow_domain); ?>
		</p></td>
	</tr>
	
</table>
<p class="submit">
		<input type="submit" name="set_defaults" value="<?php _e(' Reload Default Options',$ssFlow_domain); ?> &raquo;" />
		<input type="submit" id="update4" class="button-primary" value="<?php _e(' Update options',$ssFlow_domain); ?> &raquo;" />
		<input type="hidden" name="action" id="action" value="update" />
 	</p>
 </form>
</div>
<?php
	echo "";
?>