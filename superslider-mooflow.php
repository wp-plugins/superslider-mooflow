<?php
/*
Plugin Name: SuperSlider-Mooflow
Plugin URI: http://wp-superslider.com/superslider/superslider-mooflow
Description: This is an itunes like image scrubber. Uses the mootools javascript plugin Mooflow from http://www.outcut.de/MooFlow/
Author: Daiv Mowbray
Author URI: http://wp-superslider.com
Version: 0.7

Copyright 2008
       SuperSlider-flow is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License as published by 
    the Free Software Foundation; either version 2 of the License, or (at your
    option) any later version.

    SuperSlider-flow is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Categories; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("ssFlow")) {
	class ssFlow {
	
	/**
		* set up to load mootools and disable other plugun js loaders
		* define theme globally or mainyain plugin independent themes
		* activate mini plugs: reflection, tabs, milkbox, mediabox, folding comments, other?
		* 
		*/
		
		/**
		* @var string   The name the options are saved under in the dataFlow.
		*/
		var $flow_id;
		var $js_path;
		var $js_added;
		var $css_path;
		var $css_loaded;
		var $Flow_over_ride;
		var $show_over_ride;
		var $Slim_over_ride;
		var $ssFlowOpOut;
		var $ssBaseOpOut;
		var $defaultAdminOptions;
		var $AdminOptionsName = 'ssFlow_options';
	
	// Pre-2.6 compatibility
	function set_flow_paths($css_load, $css_theme) {
		if ( !defined( 'WP_CONTENT_URL' ) )
			define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
		if ( !defined( 'WP_CONTENT_DIR' ) )
			define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
		if ( !defined( 'WP_PLUGIN_URL' ) )
			define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
		if ( !defined( 'WP_PLUGIN_DIR' ) )
			define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
		if ( !defined( 'WP_LANG_DIR') )
			define( 'WP_LANG_DIR', WP_CONTENT_DIR . '/languages' );
        if ($css_load == 'default') {
            $this->css_path = WP_PLUGIN_URL.'/superslider-mooflow/plugin-data/superslider/ssFlow/'.$css_theme;	
        }elseif ($css_load == 'pluginData') {
            $this->css_path = WP_CONTENT_URL.'/plugin-data/superslider/ssFlow/'.$css_theme;
        }elseif ($css_load == 'off') {
            $this->css_path = '';
        }

	}
		/**
		* PHP 4 Compatible Constructor
		*/
	function ssFlow() {
	   ssFlow::Flow();
	}
		
		/**
		* PHP 5 Constructor
		*/		
	function __construct() {		
		self::Flow();
	
	}// end construct
	
	
	function Flow() {

			register_activation_hook(__FILE__, array(&$this,'flow_init') ); //http://codex.wordpress.org/Function_Reference/register_activation_hook
			register_deactivation_hook( __FILE__, array(&$this,'ssFlow_ops_deactivation') ); //http://codex.wordpress.org/Function_Reference/register_deactivation_hook
			
			add_action( 'init', array(&$this,'flow_init' ) );
			add_action ( "admin_menu", array(&$this,"flow_print_box" ) ); 			// adds the shortcode meta box
	}
	
			/**
		* Retrieves the options from the dataFlow.
		* @return array
		*/			
	function set_default_admin_options() {
		global $defaultAdminOptions; 
		
		$defaultAdminOptions = array(
				"load_moo" => "on",
				"css_load" => "default",
				"css_theme" => "default",
				"reflection" => "0.4",
				"useautoplay" => "true",
				"heightratio" => "0.7",
				"offsety" => "10",
				"startindex" => "0",
				"interval" => "2500",
				"factor" => "115",
				"bgcolor" => "#fff",
				"usecaption" => "true",
				"useresize" => "true",
				"useslider" => "true",
				"usewindowresize" => "true",
				"usemousewheel" => "true",
				"usekeyinput" => "true",
				"addslim" => "false",
				"addjson" => "false",
				"addajax" => "false",
				"useviewer" => "true",
				"linked" => "image",
				"pop_size" => 'medium',
                "image_size" => 'thumbnail'
                );
		
		
		$defaultOptions = get_option($this->AdminOptionsName);
		if (!empty($defaultOptions)) {
			foreach ($defaultOptions as $key => $option) {
				$defaultAdminOptions[$key] = $option;
			}
		}
		update_option($this->AdminOptionsName, $defaultAdminOptions);
		return $defaultAdminOptions;
		
	}

		/**
		* Saves the admin options to the dataFlow.
		*/
	function save_default_flow_options() {
		update_option($this->AdminOptionsName, $this->defaultAdminOptions);
	}
		
		/**
		* load default options into data Flow
		*/		
	function flow_init() {

  			$this->defaultAdminOptions = $this->set_default_admin_options();
  			$this->ssFlowOpOut = get_option($this->AdminOptionsName);
  			$this->js_path = WP_CONTENT_URL . '/plugins/'. plugin_basename(dirname(__FILE__)) . '/js/';
  			
  			extract($this->ssFlowOpOut);
  			//$this->Flow_over_ride = $ss_global_over_ride;
  			if (class_exists('ssBase')) {
				$this->ssBaseOpOut = get_option('ssBase_options');
				extract($this->ssBaseOpOut);
				$this->base_over_ride = $ss_global_over_ride;
			}else{
			$this->base_over_ride = 'false';
			}
			
			// lets see if the ss-Show plugin is here
			if (class_exists('ssShow')) {
					$this->show_over_ride = 'true';
				}else{
				$this->show_over_ride = 'false';
				}
				
			if (class_exists('ssSlim')) {
				$this->Slim_over_ride = 'true';
			}else{
			$this->Slim_over_ride = 'false';
			}
			
  			$this->set_flow_paths($css_load, $css_theme);
  			
  			add_action( 'admin_menu', array(&$this,'flow_setup_optionspage'));					
			add_action ( 'template_redirect' , array(&$this,'flow_scan') );
            add_shortcode ( 'mooflow' , array(&$this, 'flow_shortcode_out')); 
            
            wp_register_script(
			'moocore',
			$this->js_path.'mootools-1.2.3-core-yc.js',
			NULL, '1.2.3');
			
			wp_register_script(
			'moomore',
			$this->js_path. 'mootools-1.2.3.1-more.js',
			array( 'moocore' ), '1.2.3');
					
			wp_register_script(
			'mooflow',
			$this->js_path. 'mooflow.js',
			array( 'moocore' ), '1.2');

	}
	
		/**
		* Initialize the admin panel, Add the plugin options page, loading it in from superslider-flow-ui.php
		*/
	function flow_setup_optionspage() {
		if (  function_exists('add_options_page') ) {
			if (  current_user_can('manage_options') ) {
				if (!class_exists('ssBase')) add_options_page(__('SuperSlider Flow'),__('SuperSlider-Flow'), 8, 'superslider-flow', array(&$this, 'flow_ui'));
				add_filter('plugin_action_links', array(&$this, 'filter_plugin_flow'), 10, 2 );
				//add_action('admin_head', array(&$this,'ssbox_admin_style'));
			}					
		}

	}
		/**
		* Load admin options page
		*/
	function flow_ui() {
		global $base_over_ride;
		$ssFlow_domain = 'superslider-mooflow';
		include_once 'admin/superslider-flow-ui.php';
		
	}
	
		/**
		* Add link to options page from plugin list WP 2.6.
		*/
	function filter_plugin_flow($links, $file) {
		 static $this_plugin;
			if (  ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);

		if (  $file == $this_plugin )
			$settings_link = '<a href="admin.php?page=superslider-flow">'.__('Settings').'</a>';
			array_unshift( $links, $settings_link ); //  before other links
			return $links;
	}
	
		/**
		* Removes user set options from data Flow upon deactivation
		*/		
	function ssFlow_ops_deactivation(){
		delete_option($this->AdminOptionsName);
	}

	function flow_add_js(){
		extract($this->ssFlowOpOut);

        if (!is_admin() && $this->js_added != 'true') {				
            if (function_exists('wp_enqueue_script')) {
                if ($this->base_over_ride != "on") {
                    if ($load_moo == 'on'){	
                        wp_enqueue_script('moocore');		
						wp_enqueue_script('moomore');
					 }
                }
             wp_enqueue_script('mooflow');	
            //echo "\t".'<script src="'.$this->js_path.'mooflow.js" type="text/javascript"></script> '."\n";
            
            }// is wp_enqueue_script
            
        }// is not admin
        $this->js_added = 'true';
	}
	function add_viewer($useviewer) {
	       if ($useviewer == 'true' ){
                echo "\t".'<script src="'.$this->js_path.'mooflowviewer.js" type="text/javascript"></script> '."\n";
           }
	}
	function add_Slim() {
	   extract($this->ssFlowOpOut);
	   if ($this->Slim_over_ride != "true" && $addslim == 'true') { 
                echo "\t".'<script src="'.$this->js_path.'slimbox.js" type="text/javascript"></script> '."\n";
                echo "\t".'<link type="text/css" rel="stylesheet" rev="stylesheet" href="'.$this->css_path.'/slimbox.css" media="screen" />'."\n";
        }
	}
	function flow_add_css() {    
        extract($this->ssFlowOpOut);
        if (class_exists('ssBase')) {
					extract($this->ssBaseOpOut);					
				}	
        						
		if ($css_load != 'off' && $this->css_loaded != 'true') {
		      echo "\t".'<link type="text/css" rel="stylesheet" rev="stylesheet" href="'.$this->css_path.'/mooflow.css" media="screen" />'."\n";
		      
		      if ($useviewer == 'true') echo "\t".'<link type="text/css" rel="stylesheet" rev="stylesheet" href="'.$this->css_path.'/mooflowviewer.css" media="screen" />'."\n";
		$this->css_loaded = 'true';
		}

   }
	function flow_change_options( $atts ){
		global $post;
 
		$this->ssFlowOpOut = array_merge($this->ssFlowOpOut, array_filter($atts)); 		
  		return $this->ssFlowOpOut;
	}

    function flow_get_random_posts($numposts = '5',$category = '') {
        global $wpdb ;  // on windows server RAND() needs to be NEWID() 
        $notfirst = false;        
        if($category == ''):
            $sql = "SELECT $wpdb->posts.ID 
                    FROM $wpdb->posts 
                    WHERE $wpdb->posts.post_status = 'inherit' 
                    AND $wpdb->posts.post_type = 'attachment'
                    ORDER By RAND()
                    LIMIT $numposts";
        else:
            
                $sql = "SELECT $wpdb->posts.ID ";
                $sql.= "FROM $wpdb->posts, $wpdb->term_relationships, $wpdb->term_taxonomy ";
                $sql.= "WHERE $wpdb->posts.post_status = 'inherit' ";
                $sql.= "AND $wpdb->posts.post_type = 'attachment' ";
            /**/	$sql.= 'AND ';
                $sql.= '( ';
                $sql.= "$wpdb->posts.ID = $wpdb->term_relationships.object_id ";
                $sql.= "AND $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id ";
                $sql.= "AND $wpdb->term_taxonomy.term_id = $category ";
                    $sql.= ')';
                $sql.= "ORDER By RAND() ";
                $sql.= "LIMIT $numposts ";
    
        endif;
        $the_ids = $wpdb->get_results($sql);
        shuffle($the_ids);
    
        if ($the_ids) return $the_ids;
        
    }
    function array_push_assoc($array, $key, $value){
                         $array[$key] = $value;
                         return $array;
    }
    /**
	* add the accordion code
	*/
    function flow_shortcode_out ($atts, $content='') {
        global $post;
        
        srand((double)microtime()*1000000); 
		$this->flow_id = rand(0,1000); 
        
         $atts = shortcode_atts(array(
            'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
            'id' => $post->ID,
            'numposts'  =>  '',
            'catid'  =>  '',
            'reflection' => '',
            'useautoplay' => '',
            'heightratio' => '',
            'offsety' => '',
            'startindex' => '',
            'interval' => '',
            'factor' => '',
            'bgcolor' => '',
            'usecaption' => '',
            'useresize' => '',
            'useslider' => '',
            'usewindowresize' => '',
            'usemousewheel' => '',
            'usekeyinput' => '',
            'addajax' => '',
            'addjson' => '',
            'addslim' => '',
            'useviewer' => '',
            'linked'    =>  ''
            ), $atts);

		// opdate options if any changes with shortcode
		if ($atts !='') $this->flow_change_options($atts);	
         
	       
        extract($this->ssFlowOpOut);	    

        if (array_key_exists('id', $atts) && ( $atts['id'] != '')) {
            $id = $atts['id'];

            } else{
            $id = $post->ID;;
            }

		if (strpos($id, ',')) {	
			$idz = explode(', ', $id); // turns the variable string $id into an array $idz
			$all_attachments = array();	// pre define the master array

				foreach ($idz as $id) {		//loop through the array of posts and get their attachments		
					$id = intval($id);
					$attachments = get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby={$orderby}");
					
				if($attachments !== false)$all_attachments += $attachments;
				}

		} elseif ($id =='random') {

              $catid = '';// this needs to be fixed in the sql call above.
              $idz = $this->flow_get_random_posts($numposts,$catid);
              $all_attachments = array();

             foreach ($idz as $id) {
                
					$id = intval($id->ID);
                    $attachments = get_post( $id, OBJECT );
                    $type = $attachments->post_mime_type;
                    $att = 'image';
                    $pos = strpos ( $type,$att );

                if($pos !== false) {

                    $key = $attachments->ID;                   
                    if($attachments !== false) $all_attachments = $this->array_push_assoc($all_attachments, $key, $attachments);                    
                }
			}	
             
        } elseif (($id == $post->ID) || ($id !== '')){ 
             				
                $all_attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );			   
           
        
        } 
        

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $all_attachments as $id => $attachment )
				$output .= wp_get_attachment_link($id, $size = 'thumbnail', true) . "\n";
			return $output;
		}

		
		$output = $this->add_viewer($useviewer);
        $output .= $this->flow_starter();// write in the javascript flow starter
                
        // wrap the content in a mooflow div
        $output .= '<div id="mooflow'.$this->flow_id.'" class="moo" style="visibility: hidden;">';
           
          if ($all_attachments !== false) {
           foreach ( $all_attachments as $id => $attachment ) {    
			$my_parent = ($attachment->post_parent);
			$parent_title = get_the_title($my_parent);
			$parent_link = get_permalink($my_parent);
			$att_page = get_attachment_link($id, NULL , true);
			$image = wp_get_attachment_image_src($id, $size = $image_size);// $image_size, $pop_size
			$att_image = wp_get_attachment_image_src($id, $size = $pop_size);
		

			if ( $linked == 'image') {
				$linkto = 'href="'.$att_image[0].'"';
				$a_rel = 'rel="image"';
				$a_class = ' tool';
				$a_title = 'title="'.$attachment->post_title.'"';
				$alt = 'alt="'.$attachment->post_excerpt.' :: '.$attachment->post_content.'"';
			}
			elseif ($linked == 'parent') { 
				$linkto = 'href="'.$parent_link.'"';
				$a_rel = 'rel="link"';
				$a_class = ' ';
				$a_title = 'title="'.$parent_title.'"';
				$alt = 'alt="'.$attachment->post_excerpt.' :: '.$attachment->post_content.'"';
			}
			elseif ($linked == 'attach') {
				$linkto = 'href="'.$att_page.'"';
				$a_rel = 'rel="link"';
				$a_class = ' ';
				$a_title = 'title="'.$attachment->post_title.'"';
				$alt = 'alt="'.$attachment->post_excerpt.' :: '.$attachment->post_content.'"';
			}
        	
        	if ($useviewer !== 'false') $output .= "\n\t"."<a $linkto $a_rel class=\"$a_class\" $a_title >"."\n";
			
		// output the main images  alt=\"{$attachment->post_title}\"
			$output .= "<img id=\"slide-$id\" src=\"$image[0]\"  $a_title  $alt width=\"$image[1]\" height=\"$image[2]\" style=\"visibility: hidden; opacity: 0;\" />";		
			
			if ($useviewer !== 'false') $output .= "</a>"."\n";
			
			
		 } // end foreach	
        } // end if attachments are empty 
        $output .= $content.'</div>';
        
