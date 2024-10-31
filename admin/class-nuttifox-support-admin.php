<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://nuttifox.com
 * @since      1.0.0
 *
 * @package    Nuttifox_Support
 * @subpackage Nuttifox_Support/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nuttifox_Support
 * @subpackage Nuttifox_Support/admin
 * @author     Nuttifox <hello@nuttifox.com>
 */
class Nuttifox_Support_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		//add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );
		add_action('wp_ajax_nuttifox_support_email', 'nuttifox_send_support_email');
		add_action('wp_ajax_nopriv_nuttifox_support_email', 'nuttifox_send_support_email');
		add_action( 'admin_footer', 'nuttifox_support_fw_dashboard_widget' );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nuttifox_Support_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nuttifox_Support_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nuttifox-support-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nuttifox_Support_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nuttifox_Support_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nuttifox-support-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'nuttifoxmail', array('ajax_url' => admin_url( 'admin-ajax.php' )));
		wp_enqueue_script( 'slaask', '//cdn.slaask.com/chat.js', array( 'jquery' ), $this->version, false );
	}

}

function nuttifox_support_fw_dashboard_widget() {
	if ( get_current_screen()->base !== 'dashboard' ) {
		return;
	}
	$current_user = wp_get_current_user();
	?>
	
	<div id="nuttifox_panel" style="display: none;">
		<div class="welcome-panel">
		<div class="welcome-panel-content">
			<a href="https://nuttifox.com" target="_blank" alt="Nuttifox.com - Digital Creative, Marketing & Technology Experts">
				<img class="nuttifox_logo" src="https://cdn-59f269e3f911c8334444cf34.closte.com/wp-content/themes/nuttifox/images/nuttifox-logo.png">
			</a>
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<p class="nuttifox_hello">Hello <?php if( !empty($current_user->first_name)) { echo $current_user->first_name; } else { echo $current_user->user_login; } ?></p>
					<form id="support_request_nuttifox">
					<textarea id="problem_description" type="text-area" placeholder="Describe your problem"></textarea>
					<input type="submit" class="button button-primary button-hero load-customize hide-if-no-customize" type="submit" value="Send Support request"></input>
					<input type="submit" class="button button-primary button-hero hide-if-customize" type="submit" value="Send Support request"></input>
					</form>
					<div id="support_request_nuttifox_done" style="display: none;">
						<span style="color: #d8451c;font-weight: bold;">Your support request is on its way to Nuttifox !</span>
						We will get back to you as soon as possible, 
						until then check our latest post:

						<?php
							$response = wp_remote_get( add_query_arg( array(
								'per_page' => 1
							), 'https://nuttifox.com/wp-json/wp/v2/posts' ) );
							if( !is_wp_error( $response ) && $response['response']['code'] == 200 ) {
								$remote_posts = json_decode( $response['body'] ); // our posts are here
								foreach( $remote_posts as $remote_post ) {
									echo '<a href="'. $remote_post->link . '" target="_blank"><h4>'. $remote_post->title->rendered . '</h4></a>';
								}
							}
						?>
						
					</div>
					<p class="hide-if-no-customize or_live">or, <a href="#" id="nuttifox_live" class="simple">use the live chat</a></p>
				</div>
				<div class="welcome-panel-column scale">
					<h3>SCALE</h3>
					<ul>
						<li><a href="https://nuttifox.com/scale/content-marketing/" class="" target="_blank">Content Marketing</a></li>
						<li><a href="https://nuttifox.com/scale/email-marketing-crm/" class="" target="_blank">Email Marketing & CRM</a></li>
						<li><a href="https://nuttifox.com/scale/lead-generation/" class="" target="_blank">Leade Generation</a></li>
						<li><a href="https://nuttifox.com/scale/seo/" class="" target="_blank">SEO Services</a></li>
					</ul>
				</div>
				<div class="remote_posts welcome-panel-column resources">
				<h3>RESOURCES</h3>
				<ul>
						<li><a href="https://nuttifox.com/resources/marketing-questionnaire/" class="" target="_blank">Marketing Questionnaire</a></li>
						<li><a href="https://nuttifox.com/resources/online-marketing-guide/" class="" target="_blank">Marketing Guide 2018</a></li>
						<li><a href="https://nuttifox.com/event-list/" class="" target="_blank">Upcoming Events</a></li>
						<li><a href="https://nuttifox.com/insights/" class="" target="_blank">Insights</a></li>
					</ul>
			</div>
			<div class="remote_posts welcome-panel-column welcome-panel-last insights">
				<h3>INSIGHTS</h3>
				<?php 
				$response = wp_remote_get( add_query_arg( array(
					'per_page' => 4
				), 'https://nuttifox.com/wp-json/wp/v2/posts' ) );
				if( !is_wp_error( $response ) && $response['response']['code'] == 200 ) {
					$remote_posts = json_decode( $response['body'] ); // our posts are here
					foreach( $remote_posts as $remote_post ) {
						echo '<a href="'. $remote_post->link . '" target="_blank"><h4>'. $remote_post->title->rendered . '</h4></a>';
					}
				}
				?>
			</div>
		</div>
		<div class="remote_posts welcome-panel-column">
		</div>
		<a href="https://nuttifox.com/dashboard-banner" class="nuttifox_banner_link" target="_blank"><img src="https://nuttifox.com/plugin-support/banner.jpg" class="nuttifox_banner"></a>
	</div>
	<script>
		jQuery(document).ready(function($) {
			$('#welcome-panel').after($('#nuttifox_panel').show());
		});
	</script>

<?php }

function nuttifox_send_support_email(){
	$current_user = wp_get_current_user();
	$user = $current_user->first_name .' '. $current_user->last_name .' '. $current_user->user_login;
    $to = 'support@nuttifox.com';
	$subject = 'Support Request { Nuttifox Support Plugin }';
	//$headers = 'From: '.$user.' <'.$current_user->user_email.'>' . "\r\n";
	$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
	$message =  '<p><b>New support request from:</b></p>';
	$message .= '<p><b>First Name: </b>'.$current_user->first_name.'</p>';
	$message .= '<p><b>Last Name : </b>'.$current_user->lst_name.'</p>';
	$message .= '<p><b>User Login: </b>'.$current_user->user_login.'</p>';
	$message .= '<p><b>Email	 : </b>'.$current_user->user_email.'</p>';
	$message .= '<p><b>Website   : </b>'.$_SERVER['HTTP_HOST'].'</p>';
	$message .= '<p><b>Message   : </b>'.$_POST['problem'].'</p>';
	
    if( mail($to, $subject, $message, $headers) ){
        echo 'OK '.$user;
    } else {
        echo 'mail not sent';
    }
    die();

}