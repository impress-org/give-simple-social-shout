=== Simple Social Shout for GiveWP ===
Contributors: webdevmattcrom, givewp
Donate link: https://givewp.com
Tags: givewp, donation, social share, social sharing, facebook, twitter, linkedin, pinterest,
Requires at least: 4.0
Tested up to: 4.8
Stable tag: trunk
Requires PHP: 5.6
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

A GiveWP add-on that adds simple social sharing buttons to the Donation Confirmation page.

== Description ==

Let your donors share their donation experience with the world of social media. Social proof can be a powerful way to encourage more donations.

This is a simple GiveWP add-on with very few options:

<ul>
<li><strong>Social Share Title</strong><br />A heading above the social share buttons.</li>
<li><strong>Social Share Encouragement</strong><br />A paragraph below the title to encourage your donors to share their donation on social media</li>
<li><strong>Channels</strong><br />Checkbox list of the four supported social channels: Facebook, Twitter, LinkedIn, Pinterest</li>
<li><strong>Position</strong><br />Choose whether to output the social share section above or below the Donation Confirmation receipt table.</li>
</ul>

That's all you need to get up and running with this simple GiveWP add-on and start letting your donors share their donations with the world on social media.

== Installation ==

# AUTOMATIC INSTALLATION
Automatic installation is the easiest option as WordPress handles the file transfers itself and you don’t need to leave your web browser. To do an automatic install of Simple Social Shout for GiveWP, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type “Simple Social Shout for GiveWP” and click Search Plugins. Once you have found the plugin you can view details about it such as the the point release, rating and description. Most importantly of course, you can install it by simply clicking “Install Now”.

# MANUAL INSTALLATION
The manual installation method involves downloading our donation plugin and uploading it to your server via your favorite FTP application. The WordPress codex contains instructions on how to do this here.

# UPDATING
Automatic updates should work like a charm; as always though, ensure you backup your site just in case.

== Frequently Asked Questions ==

= Can I style the social share buttons? =

Of course you can use CSS, but if you want more complex customization of the appearance you can use this filter to point to your own template file.

`add_filter('sss4givewp_template', 'my_sss4givewp_template');

function my_sss4givewp_template() {
    return MY_PATH . '/my-template-file.php';
}`

= I want to add X social platform; will you add it? =

I'm keeping this really simple and not planning to do major updates, but I'll make sure it always works as intended. Use it, fork it, do what you like. I'll respond if you find bugs, for sure.


== Screenshots ==

1. The settings allow for customizing the title, message (or "Encouragement"), the social channels, and the position (above or below).
2. This is how the social sharing appears in the Storefront theme

== Changelog ==

**2019-08 -- Version 1.0**
Launched version 1 with the following features:
* Settings page that includes:
    * Title
    * Message
    * Channels
    * Position
* Filter for developers to point to their own template file

== Upgrade Notice ==

First release!
