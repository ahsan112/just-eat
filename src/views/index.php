<?php include_once VIEW_PATH . '/partials/header.php' ?>

<div style="
    flex: 1; 
    flex-basis: 16.66667%;
    max-width: 16.6%;" class="px-4">
    <div></div>
</div>

<div class="flex-1 px-2">
    <header class="p-8 border border-gray-200 bg-white">
        <div class="flex items-center justify-center flex-col w-full">
            <img src="https://d30v2pzvrfyzpo.cloudfront.net/uk/images/restaurants/100613.gif" loading="lazy" alt="" data-js-test="restaurant-logo" data-test-id="restaurant-logo" class="c-mediaElement-img c-mediaElement-img--outlined c-mediaElement-img--negativeTop">
            <div class="mt-8">
                <div class="mb-4 text-center text-2xl font-semibold">Rajas The King of Fast Food</div>
                <p class="flex items-center justify-center text-sm">201 Otley Road, Bradford, BD3 0JF</p>
                <p class="flex items-center justify-center text-sm">07547385964</p>
            </div>
            <div class="delivery-switcher mt-8 w-full">
                <label id="delivery-label" class="delivery-switcher-switch delivery-switcher--active" for="delivery-switch">
                    <!-- <input onchange="updateDelivery(this)" type="hidden" type="radio" name="delivery-switcher" value="delivery" checked="checked" class="hidden" id="delivery-switch"> -->
                    <input data-delivery="1" onchange="updateDelivery(this)" type="radio" name="delivery-switcher" value="delivery" checked="checked" class="absolute overflow-hidden -m-px h-px w-px" id="delivery-switch">
                    <div class="flex flex-col">
                        <span>Delivery</span> 
                         <span data-js-test="delivery-eta" class="c-basketSwitcher-eta">From 15:15</span>
                    </div>
                </label>    
                <label id="collection-label" class="delivery-switcher-switch" for="collection-switch">
                    <!-- <input onchange="updateDelivery(this)" type="radio" name="delivery-switcher" value="delivery" checked="checked" class="hidden" id="collection-switch"> -->
                    <input data-collection="1" onchange="updateDelivery(this)" type="radio" name="delivery-switcher" value="delivery" class="absolute overflow-hidden -m-px h-px w-px" id="collection-switch">
                    <div class="flex flex-col">
                        <span>Collection</span> 
                         <span data-js-test="delivery-eta" class="c-basketSwitcher-eta">20 mins</span>
                    </div>
                </label>    
            </div>
        </div>
        <div></div>
    </header>
    <div class="my-10">
        <header class="my-8 ">
            <div>
                <h2 class="text-3xl text-gray-800 font-semibold pb-4">Menu</h2>
                <p class="mt-2 text-sm text-gray-800">Try our halal mouthwatering, cheesy & tasty pizzas...</p>
                <p class="mt-2 text-sm text-gray-800">Any 12" calzone folded pizza £1.5 extra</p>
            </div>
        </header>
        <?php 
            foreach ($pizzas as $key => $pizza) {
                include VIEW_PATH . '/menu-card.php';
            }
        ?>
    </div>
</div>


<?php include VIEW_PATH . '/cart.php'; ?>

<?php include VIEW_PATH . '/menu-modal.php'; ?>


<?php include_once VIEW_PATH . '/partials/footer.php' ?>
