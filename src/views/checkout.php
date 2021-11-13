<?php include_once VIEW_PATH . '/partials/header.php' ?>

<form id="payment-form" class="flex w-full" action="/checkout" method="POST">
    <div class="w-2/3 px-12">
        <div class="text-lg font-semibold">Contact infomation</div>
        <div class="flex mt-8">
            <div class="flex flex-col w-6/12 pr-4">
                <label class="w-full text-sm font-medium pb-1" for="first_name">First Name</label>
                <input class="w-full py-2 px-2 border border-gray-300 rounded-md" name="first_name" type="text">
            </div>
            <div class="flex flex-col w-6/12 pl-4">
                <label class="w-full text-sm font-medium pb-1" for="last_name">Last Name</label>
                <input class="w-full py-2 px-2 border border-gray-300 rounded-md" name="last_name" type="text">
            </div>
        </div>
        <div class="flex flex-col mt-8">
            <label class="w-full text-sm font-medium pb-1" for="email">Email address</label>
            <input class="w-full py-2 px-2 border border-gray-300 rounded-md" type="email" name="email" id="email">
        </div>
        <div class="flex flex-col mt-8">
            <label class="w-full text-sm font-medium pb-1" for="address">Address</label>
            <input class="w-full py-2 px-2 border border-gray-300 rounded-md" type="text" name="address" id="">
        </div>
        <div class="flex mt-8">
            <div class="flex flex-col w-6/12 pr-4">
                <label class="w-full text-sm font-medium pb-1" for="city">City</label>
                <input class="w-full py-2 px-2 border border-gray-300 rounded-md" name="city" type="text">
            </div>
            <div class="flex flex-col w-6/12 pl-4">
                <label class="w-full text-sm font-medium pb-1" for="postcode">Postcode</label>
                <input class="w-full py-2 px-2 border border-gray-300 rounded-md" name="postcode" type="text">
            </div>
        </div>
        <div class="flex flex-col mt-8">
            <label class="w-full text-sm font-medium pb-1" for="phonenumber">Phone number</label>
            <input class="w-full py-2 px-2 border border-gray-300 rounded-md" type="tel" name="phonenumber" id="">
        </div>
        <div class="flex flex-col mt-8">
            <div id="dropin-container"></div>
            <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </div>
    </div>
    <div class="flex w-1/3">
        <div class="w-full bg-white">
            <div class="p-6 bg-white border border-gray-200">
            <header class="pb-8 border-b border-gray-200">
                <div class="text-2xl text-gray-800 font-medium">Summary</div>
            </header>
            <div>
                <div>
                    <ul>
                        <?php foreach($cart as $pizza): ?>
                            <li>
                                <div class="py-4 border-b border-gray-300">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-grow w-full ">
                                            <div class="flex items-center">
                                                <span class="flex items-center rounded-sm text-blue-700 font-medium h-6 w-6 mr-2 justify-center bg-blue-100"><?php echo $pizza['quantity'] ?></span>
                                                <span class="text-blue-700 text-sm"><?php echo $pizza['name'] ?></span>
                                            </div>
                                            <ul class="flex flex-wrap ml-8 text-sm text-gray-800">
                                                <li class="mt-1 w-full"><?php echo $pizza['size'] ?></li>
                                                <?php if($pizza['extra_toppings']): ?>
                                                    <ul class="ml-2">
                                                        <?php foreach($pizza['extra_toppings'] as $topping): ?>
                                                            <li class="mt-1 text-gray-700 text-sm"><?php echo  '+ ' . $topping['name'] ?></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                <?php endif ?>
                                            </ul>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-12 text-right text-sm"><?php echo '£' . $pizza['price'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                        
                    </ul>
                </div>
                <div class="mt-10">
                    <!-- <ul>
                        <li class="flex justify-between pb-4 text-sm">
                            <strong> Subtotal</strong>
                            <strong><?php echo '£' . number_format((float)$subtotal, 2, '.', ''); ?></strong>
                        </li>
                        <li class="flex justify-between pb-4 text-sm">
                            <strong>Total</strong>
                            <strong><?php echo '£' . number_format((float)$subtotal, 2, '.', ''); ?></strong>
                        </li>
                    </ul> -->
                </div>
                <div class="mt-2">
                    <!-- <a class="p-4 m-auto bg-yellow-600 text-white text-lg w-full font-semibold">Go to checkout</a> -->
                    <button class="p-3 m-auto bg-yellow-600 text-white text-lg w-full font-semibold">Place order</button>
                    <!-- <a href="/checkout" class="text-center block p-3 m-auto bg-yellow-600 text-white text-lg w-full font-semibold">Go to checkout</a> -->
                </div>
            </div>
        </div>
        </div>
    </div>
</form>

<script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>

<script>
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
                
                // Step four: when the user is ready to complete their
                //   transaction, use the dropinInstance to get a payment
                //   method nonce for the user's selected payment method, then add
                //   it a the hidden field before submitting the complete form to
                //   a server-side integration
                document.getElementById('nonce').value = payload.nonce;
                console.log(payload.nonce);
                form.submit();
            });
        });
    });

</script>

<?php //include_once VIEW_PATH . '/partials/footer.php' ?>
