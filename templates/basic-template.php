<?php
/**
 * Basic Social Share Output Template
 */
?>

<div id="sss4givewp">
    <h3><?php echo $settings['title']; ?></h3>
    <p><?php echo $settings['encouragement']; ?></p>

    <!-- facebook -->
    <?php if (in_array('fb', $settings['channels'])) : ?>
    <a class="socicon-facebook" href="https://www.facebook.com/share.php?u=<?php echo urlencode($meta['referral']); ?>&quote=Help me support &quot;<?php echo $meta['org']; ?>&quot; and donate to &quot;<?php echo $meta['form_title']; ?>&quot;" target="blank"></a>
    <?php endif; ?>

    <!-- twitter -->
    <?php if (in_array('twitter', $settings['channels'])) : ?>
    <a class="socicon-twitter" href="https://twitter.com/intent/tweet?status=Help me support <?php echo $meta['org']; ?> and donate to: <?php echo $meta['form_title']; ?>'+'<?php echo esc_url($meta['referral']); ?>" target="blank"></a>
    <?php endif; ?>

    <!-- linkedin -->
    <?php if (in_array('linkedin', $settings['channels'])) : ?>
    <a class="socicon-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($meta['referral']); ?>&title=Help me support <?php echo $meta['org']; ?> and donate to: <?php echo $meta['form_title']; ?>'&source=<?php echo $meta['org']; ?>" target="blank"></a>
    <?php endif; ?>
</div>
