<?php
/*
Plugin Name: Mindvalley Post & Get Variables
Description: Lets you output a POST or GET variable in the page via shortcode.
Author: Mindvalley
Version: 1.0.2
*/

/*
 * Example :
 * 
 * <script type="text/javascript">
 *      var pageTracker = _gat._getTracker("UA-XXXXX-1");
 *      pageTracker._trackPageview();
 *      pageTracker._addTrans(
 *          "[post_var name='txn_id']", // Order ID
 *          "[post_var name='aff']", // Affiliation
 *          "[post_var name='total']", // Total
 *          "[post_var name='tax']", // Tax
 *          "[post_var name='shipping']", // Shipping
 *          "[post_var name='city']", // City
 *          "[post_var name='state']", // State
 *          "[post_var name='country']" // Country
 *      );
 * </script>
 * 
 * For array values :
 * 
 * [post_var] name=search[user][email] [/post_var]
 * [get_var] name=search[user][first_name] [/get_var]
 * [get_var] name=search[user][last_name] [/get_var]
 * 
 */
Class MV_Post_Get_Variables {
    function __construct(){
        add_shortcode('post_var', array(&$this,'post_var'));
        add_shortcode('get_var', array(&$this,'get_var'));
    }
    
    function post_var($atts){
        if(!is_array($atts)){
			$atts = array();
		}
		$atts = $this->convert_block_to_params($atts,$content);
		$key = $atts['name'];
		
		// Array Key
		if($pos = strpos($key,'[')){
			$basekey = substr($key,0,$pos);
			$remainder = substr($key,$pos);
			
			eval('$value = $_POST[' . $basekey . ']' . $remainder . ';');
		}else{
			$value = $_POST[$key];
		}
		
        if(!empty($value)){
            return htmlentities($value);
        }
        return '';
    }
    
    function get_var($atts,$content){
		if(!is_array($atts)){
			$atts = array();
		}
		$atts = $this->convert_block_to_params($atts,$content);
		$key = $atts['name'];
		
		// Array Key
		if($pos = strpos($key,'[')){
			$basekey = substr($key,0,$pos);
			$remainder = substr($key,$pos);
			
			eval('$value = $_GET[' . $basekey . ']' . $remainder . ';');
		}else{
			$value = $_GET[$key];
		}
		
        if(!empty($value)){
            return htmlentities($value);
        }
        return '';
    }

	function convert_block_to_params($params,$text){
		// Wordpress Funky Encoding
		$text = str_replace("&#8221;",'"',$text);
		$text = str_replace("&#8243;",'"',$text);
		$text = str_replace("–","-",$text);
		$text = str_replace('″','"',$text);
		$text = str_replace("’","'",$text);
		
		$values = array();
        $search = array(chr(145), chr(146), chr(147), chr(148), chr(151));
        $replace = array("'", "'", '"', '"', '-');
        $text = str_replace($search, $replace, $text);
        $text = str_replace('”','"',$text);
        $text = str_replace('\\"',"&quot;",$text);
        $text = str_replace("\\'","&#39;",$text);
        $text = str_replace('\\$','$',$text);
        $text = str_replace('\\{','{',$text);
        $text = str_replace('\\}','}',$text);
        $text = str_replace("<br />\n","\n ",$text);
        $text = str_replace("<p>","",$text);
        $text = str_replace("</p>","",$text);
		
		if (preg_match_all('/([^=\s]+)(\s|)=(\s|)("(?P<value1>[^"]+)"|\'(?P<value2>[^\']+)\'|(?P<value3>.+?)\b)/', $text, $matches, PREG_SET_ORDER))
            foreach ($matches as $match)
                $values[trim($match[1])] = trim(@$match['value1'] . @$match['value2'] . @$match['value3']);

		return array_merge_recursive($params,$values);
    }
}

new MV_Post_Get_Variables();