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
    <a class="socicon-facebook" href="https://www.facebook.com/share.php?u=<?php echo urlencode($referral); ?>&quote='Help me support <?php echo $org; ?> and donate to: <?php echo $form_title; ?>'" target="blank"></a>
    <?php endif; ?>

    <!-- twitter -->
    <?php if (in_array('twitter', $settings['channels'])) : ?>
    <a class="socicon-twitter" href="https://twitter.com/intent/tweet?status='Help me support <?php echo $org; ?> and donate to: <?php echo $form_title; ?>'+'<?php echo esc_url($referral); ?>'" target="blank"></a>
    <?php endif; ?>

    <!-- linkedin -->
    <?php if (in_array('linkedin', $settings['channels'])) : ?>
    <a class="socicon-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url='<?php echo esc_url($referral); ?>'&title='Help me support <?php echo $org; ?> and donate to: <?php echo $form_title; ?>'&source=<?php echo $org; ?>" target="blank"></a>
    <?php endif; ?>

    <!-- pinterest -->
    <?php if (in_array('pinterest', $settings['channels'])) : ?>
    <a class="socicon-pinterest" href="https://pinterest.com/pin/create/bookmarklet/?media={{media}}&url='<?php echo esc_url($referral); ?>'&is_video=false&description='<?php echo $form_title; ?>'" target="blank"></a>
    <?php endif; ?>
</div>
