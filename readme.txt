=== Mindvalley Post & Get Variables ===
Contributors: mindvalley
Donate link: http://www.mindvalley.com/opensource
Tags: pagemash, page, management
Requires at least: 3.0.0
Tested up to: 3.1.3
Stable tag: 1.0

Lets you output a POST or GET variable in the page via shortcode.


== Description ==

Outputs $_POST or $_GET variable values using shortcodes.

Super duper uberly useful on tracking scripts on eCommerce thank you pages.

Example:

[post_var name='email']

or

[get_var name='txn_id']



== Installation ==

1. Upload plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enjoy!


== Frequently Asked Questions ==

= Why I can't get some of the URL variables? =

WordPress has a set of reserved GET variables that is used for page querying. For example, 'name' or 'page_id' or 'id' can't be used without having some unexpected results.