# Simple Social Shout for GiveWP

A GiveWP add-on that adds simple social sharing buttons to the Donation Confirmation page.

![image](assets/images/sss4givewp-frontend-screenshot.png)

## Description
Let your donors share their donation experience with the world of social media. Social proof can be a powerful way to encourage more donations.

This is a simple GiveWP add-on with very few options:

<ul>
<li><strong>Social Share Title</strong><br />A heading above the social share buttons.</li>
<li><strong>Social Share Encouragement</strong><br />A paragraph below the title to encourage your donors to share their donation on social media</li>
<li><strong>Channels</strong><br />Checkbox list of the four supported social channels: Facebook, Twitter, LinkedIn, Pinterest</li>
<li><strong>Position</strong><br />Choose whether to output the social share section above or below the Donation Confirmation receipt table.</li>
</ul>

That's all you need to get up and running with this simple GiveWP add-on and start letting your donors share their donations with the world on social media.

## Frequently Asked Questions

<details><summary>Can I style the social share buttons?</summary>

Of course you can use CSS, but if you want more complex customization of the appearance you can use this filter to point to your own template file.

`add_filter('sss4givewp_template', 'my_sss4givewp_template');

function my_sss4givewp_template() {
    return MY_PATH . '/my-template-file.php';
}`
</details>
<details><summary>I want to add X social platform; will you add it?</summary>

I'm keeping this really simple and not planning to do major updates, but I'll make sure it always works as intended. Use it, fork it, do what you like. I'll respond if you find bugs, for sure.
</details>

## Changelog
**2019-08 -- Version 1.0**
Launched version 1 with the following features:
* Settings page that includes:
    * Title
    * Message
    * Channels
    * Position
* Filter for developers to point to their own template file