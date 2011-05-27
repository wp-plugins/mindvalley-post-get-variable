<?php
/*
Plugin Name: Mindvalley Post & Get Variables
Description: Lets you output a POST or GET variable in the page via shortcode.
Author: MindValley
Version: 1.0.1
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
 */
Class MV_Post_Get_Variables {
    function __construct(){
        add_shortcode('post_var', array(&$this,'post_var'));
        add_shortcode('get_var', array(&$this,'get_var'));
    }
    
    function post_var($atts){
        if(isset($_POST[$atts['name']])){
            return htmlentities($_POST[$atts['name']]);
        }
        return '';
    }
    
    function get_var($atts){
        if(isset($_GET[$atts['name']])){
            return htmlentities($_GET[$atts['name']]);
        }
        return '';
    }
}

new MV_Post_Get_Variables();