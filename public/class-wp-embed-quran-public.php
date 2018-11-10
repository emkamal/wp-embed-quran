<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://kamalabs.com
 * @since      1.0.0
 *
 * @package    Wp_Embed_Quran
 * @subpackage Wp_Embed_Quran/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Embed_Quran
 * @subpackage Wp_Embed_Quran/public
 * @author     Mustafa Kamal <mustafakamal87@gmail.com>
 */
class Wp_Embed_Quran_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	private function process_attributes($atts) {
		$chapter = 0;
		$verse = "";

		if(count($atts) == 1){
			$target = explode(":", $atts[0]);
			if(count($target) == 2){
				$chapter = $target[0];
				$verses = $target[1];
			}
		}else{
			if(array_key_exists("chapter", $atts)){
				$chapter = $atts["chapter"];
			}
			elseif(array_key_exists("surah", $atts)){
				$chapter = $atts["surah"];
			}
			elseif(array_key_exists("sura", $atts)){
				$chapter = $atts["sura"];
			}
			elseif(array_key_exists("surat", $atts)){
				$chapter = $atts["surat"];
			}

			if(array_key_exists("verses", $atts)){
				$verses = $atts["verses"];
			}
			elseif(array_key_exists("verse", $atts)){
				$verses = $atts["verse"];
			}
			elseif(array_key_exists("ayah", $atts)){
				$verses = $atts["ayah"];
			}
			elseif(array_key_exists("aya", $atts)){
				$verses = $atts["aya"];
			}
			elseif(array_key_exists("ayat", $atts)){
				$verses = $atts["ayat"];
			}
		}

		if($chapter == 0 && $verses == ""){
			return false;
		}
		
		return array("chapter"=>$chapter, "verses"=>$verses);
	}

	/**
	 * [quran surah="12" ayah="1"]
	 * [quran surah="12" ayah="1-10"]
	 * [quran sura="12" aya="1-10"]
	 * [quran surat="12" ayat="1"]
	 * [quran chapter="12" verse="1"]
	 * [quran 12:78]
	 * [qs 12:78]
	 */
	public function quran_shortcode( $atts ){
		$target = $this->process_attributes($atts);
		$output = "<div class='wpEmbedQuran' ";
		if($target){
			$output .= "data-chapter='".$target["chapter"]."' data-verses='".$target["verses"]."'>";
			$output .= $this->get_quran_text($target["chapter"], $target["verses"]);
		}
		else{
			$output .= ">[Can't find the specified verse(s) on the Quran]";
		}
		$output .= "</div>";
		
		return $output;
	}

	public function get_quran_text($chapter, $verses){
		$chapter = intval($chapter)-1;
		$verses = $this->get_verses_array($verses);
		$filepath = plugin_dir_path( __DIR__ )."includes\quran.xml";
		$xml = simplexml_load_file($filepath) or die("Error: Quran database can not be loaded");
		$output = "";
		// $output .= (string) $xml->sura[0]->aya[0]["text"];

		for($i=0; $i<count($verses); $i++){
			$output .= (string) $xml->sura[$chapter]->aya[$verses[$i]]["text"];
		}
		return $output;
	}

	public function get_verses_array($string){
		$output = array();
		if( strpos( $string, "-" ) !== false) {
			$string_array = explode("-", $string);
			$start = $string_array[0];
			$end = $string_array[1];
			for($i=intval($start); $i<intval($end); $i++){
				array_push($output, $i-1);
			}
		}
		else{
			array_push($output, intval($string)-1);
		}

		return $output;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Embed_Quran_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Embed_Quran_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-embed-quran-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, 'https://fonts.googleapis.com/css?family=Amiri&amp;subset=arabic', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Embed_Quran_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Embed_Quran_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-embed-quran-public.js', array( 'jquery' ), $this->version, false );

	}

}
