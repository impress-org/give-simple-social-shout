<?php 

add_action( 'wp_footer', 'my_footer_scripts' );

function my_footer_scripts(){
  ?>
    <script type="text/javascript">
        if ( undefined !== window.fbq ) {
            console.log('The FB Pixel was detected');

            jQuery("input#give-purchase-button").click(function($){
                fbq('track', 'Donate')
            } );
        
            jQuery(window).load(setTimeout(givewpTriggerPurchaseEvent, 5500));

            function givewpTriggerPurchaseEvent(){
                var donationReceipt = jQuery('#give_donation_receipt').length;

                var successPage = jQuery('p.give_notice.give_success').length;

                var verifyTotalDonation = jQuery('#totaldonation').length;

                console.log(donationReceipt, successPage, verifyTotalDonation)

                if(successPage) {
                    console.log('This is a Donation Confirmation Page');
                    var getPrice = jQuery('#totaldonation').text();
                    getPrice = getPrice.split('$');
                    getPrice = Number(getPrice[1]);
                    fbq('track', 'Purchase', {currency: give_global_vars.currency[0] , value: getPrice});
                }
            }
        }
    </script>
  <?php
}