<form action="/cart/add" method="POST">
    <div id="menu-modal" style="background-color: rgba(0,0,0,.5);" class="hidden -inset-0 fixed">
        <div class="overflow-scroll max-w-md fixed  text-center bg-white top-2/4 right-2/4 w-3/4 rounded-sm transform translate-x-1/2 -translate-y-2/4">
        <div style="max-height: 90vh;" class="h-full">
            <button type="button" onclick="closeModal()" class="flex fixed items-center justify-center h-8 w-8 bg-blue-100 text-blue-700 right-4 top-3 border rounded-2xl">
                <svg class="w-4 h-4 bg-blue-100 text-blue-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" ><path fill-rule="evenodd" d="M13.3.7a1 1 0 00-1.4 0L7 5.6 2.1.7A1 1 0 10.7 2.1L5.6 7 .7 11.9a1 1 0 101.4 1.4L7 8.4l4.9 4.9a1 1 0 101.4-1.4L8.4 7l4.9-4.9c.4-.4.4-1 0-1.4z"></path></svg>
            </button>
            <div>
                <div class="pb-4 pr-14 pl-14 pt-10">
                    <!-- <span class="flex items-center justify-center fixed w-full -inset-0"> -->
                    <span id="pizza-name" class="flex items-center justify-center text-2xl font-semibold text-gray-800">
                        Chicken Pizza
                    </span> 
                </div>
            </div>
            <p class="text-gray-800 mb-4 text-sm font-semibold">from £5.50</p>
            <p id="pizza-description" class="text-gray-800 ml-10 mt-4 mr-10 mb-4 text-xs">Mozzarella cheese, tomato sauce, chicken balti, peppers & herbs</p>

            <section class="mt-8">
                <fieldset class="text-left border-0">
                    <legend class="bg-gray-100 pt-6 pr-4 pl-4 pb-4  w-full table top-14">
                        <span class="flex items-center justify-between text-gray-800">
                            <span class="w-full font-semibold text-lg">Choose one</span>
                            <span class="flex center whitespace-nowrap ">
                                <span class="bg-gray-500 text-white px-1 text-xs">Required</span>     
                            </span>
                        </span>
                    </legend>
                    <div id="pizza-types">

                    </div>

                </fieldset>
                <div>
                    <div>
                        <div>
                            <fieldset>
                                <legend class="bg-gray-100 pt-6 pr-4 pl-4 pb-4 w-full table top-14">
                                    <span class="flex items-center justify-between font-medium">
                                        <span class="w-full text-left">Extras</span>
                                        <span class="flex items-center nowrap">
                                            <span class="flex px-1 bg-white text-gray-400 text-sm">
                                                optional
                                            </span>    
                                        </span>
                                    </span>
                                </legend>
                                <?php foreach ($extraToppings as $topping):?>
                                    <div class="border-b border-gray-300">
                                        <div >
                                            <input data-toppingprice="<?=$topping['price'] ?>" onchange="updateTotal(this,'<?=$topping['price'] ?>')" class="selected-checkbox absolute overflow-hidden -m-px h-px w-px" type="checkbox" name="extra_toppings[<?= $topping['id'] ?>]" id="<?= 'topping-'.$topping['id'] ?>" value="<?= $topping['id'] ?>">
                                            <label class="selected-checkbox-label flex wrap justify-between relative w-full cursor-pointer text-sm font-light" for="<?= 'topping-'.$topping['id'] ?>">
                                                <span class="selected-checkbox-name items-center text-gray-800 flex flex-1 flex-wrap text-left p-4">
                                                    <span><?= $topping['name']  ?></span>
                                                    <span class="flex self-center ml-auto"><?= '+£' . $topping['price'] ?></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach?>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="flex items-center justify-center my-8">
                <button type="button" onclick="decreaseQty()" class="m-2 p-2 ">
                    <svg class="h-5 w-5 fill-current text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 2" ><defs><path id="minus-a" d="M18 11a1 1 0 010 2H6a1 1 0 010-2h12z"></path></defs><use fill-rule="evenodd" transform="translate(-5 -11)" href="#minus-a"></use></svg>
                </button>
                <p id="qty-value" class="text-center text-4xl text-gray-800 w-50">1</p>
                <input hidden type="number" name="qty" id="qty-value-hidden" value="1">
                <button type="button" onclick="increaseQty()" class="m-2 p-2 ">
                    <svg class="h-5 w-5 fill-current text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" ><defs><path id="plus-a" d="M12 5c.6 0 1 .4 1 1v5h5c.6 0 1 .4 1 1s-.4 1-1 1h-5v5c0 .6-.4 1-1 1a1 1 0 01-1-1v-5H6a1 1 0 010-2h5V6a1 1 0 011-1z"></path></defs><use fill-rule="evenodd" transform="translate(-5 -5)" href="#plus-a"></use></svg>
                </button>
            </div>

            <div class="shadow p-6 w-full sticky bottom-0 bg-white">
                <button id="add-btn" disabled class="add-to-order-btn flex justify-between p-4 bg-gray-200 w-full font-medium text-lg cursor-default">
                    <span>Add to order</span>
                    <span>
                        <span id="total-value">£5.50</span> 
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>