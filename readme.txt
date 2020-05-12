=== Simple Social Shout for GiveWP ===
Contributors: givewp, webdevmattcrom
Donate link: https://givewp.com
Tags: givewp, donation, social share, social sharing, facebook, twitter, linkedin, pinterest,
Requires at least: 4.0
Tested up to: 5.4
Stable tag: 1.1.1
Requires PHP: 5.6
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

A [GiveWP](https://givewp.com/?utm_source=wordpress.org&utm_medium=referral&utm_campaign=Free_Addons&utm_content=SSS4GiveWP) add-on that adds simple social sharing buttons to the Donation Confirmation page.

== Description ==

A [GiveWP](https://givewp.com/?utm_source=wordpress.org&utm_medium=referral&utm_campaign=Free_Addons&utm_content=SSS4GiveWP) add-on that adds simple social sharing buttons to the Donation Confirmation page.

Let your donors share their donation experience with the world of social media. Social proof can be a powerful way to encourage more donations.

This is a simple GiveWP add-on with very few options:

<ul>
<li><strong>Social Share Title</strong><br />A heading above the social share buttons.</li>
<li><strong>Social Share Encouragement</strong><br />A paragraph below the title to encourage your donors to share their donation on social media</li>
<li><strong>Channels</strong><br />Checkbox list of the four supported social channels: Facebook, Twitter, and LinkedIn</li>
<li><strong>Position</strong><br />Choose whether to output the social share section above or below the Donation Confirmation receipt table.</li>
</ul>

You can also choose to disable the output of the social share options per form. Go to "Donations > Forms" and edit the form you'd like to disable social sharing on. On the form edit screen you'll see a "Social" tab. There you can choose "Disable". See screenshots below for a visual example. 

That's all you need to get up and running with this simple GiveWP add-on and start letting your donors share their donations with the world on social media.

[Learn more about this free add-on and all the free GiveWP add-ons we are creating in 2020 here](https://givewp.com/2020-the-year-of-free-givewp-add-ons/?utm_source=wordpress.org&utm_medium=referral&utm_campaign=Free_Addons&utm_content=SSS4GiveWP).

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

Of course you can use CSS, but if you want more complex customization of the appearance you can add a file into your theme's root folder called `sss4givewp.php` and that will be the output of your social sharing instead. It's best if you copy the template from the plugin to start from. The default template is found in the plugin in `/templates/basic-template.php`.

= How can I change the size of the icons? =

The easiest way is with custom CSS. Put this in your Customizer "Additional CSS" section and you'll get icons that are twice the current size:

`#sss4givewp a {
	width: 80px;
	height: 80px;
	padding: 18px;
}#sss4givewp a svg {
	width: 40px;
	height: 40px;
}`

Note that the `padding` of the `#sss4givewp a` rule might need minor tweaking to suit the existing styles in your site. 

= I want to add X social platform; will you add it? =

These three platforms each support a link-based sharing that does not require javascript or authentication -- this is why they were chosen and why this add-on is called "simple". But if you want to add additional platforms and know how to implement them correctly, see the above FAQ on how you can template the output yourself.

= Where can I submit Support Questions? =

If you have purchased any of our Premium Add-ons, we can provide with your [Priority Support here](https://givewp.com/support?utm_source=wordpress.org&utm_medium=referral&utm_campaign=Free_Addons&utm_content=SSS4GiveWP).

If you are a free GiveWP user and have a general question about GiveWP, [submit a ticket here](https://go.givewp.com/download).

Otherwise, if your question is specific to "Simple Social Shout for GiveWP," we're happy to answer your questions [here](https://wordpress.org/support/plugin/simple-social-shout-for-givewp/).


== Screenshots ==

1. The Social Icons shown above the GiveWP Donation Receipt on the Twenty Twenty theme.
2. The enable/disable setting in the form if you choose to disable social sharing for a specific form.
3. The SSS4GiveWP settings page. 

== Changelog ==

**2020-05-12 -- Version 1.1.1**
* Fixed a problem where some themes caused [icon size issues](https://github.com/impress-org/give-simple-social-shout/issues/11). 

**2020-05 -- Version 1.1**
* [Swapped out socicon for SVGs for stability](https://github.com/impress-org/give-simple-social-shout/issues/10)
* Added proper Internationalization

**2020-01 -- Version 1.0**
Launched version 1 with the following features:
* Settings page that includes:
    * Title
    * Message
    * Channels
    * Position
* Output is templateable
* Per form disable option 

== Upgrade Notice ==

First release!
