<div class="px-2 w-1/3 ">
    <div class="p-6 bg-white border border-gray-200">
        <header class="pb-8 border-b border-gray-200">
            <div class="text-2xl text-gray-800 font-medium">Your order</div>
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
                                        <form action="/cart/delete" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $pizza['pizza_type_id'] ?>">
                                            <button class="p-1"><svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 18" class="w-4 h-4"><defs><path id="trash-a" d="M6 19c0 1.1.9 2 2 2h8a2 2 0 002-2V7H6v12zm3.8-8.8c.2 0 .5 0 .7.3L12 12l1.5-1.5a1 1 0 011.3-.1h.1a1 1 0 010 1.5l-1.5 1.5 1.5 1.5a1 1 0 01.1 1.3v.1a1 1 0 01-1.5 0L12 14.8l-1.5 1.5a1 1 0 01-1.3.1H9a1 1 0 010-1.5l1.5-1.5L9 11.9a1 1 0 01-.1-1.3v-.1c.2-.2.5-.3.8-.3zM14.5 3l1 1H19v2H5V4h3.5l1-1h5z"></path></defs><use fill-rule="evenodd" transform="translate(-5 -3)" href="#trash-a"></use></svg></button>
                                        </form>
                                        <span class="w-12 text-right text-sm"><?php echo '£' . $pizza['price'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                    
                </ul>
            </div>
            <div class="mt-10">
                <ul>
                    <li class="flex justify-between pb-4 text-sm">
                        <strong> Subtotal</strong>
                        <strong><?php echo '£' . number_format((float)$subtotal, 2, '.', ''); ?></strong>
                    </li>
                    <li class="flex justify-between pb-4 text-sm">
                        <strong>Total</strong>
                        <strong><?php echo '£' . number_format((float)$subtotal, 2, '.', ''); ?></strong>
                    </li>
                </ul>
            </div>
            <div class="mt-2">
                <!-- <a class="p-4 m-auto bg-yellow-600 text-white text-lg w-full font-semibold">Go to checkout</a> -->
                <!-- <button class="p-3 m-auto bg-yellow-600 text-white text-lg w-full font-semibold">Go to checkout</button> -->
                <a href="/checkout" class="text-center block p-3 m-auto bg-yellow-600 text-white text-lg w-full font-semibold">Go to checkout</a>
            </div>
        </div>
    </div>
</div>