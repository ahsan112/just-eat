const form = document.getElementById('payment-form');

braintree.dropin.create({
    authorization: '<?php echo $token ?>',
    container: document.getElementById('dropin-container'),
        // ...plus remaining configuration
    }, (error, dropinInstance) => {
        form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);

                document.getElementById('nonce').value = payload.nonce;
                console.log(payload.nonce);
                form.submit();
            });
        });
});
