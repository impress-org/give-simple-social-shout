if (typeof window.fbq !== "undefined") { 
    console.log('The FB Pixel was detected');
    const form = document.querySelector('form[id*="give-form"]');
    const amount = document.querySelector('.give-final-total-amount');
    var donateclick = document.getElementById("give-purchase-button")
    
    donateclick.onclick(
    fbq('track', 'Purchase', {currency: form.dataset.currency_code, value: amount})
    );
}