//var_dump ($this->ssFlowOpOut);

        return do_shortcode($output);
        
    }
	
	function flow_starter(){
		extract($this->ssFlowOpOut);	

        /*
        * this is to bind the viewer to the mooflow, adds icons to the item links, and tooltips.
        */
        if ($useviewer == 'true' && $addslim != 'true'){
            $myviewer = "ssFlow".$this->flow_id.".attachViewer();";
        } else { $myviewer = ''; }
        
        /**
        *   This will filter a json page for images with this link: <a class="loadjson" href="http://domain.com/test.json" rel=".icons" >Remote Images from a json file with Filter</a>
        *   the json looks like this:
            {"images":[
            {"src":"img/youtube.png", "alt":"Share you", "title":"YouTube", "rel":"link", "href":"http://www.domain.com/"},
            {"src":"img/technorati.png", "alt":"Techno", "title":"Technor", "rel":"link", "href":"http://www.domain.com/"},
            {"src":"img/rss2.png", "alt":"All the Best", "title":"RSS asq", "rel":"link", "href":"http://www.domain.com/"}
            ]}
        *   It will search for images within list images.
       */
 
        if ($addjson == 'true'){     
              $myjson = "$$('.loadjson').addEvent('click', function(){
                    ssFlow".$this->flow_id.".loadJSON(this.get('href'));
                    return false;
                });";
        } else { $myjson =''; }
        
        /**
        *   This will filter another page for images : <a class="loadremote" href="http://domain.com/test.html" rel=".icons" >Remote Images from an HTML-Page with Filter</a>
        *   It will search for images with the class of icons.
       */
  
        if ($addajax == 'true') {     
              $myajax = "$$('.loadremote').addEvent('click', function(){
                    ssFlow".$this->flow_id.".loadHTML(this.get('href'), this.get('rel'));
                    return false;
                });";
        } else { $myajax =''; }
    

        if ($addslim == 'true' && $useviewer != 'true') {
            $mySlim = "onClickView: function(obj){
				Slimbox.open(obj.href, obj.title + ' - ' + obj.alt);

			},";
        } else {  $mySlim = ''; }
        
        $flowcontainer = 'mooflow'.$this->flow_id;        
		$myflow = 'var myMooFlow'.$this->flow_id.' = {
		start: function(){
		
		var ssFlow'.$this->flow_id.' = new MooFlow($(\''.$flowcontainer.'\'), {   
				useViewer : '.$useviewer.',
				useAutoPlay: '.$useautoplay.',
				heightRatio : '.$heightratio.',
				offsetY : '.$offsety.',
				startIndex : '.$startindex.',
				interval : '.$interval.',
				factor : '.$factor.',
				bgColor : \''.$bgcolor.'\',
				useCaption : '.$usecaption.',
				useResize : '.$useresize.',
				useSlider : '.$useslider.',
				useWindowResize : '.$usewindowresize.',
				useMouseWheel : '.$usemousewheel.',
				useKeyInput : '.$usekeyinput.',
				'.$mySlim.'
				reflection : '.$reflection.'
                            });
                '.$myviewer.'
                '.$myajax.'
                '.$myjson.'
                }';

            $flowOut = "\n\t"."<script type=\"text/javascript\">\n";
			$flowOut .= "\t"."/* <![CDATA[*/\n";
		    $flowOut .= "\t".$myflow."\n};\n";
			$flowOut .= "window.addEvent('domready', myMooFlow".$this->flow_id.".start);\n";
			$flowOut .= "\t"."/* ]]>*/</script>\n";

			echo $flowOut;
				
    }

	/**
	*	Look ahead to check if any posts contain the <div id="slider">
	*/
	function flow_scan () { 
	   global $posts; 
	   extract($this->ssFlowOpOut);
	   
        if ( !is_array ( $posts ) ) 
                return; 	 
        foreach ( $posts as $mypost ) {         
                if ( false !== strpos ( $mypost->post_content, '[mooflow' ) ) {   
                        add_action ( "wp_print_scripts", array(&$this,"flow_add_js"));
                        add_action ( "wp_head", array(&$this,"add_Slim"));
                        add_action ( "wp_head", array(&$this,"flow_add_css"));                                              
                        break; 
                }
             
         }
        /**
        *   call milk plugin class to load its scripts
        *   milk has been discontinued
        */

      // if (class_exists('ssMilk')) { ssMilk::milk_scan();   }
     }


    	/**
		*	creates flow metabox in post window
		*/
		
	function flow_print_box() {
		global $ssFlow_domain;
		$this->ssFlowOpOut = get_option($this->AdminOptionsName);
		extract($this->ssFlowOpOut);

		//if	($mooflow == 'on')	{
			if (is_admin ()) {			
				if( function_exists( 'add_meta_box' )) {
					add_meta_box( 'ss_flow', __( 'SuperSlider-MooFlow', $ssFlow_domain ), array(&$this,'flow_writebox'), 'post', 'advanced', 'high');
					add_meta_box( 'ss_flow', __( 'SuperSlider-MooFlow', $ssFlow_domain ), array(&$this,'flow_writebox'), 'page', 'advanced', 'high' );
				}
			}
   		//}
	}
	 
    function flow_writebox() {
		
		extract($this->ssFlowOpOut);
		include_once 'admin/superslider-flow-box.php';
		echo $box;		
		include_once 'admin/js/superslider-flow-box.js';
	}
	
    function ssflow_template($green)  {
        if (class_exists('ssFlow')) {
        echo 'this is the color:'.$green.' qwerty:';
        
        ssFlow::flow_add_css();
        
        
       
        add_action ( "wp_footer", "ssFlow::flow_add_js");
        /* add_action ( "wp_print_scripts", array(&$this,"add_Slim"));
        add_action ( "template_redirect", array(&$this,"ssflow_template_scripts"));
        */
        }
    }
    function ssflow_template_scripts()  {
        add_action ( "wp_head", array(&$this,"flow_add_css"));
    }
    
    
    
}	//end class
} //End if Class ssFlow

/**
*instantiate the class
*/	
if (class_exists('ssFlow')) {
	$myssFlow = new ssFlow();
}
?>