<?php include_once VIEW_PATH . '/partials/header.php' ?>

<div class="w-2/3 px-12">
        <div class="text-4xl">Success</div>
        <div class="flex mt-8">
            <div class="flex flex-col  pr-1">
                <label class="w-full text-sm font-medium pb-1" for="first_name"><?= $order['first_name'] ?></label>
            </div>
            <div class="flex flex-col  pl-1">
                <label class="w-full text-sm font-medium pb-1" for="last_name"><?= $order['last_name'] ?></label>
            </div>
        </div>
        <div class="flex flex-col mt-2">
            <label class="w-full text-sm font-medium pb-1" for="email"><?= $order['email'] ?></label>
        </div>
        <div class="flex flex-col mt-2">
            <label class="w-full text-sm font-medium pb-1" for="address"><?= $order['address'] ?></label>
        </div>
        <div class="flex mt-2">
            <div class="flex flex-col pr-1">
                <label class="w-full text-sm font-medium pb-1" for="city"><?= $order['city'] ?></label>
            </div>
            <div class="flex flex-col pl-1">
                <label class="w-full text-sm font-medium pb-1" for="postcode"><?= $order['postcode'] ?></label>
            </div>
        </div>
        <div class="flex flex-col mt-2">
            <label class="w-full text-sm font-medium pb-1" for="phonenumber"><?= $order['phonenumber'] ?></label>
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
                        <?php foreach($order['order_items'] as $pizza): ?>
                            <li>
                                <div class="py-4 border-b border-gray-300">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-grow w-full ">
                                            <div class="flex items-center">
                                                <span class="flex items-center rounded-sm text-blue-700 font-medium h-6 w-6 mr-2 justify-center bg-blue-100"><?php echo $pizza['qty'] ?></span>
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
                </div>
            </div>
        </div>
        </div>
    </div>