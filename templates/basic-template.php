<?php
/**
 * Basic Social Share Output Template
 */

 $message = apply_filters('sss4givewp_message', sprintf(__('Help me support &quot;%1$s&quot; and donate to &quot;%2$s&quot;', 'sss4givewp'),$meta['org'], $meta['form_title']));

 $status = $meta['share_status'][0];

 if ( $status !== 'disabled') :
?>

<div id="sss4givewp">
    <h3><?php echo $settings['title']; ?></h3>
    <p><?php echo $settings['encouragement']; ?></p>

    <!-- facebook -->
    <?php if (in_array('fb', $settings['channels'])) : ?>
    <a class="socicon-facebook" href="https://www.facebook.com/share.php?u=<?php echo urlencode($meta['referral']); ?>&quote=<?php echo $message; ?>" target="blank">
        <?php require SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'assets/images/facebook-logo.svg'; ?>
    </a>
    <?php endif; ?>

    <!-- twitter -->
    <?php if (in_array('twitter', $settings['channels'])) : ?>
    <a class="socicon-twitter" href="https://twitter.com/intent/tweet?text=<?php echo $message; ?>'+'<?php echo esc_url($meta['referral']); ?>" target="blank">
        <?php require SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'assets/images/twitter-logo.svg'; ?>
    </a>
    <?php endif; ?>

    <!-- linkedin -->
    <?php if (in_array('linkedin', $settings['channels'])) : ?>
    <a class="socicon-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($meta['referral']); ?>&title=<?php echo $message; ?>'&source=<?php echo $meta['org']; ?>" target="blank">
        <?php require SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'assets/images/linkedin-logo.svg'; ?>
    </a>
    <?php endif; ?>
</div>

<?php endif;
